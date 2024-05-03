#include "membres/ahmed_membre.h"
#include "connection.h"
#include <QDebug>
#include <QSqlError>


Membre::Membre(QString nom, QString prenom, QString email, int age, int numero, QByteArray imageData)
{

  this->nom=nom;
  this->prenom=prenom;
  this->email=email;
  this->age=age;
  this->numero=numero;
  this->imageData=imageData;

}
Membre::Membre()
{
    // Initialization code for the default constructor, if needed
    // For example, you can initialize member variables to default values.
}

bool Membre::ajouter()
{
    QSqlQuery query;

    query.prepare("INSERT INTO MEMBRES (NOM, PRENOM, EMAIL, AGE, NUMERO, IMAGE) "
                  "VALUES (:nom, :prenom, :email, :age, :numero, :image)");


    // Print the SQL query
    qDebug() << "SQL Query:" << query.lastQuery();
    qDebug() << "Bound Values:" << query.boundValues();

    query.bindValue(":nom", nom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":email", email);
    query.bindValue(":age", age);
    query.bindValue(":numero", numero);
    query.bindValue(":image", imageData);

    if (query.exec()) {
        qDebug() << "Insertion successful";
        return true;
    } else {
        qDebug() << "Insertion failed. SQL Error Code:" << query.lastError().nativeErrorCode();
        qDebug() << "Error details:" << query.lastError().text();
        return false;
    }

}


void Membre::afficher(QTableWidget *table,bool test)
{
    Connection c;

    if (test) {
        qDebug() << "Connection established";
        QSqlDatabase::database().transaction();
        QSqlQuery query(c.db);
        query.prepare("SELECT * FROM MEMBRES");

        if (query.exec()) {
            int currentRow = 0;

            while (query.next()) {
                table->setRowCount(currentRow + 1);

                QTableWidgetItem *item0 = new QTableWidgetItem(query.value("ID_MEMBRE").toString());
                QTableWidgetItem *item1 = new QTableWidgetItem(query.value("NOM").toString());
                QTableWidgetItem *item2 = new QTableWidgetItem(query.value("PRENOM").toString());
                QTableWidgetItem *item3 = new QTableWidgetItem(query.value("EMAIL").toString());
                QTableWidgetItem *item4 = new QTableWidgetItem(query.value("AGE").toString());
                QTableWidgetItem *item5 = new QTableWidgetItem(query.value("NUMERO").toString());

                // Retrieve image data based on ID
                int memberId = query.value("ID_MEMBRE").toInt();
                Membre membre;  // Create an instance of the Membre class
                QByteArray imageData = membre.getImageDataById(memberId);

                    // Add image data to QTableWidgetItem
                    QPixmap pixmap;
                        pixmap.loadFromData(imageData);
                        pixmap = pixmap.scaled(Membre::IMAGE_WIDTH, Membre::IMAGE_HEIGHT, Qt::KeepAspectRatio);

                        QTableWidgetItem *item6 = new QTableWidgetItem();
                        item6->setData(Qt::DecorationRole, pixmap);
                        item6->setSizeHint(pixmap.size());

                table->setItem(currentRow, 0, item0);
                table->setItem(currentRow, 1, item1);
                table->setItem(currentRow, 2, item2);
                table->setItem(currentRow, 3, item3);
                table->setItem(currentRow, 4, item4);
                table->setItem(currentRow, 5, item5);
                table->setItem(currentRow, 6, item6);

                currentRow++;
                qDebug() << "Number of retrieved rows: " << currentRow;
            }
        }
        QSqlDatabase::database().commit();
    }
}


bool Membre::supprimer(int id)
{
  QSqlQuery query;
      query.prepare("DELETE FROM MEMBRES WHERE ID_MEMBRE = :id");
      query.bindValue(":id", id);

      if (query.exec()) {
          qDebug() << "Deletion successful";
          return true;
      } else {
          qDebug() << "Deletion failed: " << query.lastError().text();
          return false;
      }

}

// formation.cpp
bool Membre::modifier(int id, QString nom, QString prenom, QString email, int age, int numero, QByteArray imageData)
{
    QSqlQuery query;
    query.prepare("UPDATE MEMBRES SET NOM = :nom, PRENOM = :prenom, EMAIL = :email, AGE = :age, NUMERO = :numero, IMAGE = :image WHERE ID_MEMBRE = :id");
    query.bindValue(":nom", nom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":email", email);
    query.bindValue(":age", age);
    query.bindValue(":numero", numero);
    query.bindValue(":image", imageData);
    query.bindValue(":id", id);

    if (!query.exec())
    {
        qDebug() << "Error: " << query.lastError();
        return false;
    }

    return true;
}

QByteArray Membre::getImageDataById(int memberId)
{
    QSqlQuery query;
    query.prepare("SELECT IMAGE FROM MEMBRES WHERE ID_MEMBRE = :id");
    query.bindValue(":id", memberId);

    if (query.exec() && query.first()) {
        return query.value("IMAGE").toByteArray();
    } else {
        qDebug() << "Failed to retrieve image data for ID: " << memberId;
        return QByteArray();  // Return an empty byte array if there's an error
    }
}

void Membre::getHistorique(int memberId, QTableWidget *table) {
    QSqlQuery query;
    query.prepare("SELECT p.ID_PROJET, p.NOM_PROJET, p.DESCRIPTION, p.DATE_DEBUT, p.DATE_FIN, p.ETAT, p.TYPE "
                  "FROM PROJETS p "
                  "JOIN S_ASSOCIER sa ON p.ID_PROJET = sa.ID_PROJET "
                  "WHERE sa.ID_MEMBRE = :memberId;");
    query.bindValue(":memberId", memberId);

    if (query.exec()) {
        table->clear(); // Clear existing data

        int currentRow = 0;
        while (query.next()) {
            table->insertRow(currentRow);

            QTableWidgetItem *item0 = new QTableWidgetItem(query.value(0).toString());
            QTableWidgetItem *item1 = new QTableWidgetItem(query.value(1).toString());
            QTableWidgetItem *item2 = new QTableWidgetItem(query.value(2).toString());
            QTableWidgetItem *item3 = new QTableWidgetItem(query.value(3).toDate().toString());
            QTableWidgetItem *item4 = new QTableWidgetItem(query.value(4).toDate().toString());
            QTableWidgetItem *item5 = new QTableWidgetItem(query.value(5).toString());
            QTableWidgetItem *item6 = new QTableWidgetItem(query.value(6).toString());

            table->setItem(currentRow, 0, item0);
            table->setItem(currentRow, 1, item1);
            table->setItem(currentRow, 2, item2);
            table->setItem(currentRow, 3, item3);
            table->setItem(currentRow, 4, item4);
            table->setItem(currentRow, 5, item5);
            table->setItem(currentRow, 6, item6);

            currentRow++;
            qDebug() << "Number of retrieved rows: " << currentRow;
        }

        table->setRowCount(currentRow); // Set row count after inserting all rows
        qDebug() << "Retrieved" << currentRow << "projects for member ID:" << memberId;
    } else {
        qDebug() << "Error executing query:" << query.lastError().text();
    }
}
