#include "userlist.h"
#include "ui_userlist.h"
#include "connection.h"
#include <QtDebug>
#include <QApplication>
#include <QtWidgets>
#include <QSqlQuery>
#include <QSqlRecord>
#include <QMessageBox>
#include "employee.h"
#include <QPrinter>
EMPLOYEE e;

userlist::userlist(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::userlist)
{
    ui->setupUi(this);
    Connection conn;
    if(!conn.createconnect()) {
        qDebug() << "Failed to connect to the database!";
    }
    orderingid();
    fetching();
    // Set table widget to take up all available space
    ui->taable->horizontalHeader()->setSectionResizeMode(QHeaderView::Stretch);
    connect(ui->search_button, &QPushButton::clicked, this, [=]() {
               QString searchText = ui->search_user->text();
               searchTable(searchText);
           });
}

userlist::~userlist()
{
    delete ui;
}

void userlist::on_update_clicked() {
    e.update(modifiedData);
}
void userlist::on_taable_cellChanged(int row, int column)
{
    QTableWidgetItem *item = ui->taable->item(row, column);
    if (item) {
        modifiedData[QPair<int, int>(row, column)] = item->text();
    }
}


void userlist::on_delete_2_clicked()
{
    e.Delete(onTableSelectionChanged());
    deleteSelectedRow(onTableSelectionChanged());
}
void exportToPDF2(QTableWidget *tableWidget)
{
    QString filePath = QFileDialog::getSaveFileName(nullptr, "Save PDF", "", "PDF Files (*.pdf)");

    if (filePath.isEmpty()) {
        return;
    }

    QPrinter printer(QPrinter::PrinterResolution);
    printer.setOutputFormat(QPrinter::PdfFormat);
    printer.setPaperSize(QPrinter::A4);
    printer.setOutputFileName(filePath);

    QPainter painter;
    painter.begin(&printer);

    double xscale = printer.pageRect().width() / double(tableWidget->width());
    double yscale = printer.pageRect().height() / double(tableWidget->height());
    double scale = qMin(xscale, yscale);
    painter.scale(scale, scale);

    tableWidget->render(&painter);

    painter.end();

    QMessageBox::information(nullptr, "Export to PDF", "Table exported to PDF successfully!");
}
void userlist::orderingid()
{
    QSqlQuery query;

    // Select IDs from the database table in descending order
    if (query.exec("SELECT ID_EMPLOYE FROM EMPLOYES ORDER BY ID_EMPLOYE DESC")) {
        QVector<int> ids;
        int rowCount = 0;

        // Store IDs in a vector
        while (query.next()) {
            int id = query.value(0).toInt();
            ids.push_back(id);
            rowCount++;
        }

        // Check if IDs need to be reordered
        bool needReorder = false;
        for (int i = 0; i < rowCount; ++i) {
            if (ids[i] != rowCount - i) {
                needReorder = true;
                break;
            }
        }

        // Reorder IDs if necessary
        if (needReorder) {
            for (int i = 0; i < rowCount; ++i) {
                query.prepare("UPDATE EMPLOYES SET ID_EMPLOYE = :newId WHERE ID_EMPLOYE = :oldId");
                query.bindValue(":newId", rowCount - i);
                query.bindValue(":oldId", ids[i]);
                if (!query.exec()) {
                    qDebug() << "Failed to reorder IDs:" << query.lastError().text();
                    return;
                }
            }
            qDebug() << "IDs reordered successfully!";
        } else {
            qDebug() << "IDs are already in order.";
        }
    } else {
        qDebug() << "Failed to execute SELECT query:" << query.lastError().text();
    }
}

QString imagePath2="";
QString userlist::selectimage()
{
    imagePath2 = QFileDialog::getOpenFileName(this, tr("Select Image"), QDir::homePath(), tr("Image Files (*.png *.jpg *.bmp *.gif)"));

    if (!imagePath2.isEmpty()) {
        // Set the image path to a member variable for later use
        qDebug() << "Selected Image Path: " << imagePath2;
    }

    return imagePath2;
}

void userlist::on_taable_cellDoubleClicked(int row, int column) {
    if (column == 5) { // Assuming the image column index is 5
        QString imagePath = selectimage();
        QFile file(imagePath);
        if (!file.open(QIODevice::ReadOnly)) {
            QMessageBox::critical(this, "Error", "Failed to open image file.");
            return;
        }
        QByteArray newImageData = file.readAll();
        file.close();

        int ID = ui->taable->item(row, 0)->text().toInt(); // Assuming the ID column is the first column
        QString nom = ui->taable->item(row, 1)->text();
        QString prenom = ui->taable->item(row, 2)->text();
        QString login = ui->taable->item(row, 3)->text();
        QString password = ui->taable->item(row, 4)->text();
        QString role = ui->taable->item(row, 6)->text(); // Assuming role is at column index 6
        // Update the database with the new image data
        if (!e.updatenormal(ID, nom, prenom, login, password, role,"",newImageData)) {
            qDebug() << "Error updating employee record.";
            return;
        }

        // Update the table with the new image data
        QLabel *label = new QLabel();
        QPixmap pixmap;
        pixmap.loadFromData(newImageData);
        label->setPixmap(pixmap.scaled(100, 100, Qt::KeepAspectRatio));
        ui->taable->setCellWidget(row, column, label);

        qDebug() << "Employee record updated successfully!";
    }
}


