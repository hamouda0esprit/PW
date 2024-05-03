#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "membres/ahmed_membre.h"
#include "membres/ahmed_imagewidget.h"
#include "connection.h"

#include <QBuffer>
#include <QImageReader>
#include <QPixmap>
#include <QDir>

using namespace QtCharts;

Connection ahmed_c;

void MainWindow::ahmed_navigateToPage(int pageIndex)
{
    Membre M;
    bool test = true;
    if (pageIndex==1){
        M.afficher(ui->ahmed_tableau_historique,test);
    }
    ui->stackedWidget_2->setCurrentIndex(pageIndex);
}

void MainWindow::ahmed_on_pushButton_confirm_add_clicked()
{
    QString nom = ui->ahmed_put_name->text();
    QString prenom = ui->ahmed_put_prenom->text();
    QString email = ui->ahmed_put_email->text();

    // Validate 'nom', 'prenom', 'email' for non-empty
    if (nom.isEmpty() || prenom.isEmpty() || email.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Nom, prenom, and email cannot be empty."), QMessageBox::Cancel);
        return;  // Stop execution if validation fails
    }

    QString agestr = ui->ahmed_put_age->text();
    QString numeroStr = ui->ahmed_put_numero->text();

    // Validate 'age' non-empty
    if (agestr.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Invalid 'Age'. It must not be empty."), QMessageBox::Cancel);
        return;  // Stop execution if validation fails
    }

    int age = agestr.toInt();

    // Validate 'numero' length and non-empty
    if (numeroStr.length() != 8 || numeroStr.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Invalid 'numero'. It must be 8 digits and non-empty."), QMessageBox::Cancel);
        return;  // Stop execution if validation fails
    }

    int numero = numeroStr.toInt();

    // Check if an image is selected
        if (selectedImagePath.isEmpty()) {
            QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Please select an image."), QMessageBox::Cancel);
            return;  // Stop execution if no image is selected
        }

        // Read the image data
        QFile imageFile(selectedImagePath);
        if (!imageFile.open(QIODevice::ReadOnly)) {
            QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Failed to open the selected image."), QMessageBox::Cancel);
            return;
        }

        QByteArray imageData = imageFile.readAll();
        imageFile.close();

    Membre F(nom, prenom, email, age, numero, imageData);

    // Perform the insertion
    if (F.ajouter()) {
        QMessageBox::information(nullptr, QObject::tr("Success"), QObject::tr("Insertion successful."), QMessageBox::Cancel);
        ui->ahmed_put_name->clear();
        ui->ahmed_put_prenom->clear();
        ui->ahmed_put_email->clear();
        ui->ahmed_put_age->clear();
        ui->ahmed_put_numero->clear();
    } else {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Insertion failed."), QMessageBox::Cancel);
    }
}

void MainWindow::ahmed_deleteSelectedRow()
{
    QItemSelectionModel *selectionModel = ui->ahmed_tableau_historique->selectionModel();
    QModelIndexList selectedIndexes = selectionModel->selectedRows();

    if (!selectedIndexes.isEmpty()) {
        int rowToDelete = selectedIndexes.first().row();

        // Retrieve the ID or other unique identifier of the row
        QVariant idData = ui->ahmed_tableau_historique->item(rowToDelete, 0)->data(Qt::DisplayRole);
        int idToDelete = idData.toInt();

        // Delete the row from the database
        Membre Membre;  // Assuming Formation is your class for handling database operations
        if (Membre.supprimer(idToDelete)) {
            qDebug() << "Row deleted from the database: " << idToDelete;
        } else {
            qDebug() << "Failed to delete row from the database.";
            return;  // Abort the deletion if database deletion fails
        }

        // Remove the row from the QTableWidget
        ui->ahmed_tableau_historique->removeRow(rowToDelete);

        qDebug() << "Row deleted: " << rowToDelete;
    } else {
        qDebug() << "No row selected for deletion.";
    }
}

