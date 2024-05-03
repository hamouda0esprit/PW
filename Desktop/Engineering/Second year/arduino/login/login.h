#ifndef LOGIN_H
#define LOGIN_H

#include <QWidget>

namespace Ui {
class login;
}

class login : public QWidget
{
    Q_OBJECT

public:
    explicit login(QWidget *parent = nullptr);
    ~login();
public slots:
    QString attemptLogin();
    void affichermain();
    void navigateToPage(int pageIndex);
private slots:

    void on_pushButton_clicked();

private:
    Ui::login *ui;
};

#endif // LOGIN_H
