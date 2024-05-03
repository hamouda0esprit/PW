#include "employee.h"
#include "connection.h"
#include <QSqlDatabase>
#include <QSqlQuery>
#include <QSqlError>
#include <QVariant>
#include <QDebug>
#include <QMessageBox>
#include <QApplication>
#include <QtWidgets>
#include <QSqlRecord>
#include <QPixmap>
#include <QWidget>
#include <QLabel>
#include "userlist.h"

EMPLOYEE::EMPLOYEE() {
}

EMPLOYEE::EMPLOYEE(int ID, QString nom, QString prenom, QString login, QString password, QString role, QByteArray imageData, QString id_membre) {
    this->ID = ID;
    this->nom = nom;
    this->prenom = prenom;
    this->login = login;
    this->password = password;
    this->role = role;
    this->imageData = imageData;
    this->id_membre = id_membre;
}

bool EMPLOYEE::ajouter() {
    QSqlDatabase db = QSqlDatabase::database(); // Assuming you have a connection already established
    if (!db.isOpen()) {
        qDebug() << "Database connection is not open.";
        return false;
    }

    QSqlQuery query(db);
    query.prepare("INSERT INTO EMPLOYES (ID_EMPLOYE, NOM, PRENOM, LOGIN, MOT_DE_PASSE, IMAGE, ROLE, ID_MEMBRE) VALUES (:id, :nom, :prenom, :login, :password, :image, :role, :id_membre)");
    query.bindValue(":id", ID);
    query.bindValue(":nom", nom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":login", login);
    query.bindValue(":password", password);
    query.bindValue(":image", imageData); // Bind the QByteArray directly
    query.bindValue(":role", role);
    query.bindValue(":id_membre", id_membre);

    if (!query.exec()) {
        qDebug() << "Error executing query:" << query.lastError().text();
        return false;
    }
    else {
        qDebug() << "Data inserted successfully!";
        return true;
    }
}

void EMPLOYEE::updateImageCell(int row) {
    // Open a file dialog to select a new image
    QString imagePath = QFileDialog::getOpenFileName(nullptr, "Select Image", "", "Image Files (*.png *.jpg *.jpeg)");

    if (!imagePath.isEmpty()) {
        // Read the image file
        QFile file(imagePath);
        if (!file.open(QIODevice::ReadOnly)) {
            qDebug() << "Failed to open image file";
            return;
        }
        QByteArray imageData = file.readAll();
        file.close();

        // Update the image in the database for the selected row
        QSqlQuery query;
        query.prepare("UPDATE EMPLOYES SET IMAGE = :imageData WHERE ID_EMPLOYE = :id");
        query.bindValue(":imageData", imageData);
        query.bindValue(":id", row + 1); // Assuming the ID_EMPLOYE starts from 1

        if (!query.exec()) {
            qDebug() << "Failed to update image in the database:" << query.lastError().text();
            return;
        }

        qDebug() << "Image updated successfully for row" << row;
    }
}
void EMPLOYEE::updateimage(int ID_EMPLOYE, const QString& columnName, const QString& newValue, const QByteArray& imageData) {
    QSqlQuery query;

    // Update records
    if (!columnName.isEmpty() && !newValue.isEmpty()) {
        QString updateQuery = QString("UPDATE EMPLOYES SET %1 = '%2' WHERE ID_EMPLOYE = %3").arg(columnName).arg(newValue).arg(ID_EMPLOYE);
        if (!query.exec(updateQuery)) {
            qDebug() << "Failed to update column:" << query.lastError().text();
            return;
        }
    }

    // Update image data
    if (!imageData.isEmpty()) {
        QString updateQuery = QString("UPDATE EMPLOYES SET IMAGE = :imageData WHERE ID_EMPLOYE = %1").arg(ID_EMPLOYE);
        query.prepare(updateQuery);
        query.bindValue(":imageData", imageData);
        if (!query.exec()) {
            qDebug() << "Failed to update image data:" << query.lastError().text();
            return;
        }
    }
}
bool EMPLOYEE::updatenormal(int ID, QString nom, QString prenom, QString login, QString password, QString role, QString id_membre, QByteArray imageData) {
    // First, delete the existing image
    if (!deleteImage(ID)) {
        qDebug() << "Failed to delete existing image for employee ID" << ID;
        return false;
    }

    QSqlQuery query;
    QString updateQuery = "UPDATE EMPLOYES SET NOM = :nom, PRENOM = :prenom, LOGIN = :login, "
                          "MOT_DE_PASSE = :password, ROLE = :role, ID_MEMBRE = :id_membre, IMAGE = :imageData "
                          "WHERE ID_EMPLOYE = :id";
    query.prepare(updateQuery);
    query.bindValue(":nom", nom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":login", login);
    query.bindValue(":password", password);
    query.bindValue(":role", role);
    query.bindValue(":id_membre", id_membre);
    query.bindValue(":imageData", imageData);
    query.bindValue(":id", ID);

    if (!query.exec()) {
        qDebug() << "Failed to update normal fields and image:" << query.lastError().text();
        return false;
    } else {
        qDebug() << "Normal fields and image updated successfully!";
        return true;
    }
}

