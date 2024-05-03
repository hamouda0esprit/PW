
#include "connection.h"
#include "login/login.h"

#include <QApplication>
#include <QMessageBox>
#include <QIcon>

int main(int argc, char *argv[])
{
    QApplication a(argc, argv);

    // Create instances of Login, MainWindow, and Connection
    login log;
    Connection c;

    // Set up MainWindow
    log.setWindowTitle("FABULAB");
    QIcon icon(":/icon/icon/Logo.png");
    log.setWindowIcon(icon);

    // Attempt to connect to the database
    bool test = c.createconnect();
    if(!test)
    {
        QMessageBox::critical(nullptr, QObject::tr("Database Connection"), QObject::tr("Connection failed.\n Click Cancel to exit."), QMessageBox::Cancel);
        return -1; // Exit the application if database connection fails
    }
    else{
        log.show();
    }
    // Show the login window





    return a.exec();
}
