#ifndef MAININTERFACE_H
#define MAININTERFACE_H

#include <QWidget>
namespace Ui {
class maininterface;
}

class maininterface : public QWidget
{
    Q_OBJECT

public:
    explicit maininterface(QWidget *parent = nullptr);
    ~maininterface();

private slots:
    void on_confirm_add_2_clicked();
    void navigateToPage(int pageIndex);
    QString selectimage();

private:
    Ui::maininterface *ui;

};

#endif // MAININTERFACE_H
