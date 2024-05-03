#ifndef USERLIST_H
#define USERLIST_H

#include <QWidget>
#include <QMap>
#include <QByteArray>
#include <QPair>

QT_BEGIN_NAMESPACE
namespace Ui { class userlist; }
QT_END_NAMESPACE

class userlist : public QWidget
{
    Q_OBJECT

public:
    userlist(QWidget *parent = nullptr);
    ~userlist();

private slots:
    void on_update_clicked();
    void on_delete_2_clicked();
    void on_confirm_clicked();
    void on_taable_cellChanged(int row, int column);
    void on_taable_cellDoubleClicked(int row, int column);

    void on_comboBox_currentIndexChanged(int index);
    void searchTable(const QString &text);
    void on_generate_pdf_clicked();

private:
    Ui::userlist *ui;
    QMap<QPair<int, int>, QString> originalData; // Store the original data
    QMap<QPair<int, int>, QString> modifiedData;
    QMap<int, QByteArray> imageMap;
    QString selectimage();
    void fetching();
    int onTableSelectionChanged();
    void deleteSelectedRow(int selectedRow);
    void orderingid();
};

#endif // USERLIST_H
