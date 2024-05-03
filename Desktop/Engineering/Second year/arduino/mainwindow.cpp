#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <QStackedWidget>
#include <QVBoxLayout>
#include <QUiLoader>
#include <QFile>
#include <QTextStream>
#include <QDebug>
#include <QPushButton>
#include "login/maininterface.h"
#include "reservation/reservation2.h"
#include "projets/projet.h"
#include "Room/room.h"
#include <QIcon>
#include <QTextStream>
#include <QDebug>
#include <QPushButton>
#include <QTableWidgetItem>
#include <QMessageBox>
#include <QHBoxLayout>
#include <QPrinter>
#include <QPainter>
#include <QFileDialog>
#include <QAxObject>
#include <QFontDatabase>
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
#include <QIcon>
#include <QTextStream>
#include <QDebug>

#include <QPushButton>
#include <QTableWidgetItem>
#include <QMessageBox>

#include <QHBoxLayout>
#include <QPrinter>
#include <QPainter>
#include <QFileDialog>
#include <QAxObject>
#include <QFontDatabase>

#include <fstream>      // For std::ifstream
#include <sstream>      // For std::stringstream
#include <iostream>     // For std::cerr (optional)

#include <map>
#include <algorithm>
#include <QMessageBox>
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



QString roole;
MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent),
      ui(new Ui::MainWindow)
{

    int connectionResult = A.connect_arduino();
        if (connectionResult == 0) {
            qDebug() << "Successfully connected to Arduino!";
        } else {
            qDebug() << "Failed to connect to Arduino.";
        }

        QTimer *timer = new QTimer(this);
        connect(timer, &QTimer::timeout, this, &MainWindow::readFromArduinoPeriodically);
        timer->start(1500);
    ui->setupUi(this);
    ui->icon_only_widget->hide();
    navigateToPage(0);
    ui->home_btn_2->setChecked(true);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(0, QHeaderView::ResizeToContents);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(1, QHeaderView::Stretch);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(2, QHeaderView::Stretch);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(3, QHeaderView::Stretch);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(4, QHeaderView::ResizeToContents);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(5, QHeaderView::ResizeToContents);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(6, QHeaderView::ResizeToContents);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(7, QHeaderView::ResizeToContents);
    ui->ProjectTable_6->horizontalHeader()->setSectionResizeMode(8, QHeaderView::ResizeToContents);
    ui->ProjectTable_6->horizontalHeader()->show();

    connect(ui->home_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(0); });
    connect(ui->home_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(0); });
    connect(ui->ahmed_f_add_course, &QPushButton::clicked, this, [this]() { ahmed_navigateToPage(0); });
    connect(ui->ahmed_f_liste_courses, &QPushButton::clicked, this, [this]() { ahmed_navigateToPage(1); });
    connect(ui->ahmed_f_statistics, &QPushButton::clicked, this, [this]() { ahmed_navigateToPage(2); });
    connect(ui->ahmed_confirm_add, &QPushButton::clicked, this, &MainWindow::ahmed_on_pushButton_confirm_add_clicked);
    connect(ui->ahmed_delete_button, &QPushButton::clicked, this, &MainWindow::ahmed_deleteSelectedRow);
    connect(ui->ahmed_update_button, &QPushButton::clicked, this, &MainWindow::ahmed_on_confirmUpdateButton_clicked);
    connect(ui->ahmed_confirm_update, &QPushButton::clicked, this, &MainWindow::ahmed_update2);
    connect(ui->ahmed_search_button, &QPushButton::clicked, this, &MainWindow::ahmed_search);
    connect(ui->ahmed_sort_button, &QPushButton::clicked, this, &MainWindow::ahmed_filter);
    connect(ui->ahmed_generate_pdf, &QPushButton::clicked, this, &MainWindow::ahmed_exportTableToPDF);
    connect(ui->ahmed_f_statistics, &QPushButton::clicked, this, &MainWindow::ahmed_calculateTypePercentage);
    connect(ui->ahmed_face_id_button, &QPushButton::clicked, this, &MainWindow::ahmed_CheckFaceID);
    connect(ui->ahmed_historique_button, &QPushButton::clicked, this, &MainWindow::ahmed_historique);
    connect(ui->ahmed_image_add, &QPushButton::clicked, this, &MainWindow::on_imageButton_clicked);

    connect(ui->nour_f_add_course, &QPushButton::clicked, this, [this]() { nour_navigateToPage(0); });
    connect(ui->nour_f_liste_courses, &QPushButton::clicked, this, [this]() { nour_navigateToPage(1); });
    connect(ui->nour_f_statistics, &QPushButton::clicked, this, [this]() { nour_navigateToPage(2); });
    connect(ui->nour_confirm_add, &QPushButton::clicked, this, &MainWindow::nour_on_pushButton_confirm_add_clicked);
    connect(ui->nour_delete_button, &QPushButton::clicked, this, &MainWindow::nour_deleteSelectedRow);
    connect(ui->nour_update_button, &QPushButton::clicked, this, &MainWindow::nour_on_confirmUpdateButton_clicked);
    connect(ui->nour_confirm_update, &QPushButton::clicked, this, &MainWindow::nour_aa);

    connect(ui->nour_sort_button, &QPushButton::clicked, this, &MainWindow::nour_filter);
    connect(ui->nour_search_button, &QPushButton::clicked, this, &MainWindow::nour_search);
    connect(ui->nour_f_statistics, &QPushButton::clicked, this, [this]() {
        nour_calculateTypePercentage();
        nour_calculateStateDistribution();
    });

    connect(ui->nour_generate_pdf, &QPushButton::clicked, this, &MainWindow::nour_exportTableToPDF);
    connect(ui->nour_generate_certif, &QPushButton::clicked, this, &MainWindow::nour_on_generate_certif_clicked);

    Rolebase("Project");
    afficher("SELECT * FROM PROJETS");
    qDebug () << A.readFromArduino()<<"arduinoooooooooooooo";
    UpdatefillComboBox();
    connect(ui->addProjBtn, &QPushButton::clicked, this, [this]() { navigateToPageProject(0); });
    connect(ui->listBtn, &QPushButton::clicked, this, [this]() { navigateToPageProject(1); });
    connect(ui->editBtn, &QPushButton::clicked, this, [this]() { navigateToPageProject(2); });
    connect(ui->statBtn, &QPushButton::clicked, this, [this]() { navigateToPageProject(3); });
    projet P;
    connect(ui->AddButton_11, &QPushButton::clicked, this, [this]() { ajouterProjectBtn(); });
    connect(ui->LoadBtn_6, &QPushButton::clicked, this, &MainWindow::loadButtonClicked);
    connect(ui->AddButton_12, &QPushButton::clicked, this, &MainWindow::updateProject);
    connect(ui->projet_generate_pdf_6, &QPushButton::clicked, this, &MainWindow::projet_exportTableToPDF);
    connect(ui->projet_search_button_6, &QPushButton::clicked, this, &MainWindow::Psearch);
    connect(ui->projet_sort_button_6, &QPushButton::clicked, this, &MainWindow::Psort);
    projet_calculateTypePercentage();


    QPushButton *changeButton = findChild<QPushButton*>("change_btn");
    QPushButton *ct = findChild<QPushButton*>("user_btn");
    if (changeButton && ct) {
        changeButton->setCursor(Qt::PointingHandCursor);
        ct->setCursor(Qt::PointingHandCursor);
    } else {
       qDebug() << "test";
    }
    QFile styleFile("C:/Users/traxg/Desktop/clone/2a7-eternal-union/style.qss");

    if (styleFile.exists()) {
        if (styleFile.open(QFile::ReadOnly | QFile::Text)) {
            QTextStream stream(&styleFile);
            QString styleSheet = stream.readAll();
            setStyleSheet(styleSheet);
            styleFile.close();
        } else {
            qDebug() << "Error opening style.qss file:" << styleFile.errorString();
        }
    } else {
        qDebug() << "style.qss file not found";
    }
}

