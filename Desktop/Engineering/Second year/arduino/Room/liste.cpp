#include "liste.h"
#include "ui_liste.h"
#include <QStandardItemModel>
#include <QSqlQueryModel>
#include <QSqlQuery>
#include <QDebug>
#include<QDate>
#include <QSqlError>
#include <QtDebug>
#include <QApplication>
#include <QtWidgets>
#include <QSqlRecord>
#include <QMessageBox>
#include "connection.h"
#include <QPainter>
#include <QPrinter>
#include <QFileDialog>
#include <QSpinBox>
#include <QComboBox>

QMap<QPair<int, int>, QString> modifiedData2;

liste::liste(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::liste)
{
    ui->setupUi(this);
    orderingid();
    data_import();
    connect(ui->taable, &QTableWidget::cellChanged, this, &liste::on_taable_cellChanged);


       // Set horizontal and vertical header resize modes to stretch
       ui->taable->horizontalHeader()->setSectionResizeMode(QHeaderView::Stretch);
         ui->taable->verticalHeader()->setSectionResizeMode(QHeaderView::Stretch);

       // Create the combo box and add sorting options
          QStringList sortingOptions;
          sortingOptions << "etat" << "type" << "capacite" << "date_d" << "date_f" << "etat_equipement";
          ui->trie->addItems(sortingOptions);

          // Connect the combo box signal to a slot for sorting
          connect(ui->trie, QOverload<int>::of(&QComboBox::currentIndexChanged), this, &liste::on_comboBox_currentIndexChanged);
      }




liste::~liste()
{
    delete ui;
}

//read avec bouton

void liste::on_confirm_clicked()
{
    QSqlQuery query;
    if (query.exec("SELECT ETAT, TYPE_SALLE, CAPACITE, DATE_D, DATE_F, ETAT_EQUIPEMENT FROM SALLES ORDER BY ID_SALLE ASC")) {
        ui->taable->clearContents();
        ui->taable->setRowCount(0);
        int row = 0;
        while (query.next()) {
            ui->taable->insertRow(row);
            for (int col = 0; col < query.record().count(); ++col) {
                QTableWidgetItem *item;
                if (col == 3 || col == 4) { // Check if the column is DATE_D or DATE_F
                    item = new QTableWidgetItem(query.value(col).toDate().toString("yyyy-MM-dd"));
                } else {
                    item = new QTableWidgetItem(query.value(col).toString());
                }
                ui->taable->setItem(row, col, item);
            }
            ++row;
        }
    } else {
        qDebug() << "Failed to execute SELECT query:" << query.lastError().text();
    }
}

//read sans bouton

void liste::data_import()
{
    QSqlQuery query;
    if (query.exec("SELECT ETAT, TYPE_SALLE, CAPACITE, DATE_D, DATE_F, ETAT_EQUIPEMENT FROM SALLES ORDER BY ID_SALLE ASC")) {
        ui->taable->clearContents();
        ui->taable->setRowCount(0);
        int row = 0;
        while (query.next()) {
            ui->taable->insertRow(row);
            for (int col = 0; col < query.record().count(); ++col) {
                QTableWidgetItem *item;
                if (col == 3 || col == 4) { // Check if the column is DATE_D or DATE_F
                    item = new QTableWidgetItem(query.value(col).toDate().toString("yyyy-MM-dd"));
                } else {
                    item = new QTableWidgetItem(query.value(col).toString());
                }
                ui->taable->setItem(row, col, item);
            }
            ++row;
        }
    } else {
        qDebug() << "Failed to execute SELECT query:" << query.lastError().text();
    }
}

