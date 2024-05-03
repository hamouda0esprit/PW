#ifndef STATISTIC_H
#define STATISTIC_H

#include <QDialog>

namespace Ui {
class statistic;
}

class statistic : public QDialog
{
    Q_OBJECT

public:
    explicit statistic(QWidget *parent = nullptr);
    ~statistic();


private slots:
   // void on_comboBox_currentIndexChanged(int index);

private:
    Ui::statistic *ui;


};

#endif // STATISTIC_H
