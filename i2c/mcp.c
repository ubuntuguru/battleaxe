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

	if(i2c_setup(0x23) < 0){
		printf("err");
	}
	i2c_set_slave(0x27);
	i2c_write8(0x27, 0x00, 0x00);
	sleep(1);
	i2c_write8(0x27, 0x06, 0x00);
	sleep(1);
	i2c_write8(0x27, 0x0A, 0xff);
	sleep(1);
	i2c_write8(0x27, 0x09, 0xf0);
	return 0;
}