int userlist::onTableSelectionChanged()
{
    QList<QTableWidgetItem*> selectedItems = ui->taable->selectedItems();

    if (!selectedItems.isEmpty()) {
        int selectedRow = selectedItems.first()->row();
        return selectedRow;
    }
    return -1;
}

void userlist::deleteSelectedRow(int selectedRow)
{
    if (selectedRow >= 0) {
        ui->taable->removeRow(selectedRow);
    }
}

void userlist::on_confirm_clicked()

{
fetching();
}

void userlist::fetching() {
    QSqlQuery query;
    if (query.exec("SELECT NOM, PRENOM, LOGIN, MOT_DE_PASSE, ROLE, IMAGE FROM EMPLOYES")) {
        ui->taable->clearContents();
        ui->taable->setRowCount(0);
        int row = 0;
        originalData.clear(); // Clear the original data map before fetching new data
        while (query.next()) {
            ui->taable->insertRow(row);
            for (int col = 0; col < query.record().count(); ++col) {
                if (col == 5) { // Assuming the image column is at index 5 (adjust as per your table structure)
                    QByteArray imageData = query.value(col).toByteArray();
                    QPixmap pixmap;
                    pixmap.loadFromData(imageData);
                    QLabel *label = new QLabel();
                    label->setPixmap(pixmap.scaled(100, 100, Qt::KeepAspectRatio));
                    ui->taable->setCellWidget(row, col, label);
                } else {
                    QTableWidgetItem *item = new QTableWidgetItem(query.value(col).toString());
                    ui->taable->setItem(row, col, item);
                    originalData[QPair<int, int>(row, col)] = item->text(); // Store the original data
                }
            }
            row++;
        }
    } else {
        qDebug() << "Failed to execute SELECT query:" << query.lastError().text();
    }
}

/*void userlist::on_comboBox_currentIndexChanged(const QString &arg1)
{
    // Get the selected sorting option from the combo box
        QString sortingOption = ui->combo->itemText(index);

        // Sort the table based on the selected option
        if (sortingOption == "First name") {
            // Sort by ETAT column
            ui->taable->sortByColumn(0, Qt::AscendingOrder);
        } else if (sortingOption == "Second Name") {
            // Sort by TYPE_SALLE column
            ui->taable->sortByColumn(1, Qt::AscendingOrder);
        } else if (sortingOption == "Login") {
            // Sort by CAPACITE column
            ui->taable->sortByColumn(2, Qt::AscendingOrder);
        } else if (sortingOption == "Password") {
            // Sort by DATE_D column
            ui->taable->sortByColumn(3, Qt::AscendingOrder);
        } else if (sortingOption == "Role") {
            // Sort by DATE_F column
            ui->taable->sortByColumn(4, Qt::AscendingOrder);
        } s

}*/

void userlist::on_comboBox_currentIndexChanged(int index)
{
    QString sortingOption = ui->comboBox->itemText(index);

    // Sort the table based on the selected option
    if (sortingOption == "First Name") {
        // Sort by ETAT column
        ui->taable->sortByColumn(0, Qt::AscendingOrder);
    } else if (sortingOption == "Second Name") {
        // Sort by TYPE_SALLE column
        ui->taable->sortByColumn(1, Qt::AscendingOrder);
    } else if (sortingOption == "Login") {
        // Sort by CAPACITE column
        ui->taable->sortByColumn(2, Qt::AscendingOrder);
    } else if (sortingOption == "Password") {
        // Sort by DATE_D column
        ui->taable->sortByColumn(3, Qt::AscendingOrder);
    } else if (sortingOption == "Role") {
        // Sort by DATE_F column
        ui->taable->sortByColumn(4, Qt::AscendingOrder);
    }
}

void userlist::on_generate_pdf_clicked()
{
    exportToPDF2(ui->taable);
}
void userlist::searchTable(const QString &text) {
    QString pattern = "\\b" + text + "\\b"; // Créer un motif de recherche qui correspond au texte exact
    QRegExp regExp(pattern, Qt::CaseInsensitive); // Créer une expression régulière pour le motif

    bool found = false; // Variable pour indiquer si une correspondance a été trouvée

    // Parcourir toutes les lignes du tableau
    for (int row = 0; row < ui->taable->rowCount(); ++row) {
        bool match = false;
        // Parcourir toutes les colonnes du tableau pour cette ligne
        for (int col = 0; col < ui->taable->columnCount(); ++col) {
            QTableWidgetItem *item = ui->taable->item(row, col);
            // Vérifier si l'élément correspond au texte de recherche en utilisant l'expression régulière
            if (item && regExp.indexIn(item->text()) != -1) {
                match = true;
                found = true; // Une correspondance a été trouvée
                break;
            }
        }
        // Afficher ou masquer la ligne en fonction de la correspondance
        ui->taable->setRowHidden(row, !match);
    }

    // Si aucune correspondance n'a été trouvée, afficher "introuvable"
    if (!found) {
        QMessageBox::information(this, "Résultat", "Aucune correspondance trouvée.");
    }
}
