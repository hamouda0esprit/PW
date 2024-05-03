QT += core gui sql xml uitools
QT+=sql serialport
greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

CONFIG += c++11

QT += printsupport
QT += axcontainer

QT += core gui charts


QT += multimedia
QT += widgets

QT += network

# The following define makes your compiler emit warnings if you use
# any Qt feature that has been marked deprecated (the exact warnings
# depend on your compiler). Please consult the documentation of the
# deprecated API in order to know how to port your code away from it.
DEFINES += QT_DEPRECATED_WARNINGS

# You can also make your code fail to compile if it uses deprecated APIs.
# In order to do so, uncomment the following line.
# You can also select to disable deprecated APIs only up to a certain version of Qt.
#DEFINES += QT_DISABLE_DEPRECATED_BEFORE=0x060000    # disables all the APIs deprecated before Qt 6.0.0

SOURCES += \
    Arduino.cpp \
    Room/liste.cpp \
    Room/room.cpp \
    Room/salle.cpp \
    Room/statistic.cpp \
    connection.cpp \
    formation/formation.cpp \
    formation/nour_mainwindow.cpp \
    login/employee.cpp \
    login/login.cpp \
    login/maininterface.cpp \
    login/userlist.cpp \
    main.cpp \
    mainwindow.cpp \
    membres/ahmed_imagewidget.cpp \
    membres/ahmed_mainwindow.cpp \
    membres/ahmed_membre.cpp \
    reservation/reservation2.cpp \
    projets/projet.cpp



FORMS += \
    Room/liste.ui \
    Room/room.ui \
    Room/statistic.ui \
    login/login.ui \
    login/maininterface.ui \
    mainwindow.ui \
    login/userlist.ui \
    reservation/reservation2.ui\

HEADERS += \
    Arduino.h \
    Room/liste.h \
    Room/room.h \
    Room/salle.h \
    Room/statistic.h \
    connection.h \
    formation/formation.h \
    login/employee.h \
    login/login.h \
    login/maininterface.h \
    login/userlist.h \
    mainwindow.h \
    membres/ahmed_imagewidget.h \
    membres/ahmed_membre.h \
    reservation/reservation2.h \
    projets/projet.h

# Default rules for deployment.
qnx: target.path = /tmp/$${TARGET}/bin
else: unix:!android: target.path = /opt/$${TARGET}/bin
!isEmpty(target.path): INSTALLS += target

RESOURCES += \
    reservation/res.qrc \
    resource.qrc \

DISTFILES += \
    Room/image/+.png \
    Room/image/book.png \
    Room/image/booking.ai \
    Room/image/bookingg.png \
    Room/image/confirm.png \
    Room/image/e.png \
    Room/image/equip.ai \
    Room/image/equip.png \
    Room/image/f.png \
    Room/image/fleche.png \
    Room/image/fleche2.png \
    Room/image/graf-01.png \
    Room/image/graf.ai \
    Room/image/graf2-01.png \
    Room/image/list.png \
    Room/image/liste.png \
    Room/image/load.png \
    Room/image/logo.png \
    Room/image/mise.png \
    Room/image/pdf.png \
    Room/image/plus.ai \
    Room/image/plus.png \
    Room/image/project.ai \
    Room/image/projectt.png \
    Room/image/room.ai \
    Room/image/rooom.png \
    Room/image/stat.ai \
    Room/image/stat.png \
    Room/image/static.ai \
    Room/image/statii.png \
    Room/image/statistic.png \
    Room/image/supp.png \
    icon/List.png \
    icon/Logo.png \
    icon/Untitled.png \
    icon/aana.jpg \
    icon/account-logout-64.ico \
    icon/activity-feed-32.ico \
    icon/activity-feed-48.ico \
    icon/audit_6462731.png \
    icon/book.png \
    icon/bookingg.png \
    icon/bookw.png \
    icon/check-mark_1207330.png \
    icon/close-window-64.ico \
    icon/dashboard-5-32.ico \
    icon/dashboard-5-48.ico \
    icon/delete_3983957.png \
    icon/diploma_4706145.png \
    icon/e.png \
    icon/edit-file_4134958.png \
    icon/edit_1443396.png \
    icon/equip.png \
    icon/equipw.png \
    icon/f.png \
    icon/fleche.png \
    icon/fleche2.png \
    icon/group-32.ico \
    icon/group-48.ico \
    icon/home-4-32.ico \
    icon/home-4-48.ico \
    icon/list1.png \
    icon/list_1441035.png \
    icon/loading-arrows_11140996.png \
    icon/menu-4-32.ico \
    icon/pdf_8304568.png \
    icon/pie-chart_11176378.png \
    icon/plus (2).png \
    icon/plus.png \
    icon/plus2.png \
    icon/product-32.ico \
    icon/product-48.ico \
    icon/projectt.png \
    icon/projectw.png \
    icon/replay_2475690.png \
    icon/roomw.png \
    icon/rooom.webp \
    icon/search-13-48.ico \
    icon/search_5807787.png \
    icon/setting_6874449.png \
    icon/statii.png \
    icon/statistic.png \
    icon/stats.png \
    icon/user-48.ico \
    icon/uuuu.jpg \
    icon/5989084.png \
    login/Et.png \
    login/README.md \
    login/copyright.png \
    login/fleche.png \
    login/icon.png \
    login/icond.png \
    login/key.png \
    login/logo.png \
    membres/FaceID/images/Ahmed.jpg \
    membres/FaceID/images/Flibby.jpg \
    membres/FaceID/images/Mustapha.jpg \
    membres/FaceID/images/Nour.jpg \
    membres/ahmed_style.qss \
    style.qss