// mainwindow.cpp
void MainWindow::ahmed_validateUpdate()
{
    // Retrieve the modified data from your form's widgets
    QString nom = ui->ahmed_put_name->text();
    QString prenom = ui->ahmed_put_prenom->text();
    QString email = ui->ahmed_put_email->text();
    QString agestr = ui->ahmed_put_age->text();
    QString numeroStr = ui->ahmed_put_numero->text();

    // Retrieve the selected row's ID
    QItemSelectionModel *selectionModel = ui->ahmed_tableau_historique->selectionModel();
    QModelIndexList selectedIndexes = selectionModel->selectedRows();
    int rowToUpdate = selectedIndexes.first().row();

    ui->ahmed_put_name->setText(ui->ahmed_tableau_historique->item(rowToUpdate, 1)->text());
    ui->ahmed_put_prenom->setText(ui->ahmed_tableau_historique->item(rowToUpdate, 2)->text());
    ui->ahmed_put_email->setText(ui->ahmed_tableau_historique->item(rowToUpdate, 3)->text());
    ui->ahmed_put_age->setText(ui->ahmed_tableau_historique->item(rowToUpdate, 4)->text());
    ui->ahmed_put_numero->setText(ui->ahmed_tableau_historique->item(rowToUpdate, 5)->text());

    // Read the image data
    QFile imageFile(selectedImagePath);

    QByteArray imageData = imageFile.readAll();

    ui->stackedWidget_2->setCurrentIndex(0);
}

void MainWindow::ahmed_on_confirmUpdateButton_clicked()
{


    // Emit signal to notify MainWindow that the update is confirmed
    emit ahmed_validateUpdate();
}

void MainWindow::ahmed_update2()
{
    QString nom = ui->ahmed_put_name->text();
    QString prenom = ui->ahmed_put_prenom->text();
    QString email = ui->ahmed_put_email->text();
    QString agestr = ui->ahmed_put_age->text();
    QString numeroStr = ui->ahmed_put_numero->text();

    int age = agestr.toInt();
    int numero = numeroStr.toInt();

    QItemSelectionModel *selectionModel = ui->ahmed_tableau_historique->selectionModel();
    QModelIndexList selectedIndexes = selectionModel->selectedRows();
    int rowToUpdate = selectedIndexes.first().row();
    int idToUpdate = ui->ahmed_tableau_historique->item(rowToUpdate, 0)->text().toInt();

    // Check if an image is selected
    if (selectedImagePath.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Please select an image."), QMessageBox::Cancel);
        return;  // Stop execution if no image is selected
    }

    // Read the image data
    QFile imageFile(selectedImagePath);
    if (!imageFile.open(QIODevice::ReadOnly)) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Failed to open the selected image."), QMessageBox::Cancel);
        return;
    }

    QByteArray imageData = imageFile.readAll();

    imageFile.close();

    // Validate 'nom', 'prenom', 'email' for non-empty
    if (nom.isEmpty() || prenom.isEmpty() || email.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Nom, prenom, and email cannot be empty."), QMessageBox::Cancel);
        return;  // Stop execution if validation fails
    }

    // Validate 'age' non-empty
    if (agestr.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Invalid 'Age'. It must not be empty."), QMessageBox::Cancel);
        return;  // Stop execution if validation fails
    }

    // Validate 'numero' length and non-empty
    if (numeroStr.length() != 8 || numeroStr.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Invalid 'numero'. It must be 8 digits and non-empty."), QMessageBox::Cancel);
        return;  // Stop execution if validation fails
    }

    // Check if an image is selected
    if (selectedImagePath.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Please select an image."), QMessageBox::Cancel);
        return;  // Stop execution if no image is selected
    }

    // Read the image data
    if (!imageFile.open(QIODevice::ReadOnly)) {
        QMessageBox::critical(nullptr, QObject::tr("Error"), QObject::tr("Failed to open the selected image."), QMessageBox::Cancel);
        return;
    }

    Membre Membre;
    if (Membre.modifier(idToUpdate, nom, prenom, email, age, numero, imageData))
    {
        // Update the UI (optional)
        // For example, update the corresponding cells in the QTableWidget
        ui->ahmed_tableau_historique->item(rowToUpdate, 1)->setText(nom);
        ui->ahmed_tableau_historique->item(rowToUpdate, 2)->setText(prenom);
        ui->ahmed_tableau_historique->item(rowToUpdate, 3)->setText(email);
        ui->ahmed_tableau_historique->item(rowToUpdate, 4)->setText(agestr);
        ui->ahmed_tableau_historique->item(rowToUpdate, 5)->setText(numeroStr);

        // Retrieve the updated image data from the database
        QByteArray updatedImageData = Membre.getImageDataById(idToUpdate);
        QLabel *imageLabel = new QLabel();

        QImage image;
        image.loadFromData(updatedImageData);
        QPixmap pixmap = QPixmap::fromImage(image);
        pixmap = pixmap.scaled(Membre::IMAGE_WIDTH, Membre::IMAGE_HEIGHT, Qt::KeepAspectRatio);
        ui->ahmed_tableau_historique->setCellWidget(rowToUpdate, 6, imageLabel);

        qDebug() << "Update successful for ID: " << idToUpdate;
        ui->ahmed_put_name->clear();
        ui->ahmed_put_prenom->clear();
        ui->ahmed_put_email->clear();
        ui->ahmed_put_age->clear();
        ui->ahmed_put_numero->clear();
    }
    // Clear the image buffer
    QFile::remove(selectedImagePath);
}

