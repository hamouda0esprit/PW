#ifndef ROOM_H
#define ROOM_H

#include <QWidget>
#include <QMainWindow>
#include <QTableWidget>
#include "salle.h"
namespace Ui {
class Room;
}

class Room : public QWidget
{
    Q_OBJECT

public:
    explicit Room(QWidget *parent = nullptr);
    ~Room();
private slots:
    void on_pushButton_clicked();




    void navigateToPage(int pageIndex);
private:
    Ui::Room *ui;
};

#endif // ROOM_H
