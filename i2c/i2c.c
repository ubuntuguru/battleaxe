
//functions for simpler i2c communication
#include <errno.h>
#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <linux/i2c-dev.h>
#include <sys/ioctl.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <sys/types.h>
#include <stdio.h>
#include "i2c.h"
int i2c_file;
int adapter_nr = 1;
char filename[20];

char i2c_write8(char slave_dev, char reg, char data)
{
	char i2c_buf[10];
	i2c_set_slave(slave_dev);
	i2c_buf[0] = reg;
	i2c_buf[1] = data;
	if (write(i2c_file, i2c_buf, 2) != 2) {
		/* ERROR HANDLING: i2c transaction failed */
		return -1;
	}
	return 0;
}

char i2c_write16(char slave_dev, char reg, char data, char data2)
{
	char i2c_buf[10];
	//i2c_set_slave(slave_dev);
	i2c_buf[0] = reg;
	i2c_buf[1] = data;
	i2c_buf[2] = data2;
	if (write(i2c_file, i2c_buf, 3) != 3){
		/* ERROR HANDLING: i2c transaction failed */
		return -1;
	}
	return 0;
}

char i2c_write(char slave_dev, char reg)
{
	char i2c_buf[10];
	if (i2c_set_slave(slave_dev) < 0)
		print("err");
	i2c_buf[0] = reg;
	//i2c_buf[1] = reg;
	if (write(i2c_file, i2c_buf, 1) != 1) {
		/* ERROR HANDLING: i2c transaction failed */
		return -1;
	}
	return 0;
}

char i2c_read8(char slave_dev)
{
	char i2c_buf[10];
	if (read(i2c_file, i2c_buf, 1) != 1) {
		/* ERROR HANDLING: i2c transaction failed */
		printf("err");
		return -1;
	} else {
		/* i2c_buf[0] contains the read byte */
		return i2c_buf[0];
	}
}

int i2c_read16(char slave_dev)
{
	char i2c_buf[10];
	if (read(i2c_file, i2c_buf, 2) != 2) {
		/* ERROR HANDLING: i2c transaction failed */
		printf("err reading ");
		return -1;
	} else {
		/* i2c_buf[0,1] contains the read byte */

		return ((i2c_buf[0] << 8) | i2c_buf[1]);
	}
}

char i2c_set_slave(char addr)
{

	if (ioctl(i2c_file, I2C_SLAVE, addr) < 0) {
		/* ERROR HANDLING; you can check errno to see what went wrong */
		return -1;
	}
	return 0;
}

char i2c_setup(char adapter_nr)
{
	snprintf(filename, 19, "/dev/i2c-%d", adapter_nr);
	i2c_file = open("/dev/i2c-1", O_RDWR);
	if (i2c_file < 0) {
		/* ERROR HANDLING; you can check errno to see what went wrong */
		printf
		    ("Error opening i2c bus\n Possible Permissions Issue?\n Invalid Device?\n");
		return -1;
	}
	return 0;
}