void MainWindow::navigateToPage(int pageIndex)
{
    ui->stackedWidget->setCurrentIndex(pageIndex);

    if (pageIndex==5) {
        maininterface *listWidget = new maininterface(this);
        ui->stackedWidget->addWidget(listWidget);
        ui->stackedWidget->setCurrentWidget(listWidget);
}

    if (pageIndex==2) {
        reservation2 *listWidget = new reservation2(this);
        ui->stackedWidget->addWidget(listWidget);
        ui->stackedWidget->setCurrentWidget(listWidget);
}

    if (pageIndex==6) {
        Room *listWidget = new Room(this);
        ui->stackedWidget->addWidget(listWidget);
        ui->stackedWidget->setCurrentWidget(listWidget);
}
}
void MainWindow::Rolebase(QString role)
{   // Enable buttons based on the role
   if (role == "Room") {
       connect(ui->dashborad_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(6); });
       connect(ui->dashborad_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(6); });

       // Setting Cursor type
       ui->courses->setCursor(Qt::ForbiddenCursor);
        ui->orders_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->products_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->Employee->setCursor(Qt::ForbiddenCursor);
        ui->Employee_2->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->products_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->orders_btn_2->setCursor(Qt::ForbiddenCursor);

        // Setting checkable
        ui->courses->setCheckable(false);
        ui->orders_btn_1->setCheckable(false);
        ui->products_btn_1->setCheckable(false);
        ui->customers_btn_1->setCheckable(false);
        ui->Employee->setCheckable(false);
        ui->Employee_2->setCheckable(false);
        ui->customers_btn_2->setCheckable(false);
        ui->products_btn_2->setCheckable(false);
        ui->orders_btn_2->setCheckable(false);
}
    if (role == "Reservation") {
        connect(ui->orders_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(2); });
        connect(ui->orders_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(2); });


        // Setting Cursor type
        ui->courses->setCursor(Qt::ForbiddenCursor);
        ui->products_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->Employee->setCursor(Qt::ForbiddenCursor);
        ui->Employee_2->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->products_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->dashborad_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->dashborad_btn_2->setCursor(Qt::ForbiddenCursor);

         // Setting checkable
        ui->courses->setCheckable(false);
        ui->products_btn_1->setCheckable(false);
        ui->customers_btn_1->setCheckable(false);
        ui->Employee->setCheckable(false);
        ui->Employee_2->setCheckable(false);
        ui->customers_btn_2->setCheckable(false);
        ui->products_btn_2->setCheckable(false);
        ui->dashborad_btn_1->setCheckable(false);
        ui->dashborad_btn_2->setCheckable(false);

}
    if (role == "Formation") {
        connect(ui->courses, &QPushButton::toggled, this, [this]() { navigateToPage(1); });
        connect(ui->courses, &QPushButton::toggled, this, [this]() { navigateToPage(1); });
        // Setting Cursor type
        ui->orders_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->products_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->Employee->setCursor(Qt::ForbiddenCursor);
        ui->Employee_2->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->products_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->orders_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->dashborad_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->dashborad_btn_2->setCursor(Qt::ForbiddenCursor);

        // Setting checkable
        ui->orders_btn_1->setCheckable(false);
        ui->products_btn_1->setCheckable(false);
        ui->customers_btn_1->setCheckable(false);
        ui->Employee->setCheckable(false);
        ui->Employee_2->setCheckable(false);
        ui->customers_btn_2->setCheckable(false);
        ui->products_btn_2->setCheckable(false);
        ui->orders_btn_2->setCheckable(false);
        ui->dashborad_btn_1->setCheckable(false);
        ui->dashborad_btn_2->setCheckable(false);

}
    if (role == "Project") {
        connect(ui->products_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(3); });
        connect(ui->products_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(3); });

        // Setting Cursor type
        ui->courses->setCursor(Qt::ForbiddenCursor);
        ui->orders_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->Employee->setCursor(Qt::ForbiddenCursor);
        ui->Employee_2->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->orders_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->dashborad_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->dashborad_btn_2->setCursor(Qt::ForbiddenCursor);

        // Setting checkable
        ui->courses->setCheckable(false);
        ui->orders_btn_1->setCheckable(false);
        ui->customers_btn_1->setCheckable(false);
        ui->Employee->setCheckable(false);
        ui->Employee_2->setCheckable(false);
        ui->customers_btn_2->setCheckable(false);
        ui->orders_btn_2->setCheckable(false);
        ui->dashborad_btn_1->setCheckable(false);
        ui->dashborad_btn_2->setCheckable(false);
        ui->products_btn_1->setCheckable(true);
        ui->products_btn_2->setCheckable(true);

}
    if (role == "Members") {
        connect(ui->customers_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(4); });
        connect(ui->customers_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(4);});

        // Setting Cursor type
        ui->courses->setCursor(Qt::ForbiddenCursor);
        ui->orders_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->products_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->customers_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->Employee->setCursor(Qt::ForbiddenCursor);
        ui->Employee_2->setCursor(Qt::ForbiddenCursor);
        ui->products_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->orders_btn_2->setCursor(Qt::ForbiddenCursor);
        ui->dashborad_btn_1->setCursor(Qt::ForbiddenCursor);
        ui->dashborad_btn_2->setCursor(Qt::ForbiddenCursor);

       // Setting checkable
        ui->courses->setCheckable(false);
        ui->orders_btn_1->setCheckable(false);
        ui->products_btn_1->setCheckable(false);
        ui->customers_btn_1->setCheckable(false);
        ui->Employee->setCheckable(false);
        ui->Employee_2->setCheckable(false);
        ui->products_btn_2->setCheckable(false);
        ui->orders_btn_2->setCheckable(false);
        ui->dashborad_btn_1->setCheckable(false);
        ui->dashborad_btn_2->setCheckable(false);

}    if (role == "admin"){
        connect(ui->customers_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(4); });
        connect(ui->customers_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(4);});
        connect(ui->products_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(3); });
        connect(ui->products_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(3); });
        connect(ui->dashborad_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(6); });
        connect(ui->dashborad_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(6); });
        connect(ui->orders_btn_1, &QPushButton::toggled, this, [this]() { navigateToPage(2); });
        connect(ui->orders_btn_2, &QPushButton::toggled, this, [this]() { navigateToPage(2); });
        connect(ui->courses, &QPushButton::toggled, this, [this]() { navigateToPage(1); });
        connect(ui->Employee, &QPushButton::toggled, this, [this]() { navigateToPage(5); });
        connect(ui->Employee_2, &QPushButton::toggled, this, [this]() { navigateToPage(5); });

    }
    }


