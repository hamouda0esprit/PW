#ifndef RESERVATION2_H
#define RESERVATION2_H
#include "connection.h"
#include <QMainWindow>
#include <QTableWidgetItem>
#include <QSqlQuery>
#include <QDebug>
#include <QWidget>

namespace Ui {
class reservation2;
}

class reservation2 : public QWidget
{
    Q_OBJECT

public:
    explicit reservation2(QWidget *parent = nullptr);
    ~reservation2();

private slots:
    void navigateToPage(int pageIndex);
    void onConfirmAddClicked();
    void onFListeCoursesClicked();
    int onTableSelectionChanged();
    void onDeleteButtonClicked();
    void deleteSelectedRow(int selectedRow);
    void onCellChanged(int row, int column);
    void updateDatabase(const QString &id, int column, const QString &newValue);
    bool insertReservation(const QString& name, const int& id, const QDateTime& startDate, const QDateTime& endDate, const QString& description);
private:
    Ui::reservation2 *ui;
    Connection *connection;
    bool deleteButtonClicked;

};

#endif // RESERVATION2_H
