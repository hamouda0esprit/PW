#ifndef PROJET_H
#define PROJET_H
#include<QString>
#include<QSqlQuery>
#include<QSqlQueryModel>
#include <QtSql>
#include <QTableView>
#include <QSqlDatabase>
class projet
{

private:
    int IDPROJET;
    QString NOMPROJET,TYPEPROJECT,DESCRIPTIONPROJET,ETATPROJET,DATEDEBUT,DATEFIN;

public:

    //Construteurs
    projet(){};
    projet(int IDPROJET,QString NOMPROJET,QString TYPEPROJECT,QString DESCRIPTIONPROJET,QString ETATPROJET,QString DATEDEBUT,QString DATEFIN);

    //Getters
    int getId(){return IDPROJET;}
    QString getNomProjet(){return NOMPROJET;}
    QString getTypeProjet(){return TYPEPROJECT;}
    QString getDescProjet(){return DESCRIPTIONPROJET;}
    QString getEtatProjet(){return ETATPROJET;}
    QString getDDProjet(){return DATEDEBUT;}
    QString getDFProjet(){return DATEFIN;}

    //Setters
    void setIdProjet(int IDPROJET){this->IDPROJET = IDPROJET;}
    void setNomProjet(QString NOMPROJET){this->NOMPROJET = NOMPROJET;}
    void setTypeProjet(QString TYPEPROJECT){this->TYPEPROJECT = TYPEPROJECT;}
    void setDescProjet(QString DESCRIPTIONPROJET){this->DESCRIPTIONPROJET = DESCRIPTIONPROJET;}
    void setEtatProjet(QString ETATPROJET){this->ETATPROJET = ETATPROJET;}
    void setDDProjet(QString DATEDEBUT){this->DATEDEBUT = DATEDEBUT;}
    void setDFProjet(QString DATEFIN){this->DATEFIN = DATEFIN;}

    //Fonctions
    bool ajouter();
    bool suprimer();
    bool modifier(const QString& updatedName, const QString& updatedTitle, const QString& updatedDesc);
    bool afficher(QSqlQuery& Query_Get_Data,QString req);


};

#endif // PROJET_H
