#ifndef SALLE_H
#define SALLE_H
#include<QString>
#include<QSqlQuery>
#include<QSqlQueryModel>
#include <QDate>
#include <QTableWidget>
#include "liste.h"

class Salle
{
    QString type,etat,etat_equipement;

    int capacite,id_salle;
    QDate date_d;
    QDate date_f;


public:

    //constructeurs paramétrés (initialise les attributs de la classe avec les valeurs fournies en paramètres.)
    Salle(QString,QString,int,QDate,QDate,QString,int);



    //Fonctionnalités de bases relatives à l'entité Salle
    bool ajouter();

};

#endif // SALLE_H
