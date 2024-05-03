#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "formation/formation.h"
#include "connection.h"
#include <QFile>
#include <QTextStream>
#include <QDebug>
#include <QMessageBox>
#include <QSqlError>
#include <QTableWidget>

#include <QPrinter>
#include <QPainter>
#include <QFileDialog>
#include <QAxObject>
#include <QFontDatabase>

#include <QtCharts/QPieSeries>
#include <QtCharts/QChartView>
#include <QtCharts/QPieSlice>
using namespace QtCharts;

//bar chart //
#include <QtCharts/QChart>
#include <QtCharts/QBarSet>
#include <QtCharts/QBarSeries>
#include <QtCharts/QBarCategoryAxis>
#include <QtWidgets/QVBoxLayout>

#include <QCoreApplication>
#include <QNetworkAccessManager>
#include <QNetworkRequest>
#include <QNetworkReply>
#include <QUrl>
#include <QHttpMultiPart>
#include <QHttpPart>
#include <QDragEnterEvent>
#include <QDropEvent>

#include <QJsonObject>
#include <QJsonDocument>
#include <QJsonArray>

#include <QCamera>
#include <QCameraImageCapture>
#include <QTimer>

#include<QSqlRecord>
#include<QStandardPaths>

Connection c;

void MainWindow::nour_navigateToPage(int pageIndex)
{
  Formation f;
  if (pageIndex == 1) {// Assuming 1 is the index for the "List Courses" page
      f.afficher(ui->nour_tableau_historique,test);




      }
    ui->stackedWidget_3->setCurrentIndex(pageIndex);
}

void MainWindow::nour_on_pushButton_confirm_add_clicked()
{
    // Retrieve input values
    QString nom = ui->nour_put_name->text().trimmed();
    QString type = ui->nour_put_type->text().trimmed();
    QString etat = ui->nour_put_state->currentText();
    QString description = ui->nour_description->toPlainText().trimmed();
    QString dateStringDebut = ui->nour_put_beginning->text().trimmed();
    QString dateStringFin = ui->nour_put_ending->text().trimmed();

    // Validate input
    if (nom.isEmpty() || type.isEmpty() || etat.isEmpty() || description.isEmpty() ||
        dateStringDebut.isEmpty() || dateStringFin.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"),
                              QObject::tr("Please fill in all fields."),
                              QMessageBox::Cancel);
        return;
    }

    QDate dateDebut = QDate::fromString(dateStringDebut, "MM/dd/yyyy");
    QDate dateFin = QDate::fromString(dateStringFin, "MM/dd/yyyy");

    // Check if date conversion was successful
    if (!dateDebut.isValid() || !dateFin.isValid()) {
        QMessageBox::critical(nullptr, QObject::tr("Error"),
                              QObject::tr("Invalid date format. Please use MM/dd/yyyy."),
                              QMessageBox::Cancel);
        return;
    }

    // Check if the end date is after the start date
    if (dateDebut > dateFin) {
        QMessageBox::critical(nullptr, QObject::tr("Error"),
                              QObject::tr("End date should be after the start date."),
                              QMessageBox::Cancel);
        return;
    }

    // Create Formation object
    Formation F(nom, type, etat, description, dateDebut, dateFin);

    // Perform the insertion
    if (F.ajouter()) {
        QMessageBox::information(nullptr, QObject::tr("Success"),
                                 QObject::tr("Insertion successful."),
                                 QMessageBox::Cancel);
                ui->nour_put_name->clear();
                ui->nour_put_type->clear();
                //ui->put_state->clear();
                ui->nour_description->clear();
                ui->nour_put_beginning->clear();
                ui->nour_put_ending->clear();
    } else {
        QMessageBox::critical(nullptr, QObject::tr("Error"),
                                 QObject::tr("Insertion failed."),
                                 QMessageBox::Cancel);
    }
}


