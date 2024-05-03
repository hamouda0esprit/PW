#include "maininterface.h"
#include "ui_maininterface.h"
#include <QWidget>
#include <QFile>
#include <QDebug>
#include <QComboBox>
#include "userlist.h"
#include "connection.h"
#include "employee.h"
#include <QStackedWidget>
#include <QVBoxLayout>
#include <QUiLoader>
#include <QMessageBox>
#include <QFile>
#include <QFileDialog>

maininterface::maininterface(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::maininterface)
{   ui->setupUi(this);
    connect(ui->listusers, &QPushButton::clicked, this, [this]() { navigateToPage(1); });
    connect(ui->adduser, &QPushButton::clicked, this, [this]() { navigateToPage(0); });
    connect(ui->image, &QPushButton::clicked, this, &maininterface::selectimage);
}

maininterface::~maininterface()
{
    delete ui;
}
QString imagePath="";

void maininterface::on_confirm_add_2_clicked()
{
    Connection conn;
    QString nom = ui->nom->text();
    QString prenom = ui->prenom->text();
    QString login = ui->login->text();
    QString motdepasse = ui->motdepasse->text();
    QString role = ui->role->currentText();
    QString id_membre = "";

    // Check if any field is empty
    if (nom.isEmpty() || prenom.isEmpty() || login.isEmpty() || motdepasse.isEmpty() || role == "Selectionner") {
        QMessageBox::critical(this, "Error", "Please fill all fields and select a valid role.");
        return;
    }

    // Check if name and prenom contain numbers
    QRegularExpression nameAndPrenomDigit("\\d");
    if (nom.contains(nameAndPrenomDigit) || prenom.contains(nameAndPrenomDigit)) {
        QMessageBox::critical(this, "Error", "Name and prenom should not contain numbers.");
        return;
    }

    // Check if password meets the required conditions
    QRegularExpression uppercaseLetter("[A-Z]");
    QRegularExpression passwordDigit("[0-9]");

    if (motdepasse.length() < 8 || !motdepasse.contains(uppercaseLetter) || !motdepasse.contains(passwordDigit)) {
        QMessageBox::critical(this, "Error", "Password does not meet the required conditions: It should contain at least 8 characters, start with an uppercase letter, and include at least one digit.");
        return;
    }

    // Read the image file
    QFile file(imagePath);
    if (!file.open(QIODevice::ReadOnly)) {
        QMessageBox::critical(this, "Error", "Failed to open image file.");
        return;
    }
    QByteArray imageData = file.readAll();
    file.close();

    if (conn.createconnect()) {
        int maxId = conn.getMaxId() + 1;
        QString newIdString = QString::number(maxId);

        EMPLOYEE e(newIdString.toInt(), nom, prenom, login, motdepasse, role, imageData, id_membre);
        if (e.ajouter()) {
            QMessageBox::information(this, "Success", "Data inserted successfully!");
        } else {
            QMessageBox::critical(this, "Error", "Failed to insert data!");
        }
    } else {
        QMessageBox::critical(this, "Error", "Failed to connect to the database!");
    }
}

void maininterface::navigateToPage(int pageIndex)
{
    ui->add->setCurrentIndex(pageIndex);
    if (pageIndex == 1) {
        userlist *listWidget = new userlist(this);
        ui->add->addWidget(listWidget);
        ui->add->setCurrentWidget(listWidget);
    }
}

QString maininterface::selectimage()
{
    imagePath = QFileDialog::getOpenFileName(this, tr("Select Image"), QDir::homePath(), tr("Image Files (*.png *.jpg *.bmp *.gif)"));

    if (!imagePath.isEmpty()) {
        // Set the image path to a member variable for later use
        qDebug() << "Selected Image Path: " << imagePath;
    }

    return imagePath;
}