MainWindow::~MainWindow()
{
    delete ui;
}
void MainWindow::ajouterProjectBtn() {
    // recupertaion
    QString nom = ui->projectNameInput_11->text().trimmed();
    QString type = ui->projectTypeInput_11->text().trimmed();
    QString desc = ui->ProjectDescInput_11->toPlainText().trimmed();
    QString etat = ui->projectTypeInput_11->text().trimmed();
    QString dd = ui->dateDebutInput_11->text().trimmed();
    QString df = ui->dateFinInput_11->text().trimmed();

    // Input validation
    if (nom.isEmpty() || type.isEmpty() || desc.isEmpty() || etat.isEmpty() || dd.isEmpty() || df.isEmpty()) {
        QMessageBox::critical(this, tr("Error"), tr("Please fill in all the fields."), QMessageBox::Ok);
        return;
    }

    QDate startDate = QDate::fromString(dd, "dd/MM/yyyy");
    QDate endDate = QDate::fromString(df, "dd/MM/yyyy");

    QString formattedStartDate = startDate.toString("dd/MM/yyyy");
    QString formattedEndDate = endDate.toString("dd/MM/yyyy");

    qDebug() << formattedStartDate << "   " << formattedEndDate;
    projet P(1, nom, type, desc, etat, formattedStartDate, formattedEndDate);

    bool test = P.ajouter();

    if (test) {
        QMessageBox::information(this, tr("Success"), tr("Addition successful.\nClick Cancel to exit."), QMessageBox::Cancel);
    } else {
        QMessageBox::critical(this, tr("Error"), tr("Addition failed.\nClick Cancel to exit."), QMessageBox::Cancel);
    }

    afficher("SELECT * FROM PROJETS");
    UpdatefillComboBox();
}
void MainWindow::navigateToPageProject(int pageIndex)
{
    ui->ProjectStackedWidget->setCurrentIndex(pageIndex);
}