void MainWindow::nour_deleteSelectedRow()
{
    QItemSelectionModel *selectionModel = ui->nour_tableau_historique->selectionModel();
    QModelIndexList selectedIndexes = selectionModel->selectedRows();


    if (!selectedIndexes.isEmpty()) {
        int rowToDelete = selectedIndexes.first().row();

        // Retrieve the ID or other unique identifier of the row
        QVariant idData = ui->nour_tableau_historique->item(rowToDelete, 0)->data(Qt::DisplayRole);
        int idToDelete = idData.toInt();

        // Delete the row from the database
        Formation formation;  // Assuming Formation is your class for handling database operations
        if (formation.supprimer(idToDelete)) {
            qDebug() << "Row deleted from the database: " << idToDelete;
        } else {
            qDebug() << "Failed to delete row from the database.";
            return;  // Abort the deletion if database deletion fails
        }

        // Remove the row from the QTableWidget
        ui->nour_tableau_historique->removeRow(rowToDelete);

        qDebug() << "Row deleted: " << rowToDelete;
    } else {
        qDebug() << "No row selected for deletion.";
    }
}

// mainwindow.cpp
void MainWindow::nour_validateUpdate()
{
    // Récupération des données modifiées depuis les widgets du formulaire
    QString nom = ui->nour_put_name->text();
    QString type = ui->nour_put_type->text();
    QString etat = ui->nour_put_state->currentText();
    QString description = ui->nour_description->toPlainText();
    QDate dateDebut = ui->nour_put_beginning->date();
    QDate dateFin = ui->nour_put_ending->date();




    // Récupération de l'ID de la ligne sélectionnée
    QItemSelectionModel *selectionModel = ui->nour_tableau_historique->selectionModel();
    QModelIndexList selectedIndexes = selectionModel->selectedRows();
    int rowToUpdate = selectedIndexes.first().row();
    int idToUpdate = ui->nour_tableau_historique->item(rowToUpdate, 0)->text().toInt();
         ui->nour_put_name->setText(ui->nour_tableau_historique->item(rowToUpdate, 1)->text());
         ui->nour_put_type->setText(ui->nour_tableau_historique->item(rowToUpdate, 2)->text());
         // Assuming put_state is a QComboBox
         QString currentState = ui->nour_tableau_historique->item(rowToUpdate, 3)->text();
         int currentIndex = ui->nour_put_state->findText(currentState);
         if (currentIndex != -1) {
             ui->nour_put_state->setCurrentIndex(currentIndex);
         } else {
             // Handle case when the state from the table doesn't exist in the combo box
             qDebug() << "State" << currentState << "not found in the combo box.";
         }

         ui->nour_description->setText(ui->nour_tableau_historique->item(rowToUpdate, 4)->text());
         ui->stackedWidget_3->setCurrentIndex(0);
        //ui->put_beginning->setDate(naissance);

    // Vérification de saisie (ajoutez vos propres conditions)
    if (nom.isEmpty() || type.isEmpty() || etat.isEmpty() || description.isEmpty())
    {
        QMessageBox::critical(this, tr("Erreur de saisie"), tr("Veuillez remplir tous les champs."), QMessageBox::Ok);
        return;  // Sortie de la fonction en cas d'erreur de saisie
    }

    // Vérification de la date de fin après la date de début
    if (dateFin <= dateDebut)
    {
        QMessageBox::critical(this, tr("Erreur de dates"), tr("La date de fin doit être postérieure à la date de début."), QMessageBox::Ok);
        return;  // Sortie de la fonction en cas d'erreur de dates
    }

    // Mise à jour des données dans la base de données
    Formation formation;
    if (formation.modifier(idToUpdate, nom, type, etat, description, dateDebut, dateFin))
    {
        // Mise à jour de l'interface utilisateur (optionnel)
        ui->nour_tableau_historique->item(rowToUpdate, 1)->setText(nom);
        ui->nour_tableau_historique->item(rowToUpdate, 2)->setText(type);
        ui->nour_tableau_historique->item(rowToUpdate, 3)->setText(etat);
        ui->nour_tableau_historique->item(rowToUpdate, 4)->setText(description);
        ui->nour_tableau_historique->item(rowToUpdate, 5)->setText(dateDebut.toString("yyyy-MM-dd"));
        ui->nour_tableau_historique->item(rowToUpdate, 6)->setText(dateFin.toString("yyyy-MM-dd"));

        // Réinitialisation des champs après la mise à jour
        ui->nour_put_name->clear();
        ui->nour_put_type->clear();
        //ui->put_state->clear();
        ui->nour_description->clear();
        ui->nour_put_beginning->setDate(QDate::currentDate());
        ui->nour_put_ending->setDate(QDate::currentDate());

        qDebug() << "Mise à jour réussie pour l'ID : " << idToUpdate;
    }
    else
    {
        qDebug() << "Échec de la mise à jour pour l'ID : " << idToUpdate;
    }
}

