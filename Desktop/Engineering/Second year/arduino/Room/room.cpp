#include "room.h"
#include "ui_room.h"
#include "connection.h"
#include "statistic.h"
#include "salle.h"
#include "liste.h"
#include <QMessageBox>
#include <QComboBox>
#include <QWidget>
#include <QTableWidget>
#include <QSqlRecord>
#include <QSqlQuery>
#include <QDebug>
#include <QtUiTools/QUiLoader>
#include <QFile>
#include <QtWidgets>
#include <QStackedWidget>
#include <QVBoxLayout>
#include <QUiLoader>

Room::Room(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::Room)
{
    ui->setupUi(this);
    ui->dateEdit->setDate(QDate::currentDate());
       ui->dateEdit_2->setDate(QDate::currentDate());
       connect(ui->add, &QPushButton::clicked, this, [this]() { navigateToPage(0); });
         connect(ui->list, &QPushButton::clicked, this, [this]() { navigateToPage(1); });
          connect(ui->stat, &QPushButton::clicked, this, [this]() { navigateToPage(2); });
         // Ajoutez ces lignes pour que le widget de la table prenne tout l'espace disponible
}

Room::~Room()
{
    delete ui;
}
void Room::on_pushButton_clicked()
{
    // récupération des données
    Connection c;
    QString type = ui->comboBox_2->currentText();
    QString etat = ui->comboBox->currentText();
    QString etat_equipement = ui->equi->currentText();
    QString capacityString = ui->lineEdit_4->text();

    // Check if any of the combo boxes are empty or contain the default value
    if (type.isEmpty() || type == "selectionner" ||
        etat.isEmpty() || etat == "selectionner" ||
        etat_equipement.isEmpty() || etat_equipement == "selectionner" || capacityString.isEmpty()) {
        QMessageBox::critical(nullptr, QObject::tr("Erreur"), QObject::tr("Veuillez sélectionner une valeur pour chaque champ."));
        return;
    }

    bool capacityOk;
    int capacity = capacityString.toInt(&capacityOk);

    // Get today's date
    QDate today = QDate::currentDate();

    QDate date_d = ui->dateEdit->date();
    QDate date_f = ui->dateEdit_2->date();


    // Ensure the start date is not before today's date
    if (date_d < today) {
        QMessageBox::critical(nullptr, QObject::tr("Erreur"), QObject::tr("La date de début doit être aujourd'hui ou ultérieure."));
        return;
    }

    // Check if capacity is a valid number
    if (!capacityOk || capacity <= 0) {
        QMessageBox::critical(nullptr, QObject::tr("Erreur"), QObject::tr("La capacité doit être un nombre valide supérieur à zéro."));
        return;
    }

    // Check if end date is after start date
    if (date_f <= date_d) {
        QMessageBox::critical(nullptr, QObject::tr("Erreur"), QObject::tr("La date de fin doit être après la date de début."));
        return;
    }

    int maxId = c.getMaxId();
    // Increment the maximum ID by 1
    int newId = maxId + 1;

    // Convert the new ID to a QString

    Salle s(type, etat, capacity, date_d, date_f, etat_equipement, newId);
    bool test = s.ajouter();

    if (test) {
        QMessageBox::information(nullptr, QObject::tr("OK"), QObject::tr("Ajout effectué."));
    } else {
        QMessageBox::critical(nullptr, QObject::tr("Erreur"), QObject::tr("Ajout non effectué."));
    }
}



void Room::navigateToPage(int pageIndex)
{
    ui->st->setCurrentIndex(pageIndex);
    if (pageIndex==1) {
                QUiLoader loader;
                liste *listWidget = new liste(this);
                ui->st->addWidget(listWidget);
                ui->st->setCurrentWidget(listWidget);
    }
       if (pageIndex==2) {
           QUiLoader loader;
           statistic *listWidget = new statistic(this);
           ui->st->addWidget(listWidget);
           ui->st->setCurrentWidget(listWidget);
    }
}