void MainWindow::afficher(QString x) {
    QSqlDatabase db;

    // Check if a connection with the same name already exists
    if (QSqlDatabase::contains("qt_sql_default_connection")) {
        db = QSqlDatabase::database("qt_sql_default_connection");
    } else {
        db = QSqlDatabase::addDatabase("QODBC", "qt_sql_default_connection");
        db.setDatabaseName("testQT1");
        db.setUserName("trax");
        db.setPassword("trax");

        if (!db.open()) {
            qDebug() << "Database connection error:" << db.lastError().text();
            return;
        }

        qDebug() << "Connexion établie";
    }

    QSqlQuery Query_Get_Data(db);
    if (Ptemp.afficher(Query_Get_Data,x)) {
        int currentRow = 0;

        while (Query_Get_Data.next()) {
            qDebug () << "entred"<<endl;
            ui->ProjectTable_6->setRowCount(currentRow+1);

            QTableWidgetItem *item = new QTableWidgetItem(Query_Get_Data.value("ID_PROJET").toString());
            QTableWidgetItem *item1 = new QTableWidgetItem(Query_Get_Data.value("NOM_PROJET").toString());
            QTableWidgetItem *item2 = new QTableWidgetItem(Query_Get_Data.value("TYPE").toString());
            QTableWidgetItem *item3 = new QTableWidgetItem(Query_Get_Data.value("DATE_DEBUT").toString());
            QTableWidgetItem *item4 = new QTableWidgetItem(Query_Get_Data.value("DATE_FIN").toString());
            QTableWidgetItem *item5 = new QTableWidgetItem(Query_Get_Data.value("ETAT").toString());
            QTableWidgetItem *name = new QTableWidgetItem("hamouda ben abdennebi");
            QTableWidgetItem *state = new QTableWidgetItem("in process");





            std::string filename = "C:/Users/traxg/Desktop/clone/2a7-eternal-union/projets/data.csv";
            std::vector<Sample> data = readDataFromCSV(filename);

            linearRegression(data);

            std::string filename2 = "C:/Users/traxg/Desktop/clone/2a7-eternal-union/projets/dataR.csv";
            std::vector<Project> projects = readProjectsFromFile(filename2);





            ui->ProjectTable_6->setItem(currentRow, 0, item);
            ui->ProjectTable_6->setItem(currentRow, 2, item1);
            ui->ProjectTable_6->setItem(currentRow, 1, name);
            ui->ProjectTable_6->setItem(currentRow, 3, item2);
            ui->ProjectTable_6->setItem(currentRow, 4, item3);
            ui->ProjectTable_6->setItem(currentRow, 5, item4);
            ui->ProjectTable_6->setItem(currentRow, 6, state);

            QPushButton *button1 = new QPushButton("");
            QPushButton *button3 = new QPushButton("");

            button1->setStyleSheet("QPushButton { border: none; background-color: transparent; }");
            button3->setStyleSheet("QPushButton { border: none; background-color: transparent; }");



            // Set icon for button1
            button1->setIcon(QIcon("C:/Users/traxg/Desktop/clone/2a7-eternal-union/icon/5989084.png"));
            button1->setIconSize(QSize(25, 25));
            button1->setToolTip("recomandation");

            // Set icon for button3
            button3->setIcon(QIcon(":/icon/icon/delete_3983957.png"));
            button3->setIconSize(QSize(25, 25));
            button3->setToolTip("delete");

            // Set the size of the buttons to match the size of the icons
            button1->setFixedSize(35, 35);
            button3->setFixedSize(35, 35);

            QString projectId = Query_Get_Data.value("ID_PROJET").toString();
            QString projectname = Query_Get_Data.value("NOM_PROJET").toString();
            QString projecttype = Query_Get_Data.value("TYPE").toString();
            QString projectdesc = Query_Get_Data.value("DESCRIPTION").toString();
            QString projectstate = Query_Get_Data.value("ETAT").toString();
            QString projectdd = Query_Get_Data.value("DATE_DEBUT").toString();
            QString projectdf = Query_Get_Data.value("DATE_FIN").toString();

            QString dateFormat = "yyyy-MM-ddTHH:mm:ss";
            QDate startDate = QDate::fromString(projectdd, dateFormat);
            QDate endDate = QDate::fromString(projectdf, dateFormat);


            int duration = startDate.daysTo(endDate);
            std::string strType = projecttype.toStdString();
            double calculatedPrice = predictedPrice(data, 45, strType);

            qDebug() << "Predicted price for " << 45 << " days of " << projecttype << " project: " << calculatedPrice;

            QString srtPred = doubleToQString(calculatedPrice) + " DT";

            QTableWidgetItem *price = new QTableWidgetItem(srtPred);
            ui->ProjectTable_6->setItem(currentRow, 7, price);

            connect(button3, &QPushButton::clicked, [=]() {

                QString projectId = item->text();
                QString projectname = item->text();
                QString projecttype = item->text();
                QString projectdesc = item->text();
                QString projectstate = item->text();
                QString projectdd = item->text();
                QString projectdf = item->text();
                projet P(projectId.toInt(), projectname, projecttype, projectdesc, projectstate, projectdd, projectdf);
                bool result = P.suprimer();
                afficher("SELECT * FROM PROJETS");
                UpdatefillComboBox();

                if (result) {
                    QMessageBox::information(nullptr, QObject::tr("OK"),
                                             QObject::tr("Suppression effectuée\n"
                                                         "Cliquez sur Annuler pour quitter"), QMessageBox::Cancel);
                } else {
                    QMessageBox::critical(nullptr, QObject::tr("Erreur"),
                                          QObject::tr("La suppression n'a pas été effectuée\n"
                                                      "Cliquez sur Annuler pour quitter"), QMessageBox::Cancel);
                }
            });

            std::string bestTech = findBestTechnology(projects, strType, 45);
            QString qBestTech = QString::fromStdString(bestTech);
            qDebug()<<"REC    ------------------- -------------------------------------"<<qBestTech;
            connect(button1, &QPushButton::clicked, this, [this, qBestTech]() {
                openMessageBox(qBestTech);
            });



            QHBoxLayout *buttonLayout = new QHBoxLayout;
            buttonLayout->addWidget(button1);
            buttonLayout->addWidget(button3);

            QWidget *buttonContainer = new QWidget();
            buttonContainer->setLayout(buttonLayout);

            // Remove margins of the button layout
            buttonLayout->setContentsMargins(0, 0, 0, 0);

            // Set the alignment of the layout to center the buttons
            buttonLayout->setAlignment(Qt::AlignCenter);

            ui->ProjectTable_6->setCellWidget(currentRow, 8, buttonContainer);

            currentRow++;
            qDebug() << "Nombre de lignes récupérées : " << currentRow;
        }
    } else {
        qDebug() << "Error executing query:" << Query_Get_Data.lastError().text();
    }

    QSqlDatabase::database().commit();
}
void MainWindow::UpdatefillComboBox() {
    QSqlDatabase db;

    // Check if a connection with the same name already exists
    if (QSqlDatabase::contains("qt_sql_default_connection")) {
        db = QSqlDatabase::database("qt_sql_default_connection");
    } else {
        db = QSqlDatabase::addDatabase("QODBC", "qt_sql_default_connection");
        db.setDatabaseName("testQT1");
        db.setUserName("trax");
        db.setPassword("trax");

        if (!db.open()) {
            qDebug() << "Database connection error:" << db.lastError().text();
            return;
        }

        qDebug() << "Connexion établie";
    }

    // Clear the existing items in the combobox
    ui->ProjectIDCB_6->clear();

    QSqlQuery query(db);
    query.prepare("SELECT ID_PROJET FROM PROJETS");

    if (query.exec()) {
        while (query.next()) {
            QString columnName = query.value(0).toString();
            qDebug() <<columnName;
            ui->ProjectIDCB_6->addItem(columnName);
        }
    } else {
        qDebug() << "Error executing query:" << query.lastError().text();
    }
}