void MainWindow::nour_aa()
{
  QString nom = ui->nour_put_name->text();
  QString type = ui->nour_put_type->text();
  QString etat = ui->nour_put_state->currentText();
  QString description = ui->nour_description->toPlainText();
  QDate dateDebut = ui->nour_put_beginning->date();
  QDate dateFin = ui->nour_put_ending->date();

  QItemSelectionModel *selectionModel = ui->nour_tableau_historique->selectionModel();
  QModelIndexList selectedIndexes = selectionModel->selectedRows();
  int rowToUpdate = selectedIndexes.first().row();
  int idToUpdate = ui->nour_tableau_historique->item(rowToUpdate, 0)->text().toInt();


  Formation formation;
  if (formation.modifier(idToUpdate, nom, type, etat, description, dateDebut, dateFin))
  {
      // Mise à jour de l'interface utilisateur (optionnel)
      ui->nour_tableau_historique->item(rowToUpdate, 1)->setText(nom);
      ui->nour_tableau_historique->item(rowToUpdate, 2)->setText(type);
      ui->nour_tableau_historique->item(rowToUpdate, 3)->setText(etat);
      ui->nour_tableau_historique->item(rowToUpdate, 4)->setText(description);
      ui->nour_tableau_historique->item(rowToUpdate, 5)->setText(dateDebut.toString("yyyy-MM-dd"));
      ui->nour_tableau_historique->item(rowToUpdate, 6)->setText(dateFin.toString("yyyy-MM-dd"));

      // Réinitialisation des champs après la mise à jour
      ui->nour_put_name->clear();
      ui->nour_put_type->clear();
      //ui->put_state->clear();
      ui->nour_description->clear();
      ui->nour_put_beginning->setDate(QDate::currentDate());
      ui->nour_put_ending->setDate(QDate::currentDate());

      qDebug() << "Mise à jour réussie pour l'ID : " << idToUpdate;
  }


}

void MainWindow::nour_on_confirmUpdateButton_clicked()
{


    // Emit signal to notify MainWindow that the update is confirmed
    emit nour_validateUpdate();
}


//filter//////////////////////////

void MainWindow::nour_filter()
{
    // Get the filter criteria and determine the filter column
    QString filterText = ui->nour_sort_by->currentText();
    QString filterQuery;
    QString filterColumn;

    // Check if the filterText is an integer (ID)




        // If it's not an ID, check if it's a type or state
        QString lowercaseFilterText = filterText.toLower();
        if (lowercaseFilterText == "date_debut") {
            filterColumn = "DATE_DEBUT";
        } else if (lowercaseFilterText == "date_fin") {
            filterColumn = "DATE_FIN";
        } else {
            // Default to filtering by type if no specific column is identified
            filterColumn = "TYPE";
        }

        // Order by the selected column
        filterQuery = "SELECT * FROM FORMATION  ORDER BY " + filterColumn;




        qDebug() << "Connection established";
        QSqlDatabase::database().transaction();
        QSqlQuery query(c.db);
        query.prepare(filterQuery);


            query.bindValue(":filterText", "%" + filterText + "%");


        if (query.exec()) {
            int currentRow = 0;

            // Clear existing rows in the table before populating it with the filtered results
            ui->nour_tableau_historique->clearContents();
            ui->nour_tableau_historique->setRowCount(0);

            while (query.next()) {
                ui->nour_tableau_historique->setRowCount(currentRow + 1);

                // Populate the table with the retrieved data
                QTableWidgetItem *item0 = new QTableWidgetItem(query.value("ID").toString());
                QTableWidgetItem *item1 = new QTableWidgetItem(query.value("NOM").toString());
                QTableWidgetItem *item2 = new QTableWidgetItem(query.value("TYPE").toString());
                QTableWidgetItem *item3 = new QTableWidgetItem(query.value("ETAT").toString());
                QTableWidgetItem *item4 = new QTableWidgetItem(query.value("DESCRIPTION").toString());
                QTableWidgetItem *item5 = new QTableWidgetItem(query.value("DATE_DEBUT").toDate().toString("yyyy-MM-dd"));
                QTableWidgetItem *item6 = new QTableWidgetItem(query.value("DATE_FIN").toDate().toString("yyyy-MM-dd"));

                ui->nour_tableau_historique->setItem(currentRow, 0, item0);
                ui->nour_tableau_historique->setItem(currentRow, 1, item1);
                ui->nour_tableau_historique->setItem(currentRow, 2, item2);
                ui->nour_tableau_historique->setItem(currentRow, 3, item3);
                ui->nour_tableau_historique->setItem(currentRow, 4, item4);
                ui->nour_tableau_historique->setItem(currentRow, 5, item5);
                ui->nour_tableau_historique->setItem(currentRow, 6, item6);

                currentRow++;
                qDebug() << "Number of retrieved rows: " << currentRow;
            }
        }

        QSqlDatabase::database().commit();
        qDebug() << "Connection closed";
}



