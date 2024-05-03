#include "reservation2.h"
#include "ui_reservation2.h"
#include "connection.h"
#include <QMessageBox>
#include <QtWidgets>
#include <QSqlQuery>
#include <QSqlRecord>
reservation2::reservation2(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::reservation2)
{
    ui->setupUi(this);
    QDateTime defaultStartDate = QDateTime::fromString("2000-01-01T00:00:00", Qt::ISODate);
    QDateTime defaultEndDate = QDateTime::fromString("2000-01-01T00:00:00", Qt::ISODate);

    ui->dateTimeEdit->setDateTime(defaultStartDate);
    ui->dateTimeEdit_2->setDateTime(defaultEndDate);
    /*buttons cursor*/
    QPushButton *changeButton = findChild<QPushButton*>("f_add_course");
    QPushButton *cb = findChild<QPushButton*>("f_liste_courses");
    QPushButton *cv1 = findChild<QPushButton*>("f_statistics");
    QPushButton *cv2 = findChild<QPushButton*>("confirm_update");
    QPushButton *cv = findChild<QPushButton*>("confirm_add");
    QPushButton *cv3 = findChild<QPushButton*>("generate_pdf");
    QPushButton *cv4 = findChild<QPushButton*>("generate_certif");
    QPushButton *cv5 = findChild<QPushButton*>("delete_2");
    QPushButton *cv6 = findChild<QPushButton*>("update_button");
    QPushButton *cv7 = findChild<QPushButton*>("sort_button");
    QPushButton *cv8 = findChild<QPushButton*>("search_button");

    if (changeButton && cb && cv1 && cv && cv2 && cv3 && cv4 && cv5 && cv6 && cv7 && cv8) {
        changeButton->setCursor(Qt::PointingHandCursor);
        cb->setCursor(Qt::PointingHandCursor);
        cv1->setCursor(Qt::PointingHandCursor);
        cv->setCursor(Qt::PointingHandCursor);
        cv2->setCursor(Qt::PointingHandCursor);
        cv3->setCursor(Qt::PointingHandCursor);
        cv4->setCursor(Qt::PointingHandCursor);
        cv5->setCursor(Qt::PointingHandCursor);
        cv6->setCursor(Qt::PointingHandCursor);
        cv7->setCursor(Qt::PointingHandCursor);
        cv8->setCursor(Qt::PointingHandCursor);
    } else {
        qDebug() << "Did not catch button";
    }
    //end

    connect(ui->f_add_course, &QPushButton::clicked, this, [this]() { navigateToPage(0); });
    connect(ui->f_liste_courses, &QPushButton::clicked, this, [this]() { navigateToPage(1); });
    connect(ui->f_statistics, &QPushButton::clicked, this, [this]() { navigateToPage(2); });
    connect(ui->confirm_add, &QPushButton::clicked, this, &reservation2::onConfirmAddClicked);
   connect(ui->f_liste_courses, &QPushButton::clicked, this, &reservation2::onFListeCoursesClicked);
    connect(ui->tableau_historique, &QTableWidget::itemSelectionChanged, this, &reservation2::onTableSelectionChanged);
    connect(ui->delete_2, &QPushButton::clicked, this,&reservation2::onDeleteButtonClicked);
    connect(ui->tableau_historique, &QTableWidget::cellChanged, this, &reservation2::onCellChanged);
}

