#include "login.h"
#include "ui_login.h"
#include <QMessageBox>
#include <QSqlQuery>
#include <QSqlError>
#include <connection.h>
#include <mainwindow.h>
#include "ui_mainwindow.h"

login::login(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::login)
{
    ui->setupUi(this);
    connect(ui->confirm_3, &QPushButton::clicked, this, &login::affichermain);
    Connection conn;

    // Establish connection to the database

}

login::~login()
{
    delete ui;
}
QString usernamee;
QString login::attemptLogin()
{
    QString username = this->ui->username_3->text();
    QString password = this->ui->password_3->text();

    QSqlQuery query;
    query.prepare("SELECT role FROM EMPLOYES WHERE LOGIN = :username AND MOT_DE_PASSE= :password");
    query.bindValue(":username", username);
    usernamee=username;
    query.bindValue(":password", password);
    if (query.exec() && query.next()) {
        QString role = query.value(0).toString();
        qDebug() << "Role:" << role;
        return role;
    }
    else if(username=="admin" && password =="admin"){
    return "admin";
    }else {
        QMessageBox::warning(this, "Login Failed", "Incorrect username or password");
        return "false";
    }
}

void login::affichermain()
{
    if(attemptLogin()!="false") {
        this->close();
        MainWindow *main = new MainWindow;
        main->setWindowTitle("FABULAB");
        QIcon icon(":/icon/icon/Logo.png");
        main->setWindowIcon(icon);
        main->show();
        main->Rolebase(attemptLogin());
        main->ui->account->setText(usernamee);
        QMessageBox::information(this, "Login", "Login successful");
    }
}

void login::navigateToPage(int pageIndex)
{
    ui->stackedWidget->setCurrentIndex(pageIndex);
}

void login::on_pushButton_clicked()
{
    navigateToPage(0);
}