void MainWindow::nour_search()
{
    QString searchText = ui->nour_search_course->text().trimmed();
    QString searchQuery = "SELECT * FROM FORMATION WHERE ID LIKE :searchText OR TYPE LIKE :searchText OR ETAT LIKE :searchText OR NOM LIKE :searchText OR DESCRIPTION LIKE :searchText OR DATE_DEBUT LIKE :searchText OR DATE_FIN LIKE :searchText";

        qDebug() << "Connection established";
        QSqlDatabase::database().transaction();
        QSqlQuery query(c.db);
        query.prepare(searchQuery);
        query.bindValue(":searchText", "%" + searchText + "%");

        if (query.exec()) {
            int currentRow = 0;

            // Clear existing rows in the table before populating it with the filtered results
            ui->nour_tableau_historique->clearContents();
            ui->nour_tableau_historique->setRowCount(0);

            while (query.next()) {
                ui->nour_tableau_historique->setRowCount(currentRow + 1);

                QTableWidgetItem *item0 = new QTableWidgetItem(query.value("ID").toString());
                QTableWidgetItem *item1 = new QTableWidgetItem(query.value("NOM").toString());
                QTableWidgetItem *item2 = new QTableWidgetItem(query.value("TYPE").toString());
                QTableWidgetItem *item3 = new QTableWidgetItem(query.value("ETAT").toString());
                QTableWidgetItem *item4 = new QTableWidgetItem(query.value("DESCRIPTION").toString());
                QTableWidgetItem *item5 = new QTableWidgetItem(query.value("DATE_DEBUT").toDate().toString("yyyy-MM-dd"));
                QTableWidgetItem *item6 = new QTableWidgetItem(query.value("DATE_FIN").toDate().toString("yyyy-MM-dd"));

                ui->nour_tableau_historique->setItem(currentRow, 0, item0);
                ui->nour_tableau_historique->setItem(currentRow, 1, item1);
                ui->nour_tableau_historique->setItem(currentRow, 2, item2);
                ui->nour_tableau_historique->setItem(currentRow, 3, item3);
                ui->nour_tableau_historique->setItem(currentRow, 4, item4);
                ui->nour_tableau_historique->setItem(currentRow, 5, item5);
                ui->nour_tableau_historique->setItem(currentRow, 6, item6);

                currentRow++;
                qDebug() << "Number of retrieved rows: " << currentRow;
            }
        }

        QSqlDatabase::database().commit();
        qDebug() << "Connection closed";
}



//statistics