void MainWindow::ahmed_search()
{
    QString searchText = ui->ahmed_search_course->text().trimmed();
    QString searchQuery = "SELECT * FROM MEMBRES WHERE ID_MEMBRE LIKE :searchText OR PRENOM LIKE :searchText OR NOM LIKE :searchText OR EMAIL LIKE :searchText OR  AGE LIKE :searchText OR NUMERO LIKE :searchText";

        qDebug() << "Connection established";
        QSqlDatabase::database().transaction();
        QSqlQuery query(ahmed_c.db);
        query.prepare(searchQuery);
        query.bindValue(":searchText", "%" + searchText + "%");

        if (query.exec()) {
            int currentRow = 0;

            // Clear existing rows in the table before populating it with the filtered results
            ui->ahmed_tableau_historique->clearContents();
            ui->ahmed_tableau_historique->setRowCount(0);

            while (query.next()) {
                ui->ahmed_tableau_historique->setRowCount(currentRow + 1);

                QTableWidgetItem *item0 = new QTableWidgetItem(query.value("ID_MEMBRE").toString());
                QTableWidgetItem *item1 = new QTableWidgetItem(query.value("NOM").toString());
                QTableWidgetItem *item2 = new QTableWidgetItem(query.value("PRENOM").toString());
                QTableWidgetItem *item3 = new QTableWidgetItem(query.value("EMAIL").toString());
                QTableWidgetItem *item4 = new QTableWidgetItem(query.value("AGE").toString());
                QTableWidgetItem *item5 = new QTableWidgetItem(query.value("NUMERO").toString());

                // Retrieve image data based on ID
                    int memberId = query.value("ID_MEMBRE").toInt();
                    Membre membre;  // Create an instance of the Membre class
                    QByteArray imageData = membre.getImageDataById(memberId);

                    // Add image data to QTableWidgetItem
                    QPixmap pixmap;
                        pixmap.loadFromData(imageData);
                        pixmap = pixmap.scaled(Membre::IMAGE_WIDTH, Membre::IMAGE_HEIGHT, Qt::KeepAspectRatio);

                        QTableWidgetItem *item6 = new QTableWidgetItem();
                        item6->setData(Qt::DecorationRole, pixmap);
                        item6->setSizeHint(pixmap.size());

                ui->ahmed_tableau_historique->setItem(currentRow, 0, item0);
                ui->ahmed_tableau_historique->setItem(currentRow, 1, item1);
                ui->ahmed_tableau_historique->setItem(currentRow, 2, item2);
                ui->ahmed_tableau_historique->setItem(currentRow, 3, item3);
                ui->ahmed_tableau_historique->setItem(currentRow, 4, item4);
                ui->ahmed_tableau_historique->setItem(currentRow, 5, item5);
                ui->ahmed_tableau_historique->setItem(currentRow, 6, item6);

                currentRow++;
                qDebug() << "Number of retrieved rows: " << currentRow;
            }
        }

        QSqlDatabase::database().commit();
        qDebug() << "Connection closed";
}

