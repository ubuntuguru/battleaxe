#include "i2c.h"
#include <unistd.h>

short int mag3110_readx(char addr){
	char m,l;
	int r;
	i2c_write(addr, 0x01);// x-axis MSB
	usleep(2);
	//i2c_read8(addr);
	m = i2c_read8(addr);
	usleep(2);
	i2c_write(addr, 0x02);// x-axis LSB
	usleep(5);
	//i2c_read8(addr);
	l = i2c_read8(addr);
	printf("%f %f\n", (float)m, (float)l);
	r = (int)(l|(m<<8));
	return r;
}
short int mag3110_ready(char addr){
	char m,l;
	int r;
	i2c_write(addr, 0x03);// x-axis MSB
	usleep(2);
	m = i2c_read8(addr);
	usleep(2);
	i2c_write(addr, 0x04);// x-axis LSB
	usleep(2);
	l = i2c_read8(addr);
	r = ((m<<8)+l);
	return r;
}
int mag3110_readz(char addr){
	char m,l;
	int r;
	i2c_write(addr, 0x05);// x-axis MSB
	usleep(2);
	m = i2c_read8(addr);
	usleep(2);
	i2c_write(addr, 0x06);// x-axis LSB
	usleep(2);
	l = i2c_read8(addr);
	r = (l|(m<<8));
	return r;
}
char mag3110_config(char addr){
	i2c_write8(addr, 0x11, 0x80);
	//i2c_write(addr, 0x80);
	//sleep(15);
	i2c_write8(addr, 0x10, 0x01);
	//i2c_write(addr, 0x01);
	//sleep(15);
	return 0;
}