void liste::orderingid()
{
    QSqlQuery query;
    if (query.exec("SELECT ID_SALLE FROM SALLES ORDER BY ID_SALLE DESC")) {
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
                query.prepare("UPDATE SALLES SET ID_SALLE = :newId WHERE ID_SALLE = :oldId");
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

// pour verifier si il ya une  selection

int liste::onTableSelectionChanged() {
    QList<QTableWidgetItem*> selectedItems = ui->taable->selectedItems();

    if (!selectedItems.isEmpty()) {
        int selectedRow = selectedItems.first()->row();
        return selectedRow;
    }
    return -1;
}

//Pour vérifier si il ya une modification

void liste::on_taable_cellChanged(int row, int column)
{
    QTableWidgetItem *item = ui->taable->item(row, column);
    if (item) {
        modifiedData2[QPair<int, int>(row, column)] = item->text();
    }
}

// la mise à jour de données

void liste::on_update_clicked()
{
    QSqlQuery query;
    QMapIterator<QPair<int, int>, QString> iter(modifiedData2);
    while (iter.hasNext()) {
        iter.next();
        const QPair<int, int>& key = iter.key();
        const QString& newValue = iter.value();
        int row = key.first;
        int column = key.second;

        // Update records based on the ID_SALLE from the database
        QString columnName;
        switch (column) {
            case 0: columnName = "ETAT"; break;
            case 1: columnName = "TYPE_SALLE"; break;
            case 2: columnName = "CAPACITE"; break;
            case 3: columnName = "DATE_D"; break;
            case 4: columnName = "DATE_F"; break;
            case 5: columnName = "ETAT_EQUIPEMENT"; break;
            default: break;
        }
        if (!columnName.isEmpty()) {
            // Use the ID_SALLE from the database in the update query
            QString updateQuery;
            if (column == 2) { // Handle CAPACITE as number
                // Convert newValue to integer
                bool conversionOK;
                int capacityValue = newValue.toInt(&conversionOK);
                if (!conversionOK) {
                    qDebug() << "Failed to convert CAPACITE value to integer:" << newValue;
                    continue; // Skip this iteration if conversion fails
                }
                updateQuery = QString("UPDATE SALLES SET %1 = %2 WHERE ID_SALLE = %3").arg(columnName).arg(capacityValue).arg(row + 1);
            } else if (column == 3 || column == 4) { // Handle DATE_D and DATE_F as date
                // Assuming newValue is in the format "yyyy-MM-dd"
                updateQuery = QString("UPDATE SALLES SET %1 = TO_DATE('%2', 'YYYY-MM-DD') WHERE ID_SALLE = %3").arg(columnName).arg(newValue).arg(row + 1);
            } else {
                updateQuery = QString("UPDATE SALLES SET %1 = '%2' WHERE ID_SALLE = %3").arg(columnName).arg(newValue).arg(row + 1);
            }
            if (!query.exec(updateQuery)) {
                qDebug() << "Failed to update record:" << query.lastError().text();
            }
        }
    }
    modifiedData2.clear();
    qDebug() << "Records updated successfully!";
}

// le Supprimer de l interface

void liste::deleteSelectedRow(int selectedRow) {
    if (selectedRow >= 0) {
        ui->taable->removeRow(selectedRow);
    }
}

// supprimer de la base de données

void liste::on_delete_2_clicked()
{
    int selectedRow = onTableSelectionChanged();

    if (selectedRow != -1) {
        QSqlQuery query;

        // Delete the selected row
        query.prepare("DELETE FROM SALLES WHERE ID_SALLE = :id");
        query.bindValue(":id", selectedRow + 1); // Adjust ID value to match the database ID (starting from 1)

        if (query.exec()) {
            qDebug() << "Row deleted from database. ID_SALLE:" << selectedRow;
            deleteSelectedRow(selectedRow);
        } else {
            qDebug() << "Error deleting row from database:" << query.lastError().text();
        }

        // Update IDs to maintain sequential order
        query.prepare("UPDATE SALLES SET ID_SALLE = ID_SALLE - 1 WHERE ID_SALLE > :id");
        query.bindValue(":id", selectedRow + 1);

        if (query.exec()) {
            qDebug() << "IDs updated successfully!";
        } else {
            qDebug() << "Error updating IDs:" << query.lastError().text();
        }
    } else {
        qDebug() << "No row is selected.";
    }

}

void exportToPDF(QTableWidget *tableWidget)
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

void liste::on_pushButton_3_clicked()
{
    exportToPDF(ui->taable);
}

void liste::on_comboBox_currentIndexChanged(int index)
{
    // Get the selected sorting option from the combo box
        QString sortingOption = ui->trie->itemText(index);

        // Sort the table based on the selected option
        if (sortingOption == "etat") {
            // Sort by ETAT column
            ui->taable->sortByColumn(0, Qt::AscendingOrder);
        } else if (sortingOption == "type") {
            // Sort by TYPE_SALLE column
            ui->taable->sortByColumn(1, Qt::AscendingOrder);
        } else if (sortingOption == "capacite") {
            // Sort by CAPACITE column
            ui->taable->sortByColumn(2, Qt::AscendingOrder);
        } else if (sortingOption == "date_d") {
            // Sort by DATE_D column
            ui->taable->sortByColumn(3, Qt::AscendingOrder);
        } else if (sortingOption == "date_f") {
            // Sort by DATE_F column
            ui->taable->sortByColumn(4, Qt::AscendingOrder);
        } else if (sortingOption == "etat_equipement") {
            // Sort by ETAT_EQUIPEMENT column
            ui->taable->sortByColumn(5, Qt::AscendingOrder);
        }
    }

