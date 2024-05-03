#include "connection.h"
#include <QSqlDatabase>
#include <QSqlQuery>
#include <QSqlError>
#include <QVariant>
#include <QDebug>

Connection::Connection()
{

}

bool Connection::createconnect()
{
  bool test=false;
  QSqlDatabase db = QSqlDatabase::addDatabase("QODBC");
  db.setDatabaseName("testQT1");
  db.setUserName("trax");//inserer nom de l'utilisateur
    db.setPassword("trax");//inserer mot de passe de cet utilisateur

    if (db.open())
        test=true;

    return  test;
}

int Connection::getMaxId() {
    int maxId = 0;

    QSqlDatabase db = QSqlDatabase::database(); // Assuming you have a connection already established
    if (!db.isOpen()) {
        qDebug() << "Database connection is not open.";
        return maxId;
    }

    QSqlQuery query(db);
    if (query.exec("SELECT MAX(ID_EMPLOYE) FROM EMPLOYES")) {
        if (query.next()) {
            maxId = query.value(0).toInt();
        }
    } else {
        qDebug() << "Error executing query:" << query.lastError().text();
    }

    return maxId;
}