reservation2::~reservation2()
{
    delete ui;
}
void reservation2::navigateToPage(int pageIndex)
{
    ui->stackedWidget->setCurrentIndex(pageIndex);
}
void reservation2::onConfirmAddClicked()
{
    QLineEdit *put_name = findChild<QLineEdit*>("put_name");
    QLineEdit *ID = findChild<QLineEdit*>("ID");
    QDateTimeEdit  *dateTimeEdit = findChild<QDateTimeEdit*>("dateTimeEdit");
    QDateTimeEdit  *dateTimeEdit_2 = findChild<QDateTimeEdit*>("dateTimeEdit_2");
    QTextEdit *put_description = findChild<QTextEdit*>("put_description");



    if (put_name && ID && dateTimeEdit && dateTimeEdit_2 && put_description) {
        QString Name = put_name->text();
        QString newId = ID->text();
        QDateTime DateS = dateTimeEdit->dateTime();
        QDateTime  DateE = dateTimeEdit_2->dateTime();
        QString Bio = put_description->toPlainText();
        bool ok;
        int entreID = newId.toInt(&ok);

        if (ok) {
            qDebug() << "Successfully converted to integer:" << newId;
        } else {
            qDebug() << "Conversion to integer failed. Invalid input.";
        }
        if (Name.isEmpty() || !Name.at(0).isUpper() || !Name.at(0).isLetter()) {
            QMessageBox::information(this, tr("Invalid Input"),
                                     tr("Name should not be empty, and must start with a capital letter."), QMessageBox::Ok);
             return;
        }else if(!Bio.isEmpty() && !Bio.contains(QRegularExpression("^[a-zA-Z0-9]+$"))){
            QMessageBox::information(this, tr("Invalid Input"),
                                         tr("Bio can only contain characters and numbers."), QMessageBox::Ok);
             return;
        }
         bool insertResult = insertReservation(Name, entreID, DateS, DateE, Bio);
         if (insertResult) {
                    QMessageBox::information(this, tr("Database Operation"),
                                             tr("Data inserted successfully."), QMessageBox::Ok);
                } else {
                    QMessageBox::critical(this, tr("Database Operation Error"),
                                          tr("Failed to insert data into the database."), QMessageBox::Ok);
                }
    } else {
        qDebug() << "Did not find QLineEdit named put_name";
    }
}
void reservation2::onFListeCoursesClicked()
{
    QSqlQuery query;
    query.exec("SELECT NAME,BIO,ID_RESERVATION,START_DATE,END_DATE FROM RESERVATIONS");

    ui->tableau_historique->clearContents();
    ui->tableau_historique->setRowCount(0);

    int row = 0;
    while (query.next()) {
        ui->tableau_historique->insertRow(row);
        for (int col = 0; col < query.record().count(); ++col) {
            QTableWidgetItem *item = new QTableWidgetItem(query.value(col).toString());
            ui->tableau_historique->setItem(row, col, item);
        }
        ++row;
    }
}
int reservation2::onTableSelectionChanged() {
    QList<QTableWidgetItem*> selectedItems = ui->tableau_historique->selectedItems();

    if (!selectedItems.isEmpty()) {
        int selectedRow = selectedItems.first()->row();
        return selectedRow;
    }
    return -1;
}
void reservation2::onDeleteButtonClicked() {
    int selectedRow = onTableSelectionChanged();

    if (selectedRow != -1) {
        QString idToDelete = ui->tableau_historique->item(selectedRow, 2)->text();
        QSqlQuery query;
        query.prepare("DELETE FROM RESERVATIONS WHERE ID_RESERVATION = :id");
        query.bindValue(":id", idToDelete);

        if (query.exec()) {
            qDebug() << "Row deleted from database. ID:" << idToDelete;
            deleteSelectedRow(selectedRow);
        } else {
            qDebug() << "Error deleting row from database:" << query.lastError().text();
        }
    } else {
        qDebug() << "No row is selected in onDeleteButtonClicked.";
    }
}
void reservation2::deleteSelectedRow(int selectedRow) {
    if (selectedRow >= 0) {
        ui->tableau_historique->removeRow(selectedRow);
    }
}
void reservation2::onCellChanged(int row, int column)
{
    QTableWidgetItem *item = ui->tableau_historique->item(row, column);

    if (item)
    {
        QString newValue = item->text();
        QTableWidgetItem *idItem = ui->tableau_historique->item(row, 2);
        if (idItem)
        {
            QString idToUpdate = idItem->text();

            qDebug() << "Cell changed at row:" << row << "column:" << column;
            qDebug() << "ID to update:" << idToUpdate;
            qDebug() << "New Value:" << newValue;
            updateDatabase(idToUpdate, column, newValue);
        }
        else
        {
            qDebug() << "ID item is null at row:" << row << "column:" << 0;
        }
    }
    else
    {
        qDebug() << "Item is null at row:" << row << "column:" << column;
    }
}


    void reservation2::updateDatabase(const QString &id, int column, const QString &newValue)
    {
        QSqlQuery query;

        switch (column)
        {
        case 0:
            query.prepare("UPDATE RESERVATIONS SET NAME = :value WHERE ID_RESERVATION = :id");
            query.bindValue(":value", newValue);
            break;
        case 1:
            query.prepare("UPDATE RESERVATIONS SET BIO = :value WHERE ID_RESERVATION = :id");
            query.bindValue(":value", newValue);
            break;
        case 2:
            query.prepare("UPDATE RESERVATIONS SET ID = :value WHERE ID_RESERVATION = :id");
            query.bindValue(":value", newValue);
            break;
        case 3:
            query.prepare("UPDATE RESERVATIONS SET START_DATE = :value WHERE ID_RESERVATION = :id");
            query.bindValue(":value", newValue);
            break;
        case 4:
            query.prepare("UPDATE RESERVATIONS SET END_DATE = :value WHERE ID_RESERVATION = :id");
            query.bindValue(":value", newValue);
            break;
        default:
            qDebug() << "Invalid column index.";
            return;
        }

        query.bindValue(":id", id);

        if (query.exec()) {
            qDebug() << "Row updated in the database. ID:" << id;
        } else {
            qDebug() << "Error updating row in the database:" << query.lastError().text();
        }
    }
    bool reservation2::insertReservation(const QString& name, const int& id, const QDateTime& startDate, const QDateTime& endDate, const QString& description)
    {
        QSqlQuery query;
        QString startDateStr = startDate.toString(Qt::ISODate);
        QString endDateStr = endDate.toString(Qt::ISODate);
        query.prepare("INSERT INTO MUSTAPHA.RESERVATIONS (NAME, BIO, ID_RESERVATION, START_DATE, END_DATE) "
                      "VALUES (:Name, :Description, :ID, :StartDate, :EndDate)");

        query.bindValue(":Name", QVariant(name));
        query.bindValue(":Description", QVariant(description));
        query.bindValue(":ID", QVariant(id));
        query.bindValue(":StartDate", QVariant(startDateStr));
        query.bindValue(":EndDate", QVariant(endDateStr));

        if (query.exec()) {
            qDebug() << "Reservation inserted successfully.";
            return true;
        } else {
            qDebug() << "Error inserting reservation: " << query.lastError().text();
            return false;
        }
    }
