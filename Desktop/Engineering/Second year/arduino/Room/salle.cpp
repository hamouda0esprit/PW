#include "salle.h"
#include <QSqlQueryModel>
#include <QDebug>
#include <QSqlError>
#include <QTableView>
#include <QTableWidget>

Salle::Salle(QString type ,QString etat,int capacite,QDate date_d,QDate date_f,QString etat_equipement,int id_salle)
{
//constructeurs paramétrés

    this->type=type;
    this->etat=etat;
    this->capacite=capacite;
    this->date_d=date_d;
    this->date_f=date_f;
    this->etat_equipement=etat_equipement;
    this->id_salle=id_salle;
}

// relier les arguments de la fonction salles avec les attributs de la base de données (1ere etape)

bool Salle::ajouter(){
    QSqlQuery query;

    // Préparation de la requête
    query.prepare("INSERT INTO SALLES (ID_SALLE, CAPACITE, ETAT, TYPE_SALLE,DATE_D,DATE_F, ETAT_EQUIPEMENT) "
                  "VALUES (:id_salle, :capacite, :etat, :type_salle,:dd ,:df, :etat_equipement)");

    // Assignation des valeurs aux paramètres de la requête
    query.bindValue(":id_salle", id_salle);
    query.bindValue(":capacite", capacite);
    query.bindValue(":etat", etat);
    query.bindValue(":type_salle", type);
    query.bindValue(":dd",date_d);
    query.bindValue(":df",date_f);
    query.bindValue(":etat_equipement", etat_equipement);

    // Exécution de la requête
    return query.exec();
}





