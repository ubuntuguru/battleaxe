#ifndef I2C_H
#define I2C_H

extern int i2c_file;
//extern int adapter_nr = 1; /* probably dynamically determined */
//extern char i2c_buf[10];


char write8(char, char, char);
char i2c_write(char, char);
int write16(char slave_dev, int data);
char read8(char slave_dev);
int read16(char slave_dev);
char set_slave(char addr);
char i2c_setup(char adapter);

#endif