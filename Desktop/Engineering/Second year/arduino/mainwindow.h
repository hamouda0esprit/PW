#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include "projets/projet.h"
#include "formation/formation.h"
#include <QCoreApplication>
#include <QNetworkAccessManager>
#include <QNetworkRequest>
#include <QNetworkReply>
#include <QUrl>
#include <QHttpMultiPart>
#include <QHttpPart>
#include <QFile>
#include <QFileDialog>
#include"Arduino.h"

QT_BEGIN_NAMESPACE
namespace Ui { class MainWindow; }
QT_END_NAMESPACE


struct Sample {
    double price;
    double duration;
    std::string type;
};
struct Project {
    std::string type;
    std::string tech;
    int duration;
};
class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    MainWindow(QWidget *parent = nullptr);
    ~MainWindow();
    void showUpdateForm();
    void Rolebase(QString role);
private slots:
    void navigateToPage(int pageIndex);
    void ahmed_navigateToPage(int pageIndex);
    void ahmed_on_pushButton_confirm_add_clicked();
    void ahmed_deleteSelectedRow();
    void ahmed_validateUpdate();
    void ahmed_on_confirmUpdateButton_clicked();
    void ahmed_update2();
    void ahmed_search();
    void ahmed_filter();
    void ahmed_exportTableToPDF();
    void ahmed_calculateTypePercentage();
    void ahmed_CheckFaceID();
    void on_imageButton_clicked();
    void ahmed_historique();
    QString ahmed_callPythonFunction();

    void nour_navigateToPage(int pageIndex);
    void nour_on_pushButton_confirm_add_clicked();
    void nour_deleteSelectedRow();
    void nour_validateUpdate();
    void nour_on_confirmUpdateButton_clicked();
    void nour_filter();
    void nour_search();
    void nour_calculateTypePercentage();
    void nour_exportTableToPDF();
    void nour_generateCertificate(QString memberName, QString formationName, QString formationEndDate);
    void nour_on_generate_certif_clicked();
    void nour_calculateStateDistribution();
    void nour_aa();
    void on_nour_feelings_recog_clicked();
    bool nour_formationExists(const QString& formationName, QString& formationEndDate);

    void navigateToPageProject(int pageIndex);
    void ajouterProjectBtn();
    void afficher(QString x);
    void UpdatefillComboBox();
    void loadButtonClicked();
    void fetchProjectInfo(const QString& projectId);
    void updateProject();
    void projet_exportTableToPDF();
    std::vector<Sample> readDataFromCSV(const std::string& filename);
    void linearRegression(const std::vector<Sample>& data);
    double predictedPrice(const std::vector<Sample>& data, double duration, const std::string& type);
    QString doubleToQString(double value);
    void Psearch();
    void Psort();
    std::vector<Project> readProjectsFromFile(const std::string& filename);
    std::string findBestTechnology(const std::vector<Project>& projects, const std::string& type, int duration);
    void openMessageBox(const QString& message);
    std::string trim(const std::string& str);
    void projet_calculateTypePercentage();
    void on_ahmed_image_add_clicked();
    void readFromArduinoPeriodically();


public:
    Ui::MainWindow *ui;
    QString selectedImagePath;
    bool test;
    Formation K;
    projet Ptemp;
    Arduino A;
    QByteArray data;
};

#endif // MAINWINDOW_H