bool EMPLOYEE::deleteImage(int ID) {
    QSqlQuery query;
    QString deleteQuery = "UPDATE EMPLOYES SET IMAGE = NULL WHERE ID_EMPLOYE = :id";
    query.prepare(deleteQuery);
    query.bindValue(":id", ID);
    if (!query.exec()) {
        qDebug() << "Failed to delete image for employee ID" << ID << ":" << query.lastError().text();
        return false;
    } else {
        qDebug() << "Image deleted successfully for employee ID" << ID;
        return true;
    }
}


void EMPLOYEE::update(QMap<QPair<int, int>, QString> modifiedData){
    QSqlQuery query;
    QMapIterator<QPair<int, int>, QString> iter(modifiedData);
    while (iter.hasNext()) {
        iter.next();
        const QPair<int, int>& key = iter.key();
        const QString& newValue = iter.value();
        int row = key.first;
        int column = key.second;

        // Update records based on the row number as the ID
        QString columnName;
        switch (column) {
            case 0: columnName = "NOM"; break;
            case 1: columnName = "PRENOM"; break;
            case 2: columnName = "LOGIN"; break;
            case 3: columnName = "MOT_DE_PASSE"; break;
            case 4: columnName = "ROLE"; break;
            default: break;
        }
        if (!columnName.isEmpty()) {
            // Use the row number as the ID in the update query
            QString updateQuery = QString("UPDATE EMPLOYES SET %1 = '%2' WHERE ID_EMPLOYE = %3").arg(columnName).arg(newValue).arg(row + 1);
            if (!query.exec(updateQuery)) {
                return;
            }

        }
    }
    modifiedData.clear();

}



void EMPLOYEE::Delete(int onTableSelectionChanged) {
    int selectedRow = onTableSelectionChanged;

    if (selectedRow != -1) {
        QSqlQuery query;

        // Delete the selected row
        query.prepare("DELETE FROM EMPLOYES WHERE ID_EMPLOYE = :id");
        query.bindValue(":id", selectedRow + 1); // Adjust ID value to match the database ID (starting from 1)

        if (query.exec()) {

        } else {
            qDebug() << "Error deleting row from database:" << query.lastError().text();
            return;
        }

        // Update IDs to maintain sequential order
        query.prepare("UPDATE EMPLOYES SET ID_EMPLOYE = ID_EMPLOYE - 1 WHERE ID_EMPLOYE > :id");
        query.bindValue(":id", selectedRow + 1);

        if (query.exec()) {
            qDebug() << "IDs updated successfully!";
        } else {
            qDebug() << "Error updating IDs:" << query.lastError().text();
        }
    } else {
        return;
    }
}

// Slot definition for handling double-click event on image cell

