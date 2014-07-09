#ifndef I2C_H
#define I2C_H

extern int i2c_file;
//extern int adapter_nr = 1; /* probably dynamically determined */
//extern char i2c_buf[10];


char i2c_write8(char, char, char);
char i2c_write16(char, char, char, char);
char i2c_write(char, char);
//int i2c_write16(char slave_dev, int data);
char i2c_read8(char slave_dev);
int i2c_read16(char slave_dev);
char i2c_set_slave(char addr);
char i2c_setup(char adapter);

#endif