// imagewidget.cpp
#include "membres/ahmed_imagewidget.h"

ImageWidget::ImageWidget(QWidget *parent) : QLabel(parent)
{
    // Additional initialization if needed
}

void ImageWidget::setImage(const QPixmap &pixmap)
{
    setPixmap(pixmap);
    setScaledContents(true);  // Ensure the image scales to fit the widget
}