void MainWindow::loadButtonClicked() {
    // Get the selected value from the ComboBox
    QString selectedId = ui->ProjectIDCB_6->currentText();

    // Use the selected ID to fetch information from the database
    fetchProjectInfo(selectedId);
}

void MainWindow::fetchProjectInfo(const QString& projectId) {
    // Assuming you have a QSqlQueryModel or similar to fetch data
    QSqlQueryModel* model = new QSqlQueryModel();
    model->setQuery(QString("SELECT * FROM PROJETS WHERE ID_PROJET = '%1'").arg(projectId));

    if (model->rowCount() > 0) {
        // Assuming you have QLineEdit and QTextEdit widgets
        ui->projectNameInput_12->setText(model->record(0).value("NOM_PROJET").toString());
        ui->projectTypeInput_12->setText(model->record(0).value("TYPE").toString());
        ui->ProjectDescInput_12->setPlainText(model->record(0).value("DESCRIPTION").toString());

        // Assuming DATEDEBUT and DATEFIN are column names in your database
        QDateTime startDate = model->record(0).value("DATEDE_BUT").toDateTime();
        QDateTime endDate = model->record(0).value("DATE_FIN").toDateTime();

        ui->dateDebutInput_12->setDateTime(startDate);
        ui->dateFinInput_12->setDateTime(endDate);

        // Add more line edits or update your UI elements as needed
    } else {
        // Handle the case where no data is found for the selected ID
        // For example, clear the QLineEdit and QTextEdit widgets
        ui->projectNameInput_12->clear();
        ui->projectTypeInput_12->clear();
        ui->ProjectDescInput_12->clear();
        ui->dateDebutInput_12->setDateTime(QDateTime::currentDateTime());
        ui->dateFinInput_12->setDateTime(QDateTime::currentDateTime());
        // Add similar lines for other line edits and text edits
    }
}