void MainWindow::ahmed_filter()
{
    // Get the filter criteria and determine the filter column
    QString filterText = ui->ahmed_sort_by->currentText();
    QString filterQuery;
    QString filterColumn;

        // If it's not an ID, check if it's a type or state
        QString lowercaseFilterText = filterText.toLower();
        if (lowercaseFilterText == "id") {
            filterColumn = "ID_MEMBRE";
        } else if (lowercaseFilterText == "nom") {
            filterColumn = "NOM";
        } else if (lowercaseFilterText == "age"){
            // Default to filtering by type if no specific column is identified
            filterColumn = "AGE";
        }

        // Order by the selected column
        filterQuery = "SELECT * FROM MEMBRES  ORDER BY " + filterColumn;

        qDebug() << "Connection established";
        QSqlDatabase::database().transaction();
        QSqlQuery query(ahmed_c.db);
        query.prepare(filterQuery);

            query.bindValue(":filterText", "%" + filterText + "%");

        if (query.exec()) {
            int currentRow = 0;

            // Clear existing rows in the table before populating it with the filtered results
            ui->ahmed_tableau_historique->clearContents();
            ui->ahmed_tableau_historique->setRowCount(0);

            while (query.next()) {
                ui->ahmed_tableau_historique->setRowCount(currentRow + 1);

                QTableWidgetItem *item0 = new QTableWidgetItem(query.value("ID_MEMBRE").toString());
                QTableWidgetItem *item1 = new QTableWidgetItem(query.value("NOM").toString());
                QTableWidgetItem *item2 = new QTableWidgetItem(query.value("PRENOM").toString());
                QTableWidgetItem *item3 = new QTableWidgetItem(query.value("EMAIL").toString());
                QTableWidgetItem *item4 = new QTableWidgetItem(query.value("AGE").toString());
                QTableWidgetItem *item5 = new QTableWidgetItem(query.value("NUMERO").toString());

                // Retrieve image data based on ID
                int memberId = query.value("ID_MEMBRE").toInt();
                Membre membre;  // Create an instance of the Membre class
                QByteArray imageData = membre.getImageDataById(memberId);

                    // Add image data to QTableWidgetItem
                    QPixmap pixmap;
                        pixmap.loadFromData(imageData);
                        pixmap = pixmap.scaled(Membre::IMAGE_WIDTH, Membre::IMAGE_HEIGHT, Qt::KeepAspectRatio);

                        QTableWidgetItem *item6 = new QTableWidgetItem();
                        item6->setData(Qt::DecorationRole, pixmap);
                        item6->setSizeHint(pixmap.size());

                ui->ahmed_tableau_historique->setItem(currentRow, 0, item0);
                ui->ahmed_tableau_historique->setItem(currentRow, 1, item1);
                ui->ahmed_tableau_historique->setItem(currentRow, 2, item2);
                ui->ahmed_tableau_historique->setItem(currentRow, 3, item3);
                ui->ahmed_tableau_historique->setItem(currentRow, 4, item4);
                ui->ahmed_tableau_historique->setItem(currentRow, 5, item5);
                ui->ahmed_tableau_historique->setItem(currentRow, 6, item6);

                currentRow++;
                qDebug() << "Number of retrieved rows: " << currentRow;
            }
        }

        QSqlDatabase::database().commit();
        qDebug() << "Connection closed";
}

void MainWindow::ahmed_exportTableToPDF()
{
    QSqlQuery query("SELECT * FROM MEMBRES");

    QTextDocument doc;
    QTextCursor cursor(&doc);

    QString htmlContent = "<h1 style='color: blue; text-align: center;'>Table des Membres</h1>";
    htmlContent += "<table style='border-collapse: collapse; width: 100%;'>";
    htmlContent += "<thead><tr>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #f2f2f2; color: #333;'>ID</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #e6f2ff; color: #333;'>Nom</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #ccf2ff; color: #333;'>Prenom</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #b3f0ff; color: #333;'>Age</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #99e6ff; color: #333;'>Numero</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #80dfff; color: #333;'>Email</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #66ccff; color: #333;'>Image</th>"
                   "</tr></thead>";
    htmlContent += "<tbody>";

    // Fetch and format data into table rows
    int rowColorIndex = 0; // Index for alternating row colors
    while (query.next()) {
        QString rowColor = (rowColorIndex++ % 2 == 0) ? "#f2f2f2" : "#ffffff"; // Alternating row colors
        htmlContent += "<tr style='background-color: " + rowColor + ";'>";
        for (int i = 0; i < query.record().count(); ++i) {
            if (i == query.record().count() - 1) { // If it's the last column (assuming it's the column for images)
                QByteArray imageData = query.value(i).toByteArray();
                QPixmap pixmap;
                pixmap.loadFromData(imageData);

                // Scale pixmap to fit max height of 100 pixels
                pixmap = pixmap.scaledToHeight(50, Qt::SmoothTransformation);

                QString imagePath = QString("%1/%2_image.png").arg(QStandardPaths::writableLocation(QStandardPaths::TempLocation)).arg(query.value(0).toString());
                pixmap.save(imagePath, "PNG");

                QUrl imageUrl = QUrl::fromLocalFile(imagePath);
                htmlContent += "<td style='border: 1px solid #000; padding: 8px; color: #333;'><img src='" + imageUrl.toString() + "'></td>";
            } else {
                htmlContent += "<td style='border: 1px solid #000; padding: 8px; color: #333;'>" + query.value(i).toString() + "</td>";
            }
        }
        htmlContent += "</tr>";
    }

    htmlContent += "</tbody></table>";
    doc.setHtml(htmlContent);

    // Get path to user's Documents directory
    QString documentsPath = QStandardPaths::writableLocation(QStandardPaths::DocumentsLocation);

    // Set the output file path to the documents directory
    QString filePath = documentsPath + "/table.pdf";

    // Create a QPrinter
    QPrinter printer;
    printer.setOutputFormat(QPrinter::PdfFormat);
    printer.setOutputFileName(filePath);

    // Print the document to the printer
    doc.print(&printer);

    if (doc.isEmpty()) {
        qDebug() << "Error printing to PDF:" ;
    }
    QMessageBox::information(nullptr, QObject::tr("Success"),
                             QObject::tr("PDF exported successful."),
                             QMessageBox::Cancel);

    qDebug() << "PDF exported successfully to:" << filePath;
}