void MainWindow::nour_calculateTypePercentage()
{
    // Assuming you have a QLabel named ui->pie_label
    QLabel *pieLabel = ui->nour_pie_label;

        QSqlQuery totalQuery("SELECT COUNT(*) FROM FORMATION", c.db);
        if (totalQuery.next()) {
            int totalFormations = totalQuery.value(0).toInt();

            if (totalFormations > 0) {
                QSqlQuery typeQuery("SELECT TYPE, COUNT(*) FROM FORMATION GROUP BY TYPE", c.db);

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

        c.db.close();

}




void MainWindow::nour_exportTableToPDF()
{
    QSqlQuery query("SELECT * FROM FORMATION");

    QTextDocument doc;
    QTextCursor cursor(&doc);

    QString htmlContent = "<h1 style='color: blue; text-align: center;'>Table des formations</h1>";
    htmlContent += "<table style='border-collapse: collapse; width: 100%;'>";
    htmlContent += "<thead><tr>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #f2f2f2; color: #333;'>ID</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #e6f2ff; color: #333;'>Nom</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #ccf2ff; color: #333;'>Type</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #b3f0ff; color: #333;'>Etat</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #99e6ff; color: #333;'>Description</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #80dfff; color: #333;'>Date début</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #66ccff; color: #333;'>Date fin</th>"
                   "</tr></thead>";
    htmlContent += "<tbody>";

    // Fetch and format data into table rows
    int rowColorIndex = 0; // Index for alternating row colors
    while (query.next()) {
        QString rowColor = (rowColorIndex++ % 2 == 0) ? "#f2f2f2" : "#ffffff"; // Alternating row colors
        htmlContent += "<tr style='background-color: " + rowColor + ";'>";
        for (int i = 0; i < query.record().count(); ++i) {
            htmlContent += "<td style='border: 1px solid #000; padding: 8px; color: #333;'>" + query.value(i).toString() + "</td>";
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







void MainWindow::nour_generateCertificate(QString memberName, QString formationName, QString formationEndDate)
{
  // Load the certificate template image
  QImage certificateTemplate("C:/Users/nourc/Desktop/certif/certif.png");

  // Create a QPainter to draw on the image
  QPainter painter(&certificateTemplate);

  // Set font and other painting properties for member's name and formation name
  QFontDatabase::addApplicationFont("C:/Users/nourc/Desktop/certif/Parisienne-Regular.ttf");
  QFont parisienneFont("Parisienne", 40);
  painter.setFont(parisienneFont);

  // Calculate the center position for the text
  int textWidth = painter.fontMetrics().width(memberName);
  int textHeight = painter.fontMetrics().height();
  int x = (certificateTemplate.width() - textWidth) / 2;  // Center horizontally
  int y = (certificateTemplate.height() - (3 * textHeight)) / 2; // Center vertically

  // Draw member's name on the certificate at the calculated position
  painter.drawText(x, y + 260, memberName);

  // Adjust y coordinate for the formation name to be a little bit down
  y += textHeight + 360;

  // Draw formation name on the certificate
  painter.drawText(x, y, formationName);

  // Create a separate font for the date and set its size
  QFont dateFont("Arial", 20); // Adjust the size as needed

  // Set the date font for painting
  painter.setFont(dateFont);

  // Draw date at the right corner down the template
  int dateWidth = painter.fontMetrics().width(formationEndDate);
  int dateX = certificateTemplate.width() - dateWidth - 20;  // Adjusting for right margin
  int dateY = certificateTemplate.height() - textHeight - 50; // Adjusting for bottom margin
  painter.drawText(dateX - 450, dateY, formationEndDate);

  // End painting
  painter.end();

  // Save or display the generated certificate
  QString filePath = "C:/Users/nourc/Desktop/certif/your_certif.png";
  certificateTemplate.save(filePath);
  QMessageBox::information(nullptr, QObject::tr("Success"),
                           QObject::tr("Certificate saved successfully."),
                           QMessageBox::Cancel);
  qDebug() << "Certificate saved to:" << filePath;



}

bool MainWindow::nour_formationExists(const QString& formationName, QString& formationEndDate)
{
    // Open database connection
    QSqlDatabase db = QSqlDatabase::database();
    if (!db.isOpen()) {
        qDebug() << "Database connection error";
        return false;
    }

    // Prepare and execute the query
    QSqlQuery query;
    query.prepare("SELECT TO_CHAR(DATE_FIN, 'YYYY-MM-DD') FROM FORMATION WHERE NOM = :NOM");
    query.bindValue(":NOM", formationName);
    if (!query.exec()) {
        qDebug() << "Query error:" << query.lastError().text();
        return false;
    }

    // Check if the formation exists
    if (query.next()) {
        formationEndDate = query.value(0).toString();
        return true;
    } else {
        return false;
    }
}


void MainWindow::nour_on_generate_certif_clicked()
{
    // Get the member's name and formation name from user input
    QString memberName = ui->nour_participant_name_2->text();
    QString formationName = ui->nour_formation_name->text(); // Assuming this is the QLineEdit for formation name

    // Check if the formation exists in the database
    // Assuming you have a function to retrieve the formation details from the database
    QString formationEndDate;
    if (nour_formationExists(formationName, formationEndDate)) {
        // Call the generateCertificate function with the retrieved information
        nour_generateCertificate(memberName, formationName, formationEndDate);
    } else {
        // Handle case where formation doesn't exist
        QMessageBox::critical(this, tr("Error"), tr("Formation not found."), QMessageBox::Ok);
    }

    // Clear the input fields
    ui->nour_participant_name_2->clear();
    ui->nour_formation_name->clear();
}

//bar chart //


void MainWindow::nour_calculateStateDistribution()
{
    // Assuming you have a QWidget named widgetForStateDistribution
    QWidget *stateWidget = ui->nour_widgetForStateDistribution;

    // Check if the widget already has a layout
    if (stateWidget->layout()) {
        QLayout *existingLayout = stateWidget->layout();
        // Remove the existing layout and delete its contents
        QLayoutItem *item;
        while ((item = existingLayout->takeAt(0)) != nullptr) {
            delete item->widget();
            delete item;
        }
        delete existingLayout;
    }


        QSqlQuery stateQuery("SELECT ETAT, COUNT(*) FROM FORMATION GROUP BY ETAT", c.db);

        QBarSeries *series = new QBarSeries();

        while (stateQuery.next()) {
            QString state = stateQuery.value(0).toString();
            int count = stateQuery.value(1).toInt();

            QBarSet *barSet = new QBarSet(state);
            *barSet << count;

            // Add data to the bar chart series
            series->append(barSet);
        }

        // Create the chart and set the series
        QChart *chart = new QChart();
        chart->addSeries(series);
        chart->setTitle("Formation State Distribution");

        // Create a chart view and set it as the central widget
        QChartView *chartView = new QChartView(chart);

        // Set up a layout for the stateWidget
        QVBoxLayout *layout = new QVBoxLayout();
        layout->addWidget(chartView);

        // Set the layout to the stateWidget
        stateWidget->setLayout(layout);
        ui->nour_widgetForStateDistribution->setVisible(true);


        c.db.close();
}

void MainWindow::on_nour_feelings_recog_clicked() {
    // Create a new dialog
    QDialog *dialog = new QDialog;
    dialog->setWindowTitle("Face Emotion Recognition");
    dialog->resize(800, 600);

    // Create a layout
    QVBoxLayout *layout = new QVBoxLayout(dialog);

    // Create a label to display the camera viewfinder
    QLabel *cameraLabel = new QLabel;
    layout->addWidget(cameraLabel);

    // Create a text edit to display the analysis results
    QTextEdit *textEdit = new QTextEdit;
    layout->addWidget(textEdit);

    // Create a button to insert image
    /*QPushButton *insertButton = new QPushButton("Insert Image");
    layout->addWidget(insertButton);*/

    // Create a button to scan image
    QPushButton *scanButton = new QPushButton("Scan");
    layout->addWidget(scanButton);

    // Create a camera object
    QCamera *camera = new QCamera;

    // Create an image capture object
    QCameraImageCapture *imageCapture = new QCameraImageCapture(camera);
    imageCapture->setCaptureDestination(QCameraImageCapture::CaptureToBuffer); // Set the capture destination to buffer

    // Connect the signal to handle the captured image
    QObject::connect(imageCapture, &QCameraImageCapture::imageCaptured, [=](int id, const QImage &preview) {
        // Display the captured image
        cameraLabel->setPixmap(QPixmap::fromImage(preview.scaled(200, 200, Qt::KeepAspectRatio)));

        // Perform face analysis on the captured image
        QString response = K.performFaceAnalysis(preview);
        // Process the response as needed
        // For now, just print the response to the text edit
        textEdit->setText(response);
    });

    // Connect the insertButton's clicked signal to a slot
    /*QObject::connect(insertButton, &QPushButton::clicked, [=]() {
        QString imagePath = QFileDialog::getOpenFileName(dialog, "Open Image", "", "Images (*.png *.xpm *.jpg)");
        if (!imagePath.isEmpty()) {
            QImage image(imagePath);
            if (!image.isNull()) {
                cameraLabel->setPixmap(QPixmap::fromImage(image.scaled(200, 200, Qt::KeepAspectRatio)));
            } else {
                QMessageBox::critical(dialog, "Error", "Failed to load image!");
            }
        }
    });*/

    // Connect the scanButton's clicked signal to a slot
    QObject::connect(scanButton, &QPushButton::clicked, [=]() {
        // Capture image
        imageCapture->capture();
    });

    // Start the camera
    camera->start();

    // Show the dialog
    dialog->exec();
}








