#include "statistic.h"
#include "ui_statistic.h"
#include <QSqlQuery>
#include <QDebug>
#include <vector>
#include <algorithm>
#include <cmath>
#include <QSqlError>
#include <QtCharts/QChartView>
#include <QtCharts/QBarSet>
#include <QtCharts/QBarSeries>
#include <QtCharts/QBarCategoryAxis>
#include <QtCharts/QValueAxis>
#include <QVBoxLayout>
#include <QGraphicsView>
#include <QGraphicsScene>
#include <QGraphicsView>
#include <QtMath>
#include <QtCharts>

QT_CHARTS_USE_NAMESPACE

statistic::statistic(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::statistic)
{
    ui->setupUi(this);



}

statistic::~statistic()
{
    delete ui;
}


//void statistic::on_comboBox_currentIndexChanged(int index)
//{}
