#ifndef FORMATION_H
#define FORMATION_H

#include <QSqlQuery>
#include <QSqlQueryModel>

#include <QString>
#include <QDate>
#include <QTableWidget>
#include <QCoreApplication>
#include <QNetworkAccessManager>
#include <QNetworkRequest>
#include <QNetworkReply>
#include <QUrl>
#include <QHttpMultiPart>
#include <QHttpPart>
#include <QFile>

#include <QFileDialog>



class Formation
{
  QString nom,type,etat,description;
  int id;
  QDate dateDebut;
  QDate dateFin;

public:
  Formation();
  Formation(QString nom,QString type,QString etat,
                 QString description,QDate dateDebut,QDate dateFin);

      // Getters
      QString getNom(){return nom;};
      QString getType(){return type;};
      QString getEtat(){return etat;};
      QString getDescription(){return description;};
      int getId(){return id;};
      QDate getDateDebut(){return dateDebut;};
      QDate getDateFin(){return dateFin;};

      // Setters
      void setNom(QString nom){this->nom=nom;};
      void setType(QString type){this->type=type;};
      void setEtat(QString etat){this->etat=etat;};
      void setDescription(QString description){this->description=description;};

      void setDateDebut(QDate dateDebut){this->dateDebut=dateDebut;};
      void setDateFin(QDate dateFin){this->dateFin=dateFin;};

      //les fonctionnalités
      bool ajouter();
      void afficher(QTableWidget *table,bool test);
      bool supprimer(int);
      bool modifier(int id,QString nom,QString type,QString etat,
                       QString description,QDate dateDebut,QDate dateFin);
      QString performFaceAnalysis(const QImage &image);


};

#endif // FORMATION_H
