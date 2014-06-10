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
#include "i2c.h"

int main(void){
 
	
	int addr = 0x48; /* The I2C address */

	if(i2c_setup(addr) < 0){
		print("err");
	}
	if(i2c_write(addr, 0x00)<0) print("err");
	printf("value: %u", read8(0x00));
	return 0;
}
