#ifndef LISTE_H
#define LISTE_H

#include <QDialog>
#include <QTableWidget>
#include <QSqlQueryModel>

namespace Ui {
class liste;
}

class liste : public QDialog
{
    Q_OBJECT

public:
    explicit liste(QWidget *parent = nullptr);

    ~liste();


private slots:


    void on_confirm_clicked();
    void data_import();
    void orderingid();
    int onTableSelectionChanged();
    void on_taable_cellChanged(int row, int column);



    void on_update_clicked();

  void deleteSelectedRow(int selectedRow);
    void on_delete_2_clicked();

    void on_pushButton_3_clicked();

    void on_comboBox_currentIndexChanged(int index);

private:
    Ui::liste *ui;

};

#endif // LISTE_H