void MainWindow::ahmed_calculateTypePercentage()
{
    // Assuming you have a QLabel named ui->pie_label
    QLabel *pieLabel = ui->ahmed_pie_label;

        QSqlQuery totalQuery("SELECT COUNT(*) FROM FORMATION", ahmed_c.db);
        if (totalQuery.next()) {
            int totalFormations = totalQuery.value(0).toInt();

            if (totalFormations > 0) {
                QSqlQuery typeQuery("SELECT AGE, COUNT(*) FROM MEMBRES GROUP BY AGE", ahmed_c.db);

                QPieSeries *series = new QPieSeries();

                while (typeQuery.next()) {
                    QString type = typeQuery.value(0).toString();
                    int count = typeQuery.value(1).toInt();

                    double percentage = (count * 100.0) / totalFormations;

                    // Add data to the pie chart series
                    series->append(type, percentage);
                }

                // Create the chart and set the series
                QChart *chart = new QChart();
                chart->addSeries(series);
                chart->setTitle("Formation Types Distribution");

                // Create a chart view and set it as the central widget
                QChartView *chartView = new QChartView(chart);

                // Convert the chart view to an image
                QPixmap pixmap = chartView->grab();

                // Set the image to the QLabel
                pieLabel->setPixmap(pixmap);
            } else {
                qDebug() << "No formations found.";
            }
        } else {
            qDebug() << "Failed to retrieve total formations.";
        }

        ahmed_c.db.close();
}

void MainWindow::on_imageButton_clicked()
{
    // Open a file dialog to select an image
    QString imagePath = QFileDialog::getOpenFileName(this, tr("Select Image"), QDir::homePath(), tr("Image Files (*.png *.jpg *.bmp *.gif)"));

    if (!imagePath.isEmpty()) {
        // Set the image path to a member variable for later use
        selectedImagePath = imagePath;

        // Optionally, display the selected image in a QLabel or other widget
        // For example, if you have a QLabel named ui->imageLabel:
        // ui->imageLabel->setPixmap(QPixmap(imagePath));
        qDebug() << "Selected Image Path: " << imagePath;
    }
}

QString MainWindow::ahmed_callPythonFunction(){
    //qDebug() << "Current directory:" << QDir::currentPath();

    QProcess pythonProcess;
    pythonProcess.start("python", QStringList() << "E:/QTPROJECTS/ProjetCPP/membres/FaceID/main.py");
        if (!pythonProcess.waitForStarted() || !pythonProcess.waitForFinished()) {
            qDebug() << "Error: Failed to execute Python script";
            return 0;
     }
     QByteArray output = pythonProcess.readAllStandardOutput();

     output.chop(2);

     QString outputstr = QString::fromUtf8(output);

     qDebug() << "Python Output:" << output;

     return outputstr;
}

void MainWindow::ahmed_CheckFaceID() {
    // Get the selected row number

   ahmed_callPythonFunction();
    /*int selectedRow = ui->ahmed_tableau_historique->currentRow();
    int columnNumber = 6;
    // Check if a row is selected
    if (selectedRow != -1) {
        // Iterate over the items in the selected row
        QList<QTableWidgetItem*> items = ui->ahmed_tableau_historique->selectedItems();
        foreach (QTableWidgetItem *item, items) {
            // Check if the item belongs to the desired column
            if (item->column() == columnNumber) {
                // Print the content of the item
                qDebug() << "Content of column" << columnNumber << "in selected row:" << item->text();
                // Or display it in a QLabel, QLineEdit, etc.
            }
        }
    } else {
        qDebug() << "No row selected.";
    }*/
}

void MainWindow::ahmed_historique(){
    QItemSelectionModel *selectionModel = ui->ahmed_tableau_historique->selectionModel();
    QModelIndexList selectedIndexes = selectionModel->selectedRows();
    int rowData = selectedIndexes.first().row();
    int id = ui->ahmed_tableau_historique->item(rowData, 0)->text().toInt();

    Membre M;

    M.getHistorique(id,ui->ahmed_tableau_historique_2);

    ui->stackedWidget_2->setCurrentIndex(3);

}