void MainWindow::updateProject() {
    QString selectedProjectId = ui->ProjectIDCB_6->currentText();

    // Retrieve updated data from UI elements
    QString updatedName = ui->projectNameInput_12->text();
    QString updatedTitle = ui->projectTypeInput_12->text();
    QString updatedDesc = ui->ProjectDescInput_12->toPlainText();
    // Retrieve other updated data as needed

    // Validate inputs
    if (updatedName.isEmpty() || updatedTitle.isEmpty() || updatedDesc.isEmpty()) {
        QMessageBox::critical(this, tr("Error"), tr("All fields must be filled."), QMessageBox::Cancel);
        return;  // Stop execution if any input is invalid
    }

    // Add more validation logic as needed
    projet P( selectedProjectId.toInt() , updatedName , updatedTitle , updatedDesc , "en cours" , ui->dateDebutInput_12->text() , ui->dateFinInput_12->text() );
    // Update the record in the database
    bool success = P.modifier(updatedName, updatedTitle, updatedDesc);

    if (success) {
        QMessageBox::information(this, tr("Success"), tr("Project updated successfully."));
        afficher("SELECT * FROM PROJETS");
        UpdatefillComboBox();
        fetchProjectInfo(selectedProjectId);
    } else {
        QMessageBox::critical(this, tr("Error"), tr("Failed to update project."));
    }
}

void MainWindow::projet_exportTableToPDF()
{
    QSqlQuery query("SELECT * FROM PROJETS");
    QTextDocument doc;
    QTextCursor cursor(&doc);

    QString htmlContent = "<h1 style='color: blue; text-align: center;'>Table des projets</h1>";
    htmlContent += "<table style='border-collapse: collapse; width: 100%;'>";
    htmlContent += "<thead><tr>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #f2f2f2; color: #333;'>ID</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #e6f2ff; color: #333;'>Nom</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #ccf2ff; color: #333;'>description</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #b3f0ff; color: #333;'>date debut</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #99e6ff; color: #333;'>date fin</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #80dfff; color: #333;'>etat</th>"
                   "<th style='border: 1px solid #000; padding: 8px; text-align: left; background-color: #66ccff; color: #333;'>type</th>"
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
                             QObject::tr("PDF exported successful ."),
                             QMessageBox::Cancel);

    qDebug() << "PDF exported successfully to:" << filePath;
}



