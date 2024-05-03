#ifndef MEMBRE_H
#define MEMBRE_H

#include <QSqlQuery>
#include <QSqlQueryModel>

#include <QString>
#include <QDate>
#include <QTableWidget>

#include <QFile>
#include <QTextStream>
#include <QDebug>
#include <QMessageBox>

#include <QProcess>

#include <QTableWidget>

#include <QPrinter>
#include <QPainter>
#include <QFileDialog>
#include <QAxObject>
#include <QFontDatabase>

#include <QtCharts/QPieSeries>
#include <QtCharts/QChartView>
#include <QtCharts/QPieSlice>

class Membre
{
  QString nom, prenom, email;
  int id, age, numero;
  QByteArray imageData;

public:
  Membre();
  Membre(QString nom, QString prenom, QString email, int age, int numero, QByteArray imageData);

      // Getters
      QString getNom(){return nom;};
      QString getPrenom(){return prenom;};
      QString getEmail(){return email;};
      int getId(){return id;};
      int getAge(){return age;};
      int getNumero(){return numero;};

      // Setters
      void setNom(QString nom){this->nom=nom;};
      void setPrenom(QString prenom){this->prenom=prenom;};
      void setEmail(QString email){this->email=email;};

      void setAge(int age){this->age=age;};
      void setNumero(int numero){this->numero=numero;};

      void getHistorique(int memberId, QTableWidget *table);

      //les fonctionnalités
      bool ajouter();
      void afficher(QTableWidget *table, bool test);
      bool supprimer(int);
      bool modifier(int id, QString nom, QString prenom, QString email, int age, int numero, QByteArray imageData);
      QByteArray getImageDataById(int memberId);


      static const int IMAGE_WIDTH = 50;
      static const int IMAGE_HEIGHT = 50;

};

#endif // MEMBRE_H
