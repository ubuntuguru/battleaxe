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
#include <math.h>
#include "i2c.h"
#include "mag3110.h"

int main(void){
 
	int xh,xl,yh,yl,zh,zl,x,y,z;	
	int addr = 0x05; /* The I2C address */
	int d = 800;
	if(i2c_setup(addr) < 0){
		print("err setup");
	}
	//vcnl4000
	i2c_set_slave(0x13);
	i2c_write8(0x13, 0x80, 0x08);
	usleep(50000);
	i2c_write(0x13, 0x80);
	usleep(10000);
	i2c_write(0x13, 0x87);
	printf("vcnl %u", i2c_read16(0x13));
	//motor controller
	i2c_set_slave(addr);
	i2c_write(addr, 0x10);

	while(d > 92){
		i2c_write(0x70, 0x51);
		usleep(65000);
		d = i2c_read16(0x70);
		printf(" %u\n", d);



	}
	i2c_write(addr, 0x00);	
	return 0;
}