std::vector<Sample> MainWindow::readDataFromCSV(const std::string& filename) {
    std::vector<Sample> data;
    QFile file(QString::fromStdString(filename));

    if (!file.open(QIODevice::ReadOnly)) {
        qDebug() << "Error opening file: " << file.errorString();
        return data;
    }

    QTextStream in(&file);
    while (!in.atEnd()) {
        QString line = in.readLine();
        QStringList fields = line.split(","); // Assuming comma (,) is the delimiter

        // Check if the line has at least three fields
        if (fields.size() < 3) {
            qDebug() << "Error parsing line: " << line;
            continue;
        }

        Sample sample;
        sample.type = fields[0].trimmed().toStdString(); // Convert QString to std::string
        sample.price = fields[1].trimmed().toDouble(); // Assuming price is the second field
        sample.duration = fields[2].trimmed().toInt(); // Assuming duration is the third field
        data.push_back(sample);
    }

    file.close();
    return data;
}

void MainWindow::linearRegression(const std::vector<Sample>& data) {
    double sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
    int n = data.size();

    for (const auto& sample : data) {
        sumX += sample.duration;
        sumY += sample.price;
        sumXY += sample.duration * sample.price;
        sumX2 += sample.duration * sample.duration;
    }

    double meanX = sumX / n;
    double meanY = sumY / n;

    double b = (sumXY - (sumX * sumY) / n) / (sumX2 - (sumX * sumX) / n);
    double a = meanY - b * meanX;

    qDebug() << "Linear Regression Equation: y = " << a << " + " << b << "x\n";
}


double MainWindow::predictedPrice(const std::vector<Sample>& data, double duration, const std::string& type) {
    // Filter data by project type
    std::vector<Sample> filteredData;
    for (const auto& sample : data) {
        if (sample.type == type) {
            filteredData.push_back(sample);
        }
    }

    // Perform linear regression on filtered data
    double sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
    int n = filteredData.size();

    for (const auto& sample : filteredData) {
        sumX += sample.duration;
        sumY += sample.price;
        sumXY += sample.duration * sample.price;
        sumX2 += sample.duration * sample.duration;
    }

    double meanX = sumX / n;
    double meanY = sumY / n;

    double b = (sumXY - (sumX * sumY) / n) / (sumX2 - (sumX * sumX) / n);
    double a = meanY - b * meanX;

    // Predict price for given duration
    return a + b * duration;
}
QString MainWindow::doubleToQString(double value) {
    return QString::number(value);
}



void MainWindow::Psearch(){
    QString req = "SELECT * FROM PROJETS WHERE NOM_PROJET LIKE '%" + ui->projet_search_course_6->text() + "%' OR TYPE LIKE '%" + ui->projet_search_course_6->text() + "%' OR ETAT LIKE '%" + ui->projet_search_course_6->text() + "%' OR DATE_DEBUT LIKE '%" + ui->projet_search_course_6->text() + "%' OR DATE_FIN LIKE '%" + ui->projet_search_course_6->text() + "%';";
    afficher(req);
}
void MainWindow::Psort(){
    QString req = "SELECT * FROM PROJETS ORDER BY " + ui->ProjectSortt->currentText() + ";";
    afficher(req);
}
std::vector<Project> MainWindow::readProjectsFromFile(const std::string& filename) {
    std::vector<Project> projects;
    std::ifstream file(filename);

    if (!file.is_open()) {
        qDebug() << "Error opening file: " << QString::fromStdString(filename);
        return projects;
    }

    std::string line;
    // Skip the header line
    std::getline(file, line);

    while (std::getline(file, line)) {
        std::stringstream ss(line);
        std::string type, tech;
        int duration;

        // Read type, tech, and duration separated by '|'
        if (std::getline(ss, type, '|') &&
            std::getline(ss, tech, '|') &&
            (ss >> duration)) {
            projects.push_back(Project{type, tech, duration});
        } else {
            qDebug() << "Error parsing line: " << QString::fromStdString(line);
        }

    }

    file.close();

    return projects;
}





// Function to trim leading and trailing spaces from a string
std::string MainWindow::trim(const std::string& str) {
    size_t first = str.find_first_not_of(' ');
    if (std::string::npos == first) {
        return str;
    }
    size_t last = str.find_last_not_of(' ');
    return str.substr(first, (last - first + 1));
}





std::string MainWindow::findBestTechnology(const std::vector<Project>& projects, const std::string& type, int duration) {
    std::map<std::string, int> techFrequency;

    for (const auto& project : projects) {
        if (project.type == type && project.duration == duration) {
            techFrequency[project.tech]++;
        }
    }

    if (techFrequency.empty()) {
        return "No technology found for the given type and duration.";
    }

    auto bestTech = std::max_element(techFrequency.begin(), techFrequency.end(),
                                     [](const std::pair<const std::string, int>& a, const std::pair<const std::string, int>& b) {
                                         return a.second < b.second;
                                     });

    qDebug() << "Best technology for type '" << QString::fromStdString(type) << "': " << QString::fromStdString(bestTech->first);
    return bestTech->first;
}

void MainWindow::openMessageBox(const QString& message)
{
    QMessageBox::information(this, "Information", message);

}

