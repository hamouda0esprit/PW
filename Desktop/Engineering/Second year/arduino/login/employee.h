#ifndef EMPLOYEE_H
#define EMPLOYEE_H
#include <QTableWidget>
#include <QLabel> // Include the QLabel header
class EMPLOYEE
{
private:
    int ID;
    QString nom;
    QString prenom;
    QString login;
    QString password;
    QString role;
    QByteArray imageData;
    QString id_membre;
public:
    EMPLOYEE();
    EMPLOYEE(int ID,QString nom,QString prenom,QString login,QString password,QString role,QByteArray imageData,QString id_membre);
    bool ajouter();
    void updateImageCell(int row);
    void update(QMap<QPair<int, int>, QString> modifiedData);
    void updateimage(int ID_EMPLOYE, const QString& columnName, const QString& newValue, const QByteArray& imageData);
    bool updatenormal(int ID, QString nom, QString prenom, QString login, QString password, QString role, QString id_membre, QByteArray imageData);
    void Delete(int onTableSelectionChanged);
    void check(int row, int column);
    bool deleteImage(int ID);

};

#endif // EMPLOYEE_H
