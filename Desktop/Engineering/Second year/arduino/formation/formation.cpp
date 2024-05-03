#include "formation/formation.h"
#include <QDebug>
#include <QSqlError>
#include "connection.h"


#include <QCoreApplication>
#include <QNetworkAccessManager>
#include <QNetworkRequest>
#include <QNetworkReply>
#include <QUrl>
#include <QHttpMultiPart>
#include <QHttpPart>
#include <QFile>
#include <QBuffer>

#include <QJsonDocument>
#include <QJsonObject>
#include <QJsonArray>






Formation::Formation(QString nom,QString type,QString etat,QString description,QDate dateDebut,QDate dateFin)
{

  this->nom=nom;
  this->type=type;
  this->etat=etat;
  this->description=description;
  this->dateDebut=dateDebut;
  this->dateFin=dateFin;

}
Formation::Formation()
{
    // Initialization code for the default constructor, if needed
    // For example, you can initialize member variables to default values.
}

bool Formation::ajouter()
{
    QSqlQuery query;

    query.prepare("INSERT INTO FORMATION ( NOM, TYPE, ETAT, DESCRIPTION, DATE_DEBUT, DATE_FIN) "
                  "VALUES ( :nom, :type, :etat, :description, TO_DATE(:dateDebut, 'YYYY-MM-DD'), TO_DATE(:dateFin, 'YYYY-MM-DD'))");

    // Print the SQL query
    qDebug() << "SQL Query:" << query.lastQuery();
    qDebug() << "Bound Values:" << query.boundValues();

    query.bindValue(":nom", nom);
    query.bindValue(":type", type);
    query.bindValue(":etat", etat);
    query.bindValue(":description", description);
    query.bindValue(":dateDebut", dateDebut.toString("yyyy-MM-dd"));
    query.bindValue(":dateFin", dateFin.toString("yyyy-MM-dd"));

    if (query.exec()) {
        qDebug() << "Insertion successful";
        return true;
    } else {
        qDebug() << "Insertion failed: " << query.lastError().text();
        return false;
    }
}


void Formation::afficher(QTableWidget *table,bool test)
{
  Connection c;
  if (test) {
      qDebug() << "Connection established";
      QSqlDatabase::database().transaction();
      QSqlQuery query(c.db);
      query.prepare("SELECT * FROM FORMATION");

      if (query.exec()) {
          int currentRow = 0;

          while (query.next()) {
              table->setRowCount(currentRow + 1);

              QTableWidgetItem *item0 = new QTableWidgetItem(query.value("ID").toString());
              QTableWidgetItem *item1 = new QTableWidgetItem(query.value("NOM").toString());
              QTableWidgetItem *item2 = new QTableWidgetItem(query.value("TYPE").toString());
              QTableWidgetItem *item3 = new QTableWidgetItem(query.value("ETAT").toString());
              QTableWidgetItem *item4 = new QTableWidgetItem(query.value("DESCRIPTION").toString());
              QTableWidgetItem *item5 = new QTableWidgetItem(query.value("DATE_DEBUT").toDate().toString("yyyy-MM-dd"));
              QTableWidgetItem *item6 = new QTableWidgetItem(query.value("DATE_FIN").toDate().toString("yyyy-MM-dd"));

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


bool Formation::supprimer(int id)
{
  QSqlQuery query;
      query.prepare("DELETE FROM FORMATION WHERE ID = :id");
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
bool Formation::modifier(int id,QString nom,QString type,QString etat,
                         QString description,QDate dateDebut,QDate dateFin)
{
    QSqlQuery query;
    query.prepare("UPDATE FORMATION SET NOM = :nom, TYPE = :type, ETAT = :etat, "
                  "DESCRIPTION = :description, DATE_DEBUT = :dateDebut, DATE_FIN = :dateFin WHERE ID = :id");
    query.bindValue(":nom", nom);
    query.bindValue(":type", type);
    query.bindValue(":etat", etat);
    query.bindValue(":description", description);
    query.bindValue(":dateDebut", dateDebut);
    query.bindValue(":dateFin", dateFin);
    query.bindValue(":id", id);

    if (!query.exec())
    {
        qDebug() << "Error: " << query.lastError();
        return false;
    }

    return true;
}


QString Formation::performFaceAnalysis(const QImage &image) {
    QNetworkAccessManager* manager = new QNetworkAccessManager();
    QUrl url("https://faceanalyzer-ai.p.rapidapi.com/faceanalysis");
    QNetworkRequest request(url);

    request.setRawHeader("X-RapidAPI-Key", "b7e9ee345amsh2844e2f8a146ee5p1f3516jsn918841b107f9"); // Replace YOUR_API_KEY_HERE with your actual API key

    QHttpMultiPart *multiPart = new QHttpMultiPart(QHttpMultiPart::FormDataType);

    QHttpPart imagePart;
    imagePart.setHeader(QNetworkRequest::ContentTypeHeader, QVariant("image/jpeg")); // Assuming the image is JPEG
    imagePart.setHeader(QNetworkRequest::ContentDispositionHeader, QVariant("form-data; name=\"image\""));

    QByteArray imageData;
    QBuffer buffer(&imageData);
    buffer.open(QIODevice::WriteOnly);
    image.save(&buffer, "JPEG");

    imagePart.setBody(imageData);
    multiPart->append(imagePart);

    QNetworkReply *reply = manager->post(request, multiPart);
    multiPart->setParent(reply); // Ensure multiPart is deleted when reply is deleted

    // Wait for the reply to finish
    QEventLoop loop;
    QObject::connect(reply, &QNetworkReply::finished, &loop, &QEventLoop::quit);
    loop.exec();

    QString outputText;
    if (reply->error() == QNetworkReply::NoError) {
        QByteArray responseData = reply->readAll();
        qDebug() << "Response: " << responseData;

        // Parse the JSON response
        QJsonDocument jsonResponse = QJsonDocument::fromJson(responseData);
        QJsonObject jsonObject = jsonResponse.object();

        // Check if faces are detected
        QJsonArray facesArray = jsonObject["body"].toObject()["faces"].toArray();
        if (!facesArray.isEmpty()) {
            // Extract facial features of the first face
            QJsonObject faceObject = facesArray[0].toObject();
            QJsonObject facialFeaturesObject = faceObject["facialFeatures"].toObject();

            // Construct the output text
            outputText += "Gender: " + facialFeaturesObject["Gender"].toString() + "\n";
            outputText += "Smile: " + QString(facialFeaturesObject["Smile"].toBool() ? "Yes" : "No") + "\n";
            outputText += "Eyeglasses: " + QString(facialFeaturesObject["Eyeglasses"].toBool() ? "Yes" : "No") + "\n";
            outputText += "Sunglasses: " + QString(facialFeaturesObject["Sunglasses"].toBool() ? "Yes" : "No") + "\n";

            QJsonObject ageRangeObject = facialFeaturesObject["AgeRange"].toObject();
            int ageLow = ageRangeObject["Low"].toInt();
            int ageHigh = ageRangeObject["High"].toInt();
            outputText += "Age Range: " + QString::number(ageLow) + "-" + QString::number(ageHigh) + " years old\n";

            QJsonArray emotionsArray = facialFeaturesObject["Emotions"].toArray();
            QStringList emotions;
            for (const auto &emotion : emotionsArray) {
                emotions.append(emotion.toString());
            }
            outputText += "Emotions: " + emotions.join(", ");

            qDebug() << "Output Text: " << outputText;
        } else {
            qDebug() << "No face detected!";
        }
    } else {
        qDebug() << "Error: " << reply->errorString();
    }

    reply->deleteLater();
    return outputText;
}











