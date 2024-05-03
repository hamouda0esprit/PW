#include "Arduino.h"

Arduino::Arduino() {
    serial = new QSerialPort(); // Create a new QSerialPort instance
    arduinoIsAvailable = false; // Initially, Arduino is not available
}

int Arduino::connect_arduino() {
    // Search for available serial ports
    foreach (const QSerialPortInfo &serial_port_info, QSerialPortInfo::availablePorts()) {
        if (serial_port_info.hasVendorIdentifier() && serial_port_info.hasProductIdentifier()) {
            if (serial_port_info.vendorIdentifier() == arduino_uno_vendor_id &&
                serial_port_info.productIdentifier() == arduino_uno_producy_id) {
                // Arduino Uno is found
                arduinoIsAvailable = true;
                arduinoPortName = serial_port_info.portName();
                qDebug() << "Arduino port name is: " << arduinoPortName;

                // Configure and open the serial port
                serial->setPortName(arduinoPortName);
                if (serial->open(QSerialPort::ReadWrite)) {
                    serial->setBaudRate(QSerialPort::Baud9600);
                    serial->setDataBits(QSerialPort::Data8);
                    serial->setParity(QSerialPort::NoParity);
                    serial->setStopBits(QSerialPort::OneStop);
                    serial->setFlowControl(QSerialPort::NoFlowControl);
                    return 0; // Success: Arduino connected and serial port configured
                } else {
                    qDebug() << "Failed to open serial port for Arduino.";
                    return 1; // Error: Failed to open serial port
                }
            }
        }
    }

    qDebug() << "Arduino not found.";
    return -1; // Error: Arduino not found
}

int Arduino::close_arduino() {
    if (serial->isOpen()) {
        serial->close();
        qDebug() << "Serial port closed.";
        return 0; // Success: Serial port closed
    } else {
        qDebug() << "Serial port is not open.";
        return 1; // Error: Serial port not open
    }
}

int Arduino::write_arduino(QByteArray data) {
    if (serial->isOpen() && serial->isWritable()) {
        serial->write(data);
        qDebug() << "Data written to Arduino: " << data;
        return 0; // Success: Data written to Arduino
    } else {
        qDebug() << "Serial port is not open or not writable. Cannot write data.";
        return 1; // Error: Serial port not open or not writable
    }
}

QByteArray Arduino::readFromArduino() {
    if (serial->isOpen() && serial->isReadable()) {
        data = serial->readAll();
        return data;
    } else {
        qDebug() << "Serial port is not open or not readable. Cannot read data.";
        return QByteArray(); // Return empty byte array as error indicator
    }
}

QSerialPort* Arduino::getSerial() {
    return serial;
}

QString Arduino::getArduinoPortName() {
    return arduinoPortName;
}
