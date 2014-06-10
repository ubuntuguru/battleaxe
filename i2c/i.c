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

int main(void){
 
	int file;
	int adapter_nr = 1; /* probably dynamically determined */
	char filename[20];
	
	snprintf(filename, 19, "/dev/i2c-%d", adapter_nr);
	file = open(filename, O_RDWR);
	if (file < 0) {
		/* ERROR HANDLING; you can check errno to see what went wrong */
		exit(1);
	}

	int addr = 0x48; /* The I2C address */

	if (ioctl(file, I2C_SLAVE, addr) < 0) {
		/* ERROR HANDLING; you can check errno to see what went wrong */
		exit(1);
	}

	__u8 reg = 0x00;
	__s32 res;
	char buf[10];

	buf[0] = reg;
	if (write(file, buf, 1) !=1) {
		/* ERROR HANDLING: i2c transaction failed */
	}

	/* Using I2C Read, equivalent of i2c_smbus_read_byte(file) */
	if (read(file, buf, 1) != 1) {
		/* ERROR HANDLING: i2c transaction failed */
	} else {
		/* buf[0] contains the read byte */
						printf("Channel	Data:	%u\n",buf[0]);	
}
return 0;
}
