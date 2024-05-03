// imagewidget.h
#ifndef IMAGEWIDGET_H
#define IMAGEWIDGET_H

#include <QWidget>
#include <QLabel>

class ImageWidget : public QLabel
{
    Q_OBJECT

public:
    explicit ImageWidget(QWidget *parent = nullptr);
    void setImage(const QPixmap &pixmap);

private:
    // You can add other necessary functions or variables here
};

#endif // IMAGEWIDGET_H