void MainWindow::projet_calculateTypePercentage()
{
    Connection c2;
    // Assuming you have a QLabel named ui->pie_label
    QLabel *pieLabel = ui->projet_pie_label;

        QSqlQuery totalQuery("SELECT COUNT(*) FROM PROJETS", c2.db);
        if (totalQuery.next()) {
            int totalFormations = totalQuery.value(0).toInt();

            if (totalFormations > 0) {
                QSqlQuery typeQuery("SELECT TYPE, COUNT(*) FROM PROJETS GROUP BY TYPE", c2.db);

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
                chart->setTitle("Projects Types Distribution");

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

        c2.db.close();

}


void MainWindow::on_ahmed_image_add_clicked()
{

}
void MainWindow::readFromArduinoPeriodically()
{
    QSqlDatabase db;

    // Check if a connection with the same name already exists
    if (QSqlDatabase::contains("qt_sql_default_connection")) {
        db = QSqlDatabase::database("qt_sql_default_connection");
    } else {
        db = QSqlDatabase::addDatabase("QODBC", "qt_sql_default_connection");
        db.setDatabaseName("testQT1");
        db.setUserName("trax");
        db.setPassword("trax");
       }
    QByteArray data = A.readFromArduino();
    if (!data.isEmpty()) {
        qDebug() << "Data from Arduino:" << data;
        QString dataTrimmed = data.left(data.length() - 2);
        qDebug () <<dataTrimmed;
        // Assuming you have a valid QSqlDatabase object named 'db' set up elsewhere
        if (db.isOpen()) {
            QSqlQuery query(db);


            // Prepare the SQL query to check if the UID_CARD exists in the RESERVATION table
            query.prepare("SELECT * FROM RESERVATIONS WHERE UID_CARD = :uid");
            query.bindValue(":uid", dataTrimmed);

            // Execute the query
            if (query.exec()) {
                if (query.next()) {
                    // Data (UID_CARD) exists in the RESERVATION table
                    qDebug() << "UID_CARD" << dataTrimmed << "exists in RESERVATION";
                    QSqlQuery query2(db);
                    query2.prepare("SELECT * FROM RESERVATIONS WHERE UID_CARD = :uid AND SYSDATE BETWEEN TO_DATE(:dd, 'YYYY-MM-DD') AND TO_DATE(:df, 'YYYY-MM-DD')");
                    query2.bindValue(":uid", dataTrimmed);
                    query2.bindValue(":dd", query.value(1).toDateTime().toString("yyyy-MM-dd"));
                    query2.bindValue(":df", query.value(2).toDateTime().toString("yyyy-MM-dd"));

                    qDebug()<<"dd "<<query.value(1).toDate().toString("yyyy-MM-dd")<<" df "<<query.value(2).toDate().toString("yyyy-MM-dd");
                    if (query2.exec()) {
                        if (query2.next()) {
                            QSqlQuery queryP;
                            queryP.prepare("SELECT PROJETS.ID_PROJET, PROJETS.NOM_PROJET, PROJETS.TYPE FROM PROJETS JOIN COLLABORER ON PROJETS.ID_PROJET = COLLABORER.ID_PROJET WHERE COLLABORER.ID_RESERVATION = :IDR;");
                            queryP.bindValue(":IDR", query.value(0));
                            if (queryP.exec()) {
                                if (queryP.next()) {
                                    QString s;
                                    s = QString("id:%1,name:%2,type:%3")
                                        .arg(queryP.value(0).toString())
                                        .arg(queryP.value(1).toString())
                                        .arg(queryP.value(2).toString());

                                    // Convert QString to QByteArray
                                    QByteArray data = s.toUtf8();

                                    // Pass the QByteArray to the write_arduino function
                                    A.write_arduino(data);

                                }
                            }

                            A.write_arduino("1");
                            QSqlQuery queryM;
                            queryM.prepare("UPDATE RESERVATIONS SET ENTER = 1 WHERE UID_CARD = :id");

                            queryM.bindValue(":id", dataTrimmed);

                            if (queryM.exec()) {
                                // Check if any rows were affected by the update
                                if (query.numRowsAffected() > 0) {
                                     qDebug() << "done";
                                } else {
                                    qDebug() << "No rows were affected by the update.";
                                }
                            } else {
                                qDebug() << "Error updating project:" << query.lastError().text();
                            }



                        }else{
                            A.write_arduino("3");
                        }
                    }


                    // Add your logic here for handling the existing UID_CARD
                } else {
                    // Data (UID_CARD) does not exist in the RESERVATION table
                    qDebug() << "UID_CARD" << dataTrimmed << "does not exist in RESERVATION";
                    A.write_arduino("2");
                    // Add your logic here for handling the non-existing UID_CARD
                }
            } else {
                // Error executing the query
                qDebug() << "Query execution failed:" << query.lastError().text();
            }
        } else {
            // Database connection is not open
            qDebug() << "Database connection is not open.";
        }
    } else {
        qDebug() << "Received empty data from Arduino.";
    }
}

