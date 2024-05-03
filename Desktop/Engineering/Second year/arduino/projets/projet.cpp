#include "projet.h"
#include <QPushButton>
#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <QFile>
#include <QIcon>
#include <QTextStream>
#include <QDebug>
#include <QPixmap>
#include <QString>
#include <QPushButton>
#include <QTableWidgetItem>
#include <QMessageBox>
#include "connection.h"
#include <QHBoxLayout>
#include <QDate>
projet::projet(int IDPROJET,QString NOMPROJET,QString TYPEPROJECT,QString DESCRIPTIONPROJET,QString ETATPROJET,QString DATEDEBUT,QString DATEFIN)
{
    this->IDPROJET = IDPROJET;
    this->NOMPROJET = NOMPROJET;
    this->TYPEPROJECT = TYPEPROJECT;
    this->DESCRIPTIONPROJET = DESCRIPTIONPROJET;
    this->ETATPROJET = ETATPROJET;
    this->DATEDEBUT = DATEDEBUT;
    this->DATEFIN = DATEFIN;

}

bool projet::ajouter() {
    QSqlQuery query;

    // Input validation (you can customize this based on your requirements)
    if (NOMPROJET.isEmpty() || TYPEPROJECT.isEmpty() || DESCRIPTIONPROJET.isEmpty() || ETATPROJET.isEmpty() || DATEDEBUT.isEmpty() || DATEFIN.isEmpty()) {
        qDebug() << "Error: All fields must be filled.";
        return false;
    }

    // Use the same date format as in QDate::toString()
    query.prepare("INSERT INTO PROJETS (NOM_PROJET, TYPE, DESCRIPTION, ETAT, DATE_DEBUT, DATE_FIN) VALUES (:NOMPROJET, :TYPEPROJECT, :DESCRIPTIONPROJET, :ETATPROJET, TO_DATE(:DATEDEBUT, 'DD/MM/YYYY'), TO_DATE(:DATEFIN, 'DD/MM/YYYY'))");

    query.bindValue(":NOMPROJET", this->NOMPROJET);
    query.bindValue(":TYPEPROJECT", this->TYPEPROJECT);
    query.bindValue(":DESCRIPTIONPROJET", this->DESCRIPTIONPROJET);
    query.bindValue(":ETATPROJET", this->ETATPROJET);
    query.bindValue(":DATEDEBUT", this->DATEDEBUT);
    query.bindValue(":DATEFIN", this->DATEFIN);

    // Execute the query and check for errors
    bool success = query.exec();

    if (success) {
        qDebug() << "Project added successfully.";
    } else {
        qDebug() << "Error adding project:" << query.lastError().text();
    }

    return success;
}

bool projet::suprimer(){
    QSqlQuery query;

    qDebug() << "ID to be deleted: " << this->IDPROJET;

    query.prepare("DELETE from PROJETS where ID_PROJET = :id");
    query.bindValue(":id", this->IDPROJET);

    if (!query.exec()) {
        qDebug() << "Error executing query:" << query.lastError().text();
        return false;
    }
    return true;
}
bool projet::modifier(const QString& updatedName, const QString& updatedTitle, const QString& updatedDesc){
    QSqlQuery query;
    query.prepare("UPDATE PROJETS SET NOM_PROJET = :name, TYPE = :title, DESCRIPTION = :desc WHERE ID_PROJET = :id");
    query.bindValue(":name", updatedName);
    query.bindValue(":title", updatedTitle);
    query.bindValue(":desc", updatedDesc);
    query.bindValue(":id", this->IDPROJET);

    // Execute the query
    if (query.exec()) {
        // Check if any rows were affected by the update
        if (query.numRowsAffected() > 0) {
            return true;
        } else {
            qDebug() << "No rows were affected by the update.";
        }
    } else {
        qDebug() << "Error updating project:" << query.lastError().text();
    }

    return false;
}
bool projet::afficher(QSqlQuery& Query_Get_Data,QString req ){
    Query_Get_Data.prepare(req);
    if (Query_Get_Data.exec()) {
        return true;
    }else {
        qDebug() << "Error showing project:" << Query_Get_Data.lastError().text();
    }
    return false;
}
