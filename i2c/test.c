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
 
	
	int addr = 0x49; /* The I2C address */

	if(i2c_setup(addr) < 0){
		print("err setup");
	}
	i2c_set_slave(addr);
	if(i2c_write16(addr, 0x01, 0b10000011, 0x03)<0) print("er r");
	i2c_read16(addr);
	i2c_read16(addr);
	sleep(1);
	i2c_write(addr, 0);
	printf("value: %f\n", (float)i2c_read16(addr)*4.096/32767.0);
	printf("value: %f\n", (float)i2c_read16(addr)*4.096/32767.0);
	printf("value: %f\n", (float)i2c_read16(addr)*4.096/32767.0);
		if(i2c_write16(addr, 0x01, 0b10010011, 0x03)<0) print("er r");
	i2c_read16(addr);
	i2c_read16(addr);
	sleep(1);
	i2c_write(addr, 0);
	printf("value: %f\n", (float)i2c_read16(addr)*4.096/32767.0);
	printf("value: %f\n", (float)i2c_read16(addr)*4.096/32767.0);
	printf("value: %f\n", (float)i2c_read16(addr)*4.096/32767.0);
		
	i2c_set_slave(0x0e);
	mag3110_config(0x0e);
	//i2c_read16(0x0e);
	printf("Value: %f\n", (float)mag3110_readx(0x0e));
	printf("Value: %f\n", (float)mag3110_ready(0x0e));
	printf("Value: %f\n", (float)mag3110_readz(0x0e));
	printf("Value: %f\n", (float)((atan2(mag3110_ready(0x0e), mag3110_readx(0x0e))*180)/M_PI));
	
	
	
	i2c_set_slave(0x1e);
	i2c_write8(0x1e, 0x00, 0x14);
	i2c_write8(0x1e, 0x02, 0x00);
	short int x,y,z;
	unsigned char xh,xl,yh,yl,zh,zl;
	i2c_write(0x1e, 0x03);
	xh=i2c_read8(0x1e);
	i2c_write(0x1e, 0x04);
	xl=i2c_read8(0x1e);
	i2c_write(0x1e, 0x05);
	yh=i2c_read8(0x1e);
	i2c_write(0x1e, 0x06);
	yl=i2c_read8(0x1e);
	i2c_write(0x1e, 0x07);
	zh=i2c_read8(0x1e);
	i2c_write(0x1e, 0x08);
	zl=i2c_read8(0x1e);
	x = (short int)((xh << 8) + xl);
	y = (short int)((yh << 8) + yl);
	printf("v %f %f\n", (float)x,(float)y);
	printf("Value: %f\n", (float)(atan2(y, x)*180)/M_PI);
	
	float MagMinX, MagMaxX;
float MagMinY, MagMaxY;
float MagMinZ, MagMaxZ;

	while(1){
	//sleep(1);
	i2c_write(0x1e, 0x03);
	xh=i2c_read8(0x1e);
	i2c_write(0x1e, 0x04);
	xl=i2c_read8(0x1e);
	i2c_write(0x1e, 0x05);
	yh=i2c_read8(0x1e);
	i2c_write(0x1e, 0x06);
	yl=i2c_read8(0x1e);
	i2c_write(0x1e, 0x07);
	zh=i2c_read8(0x1e);
	i2c_write(0x1e, 0x08);
	zl=i2c_read8(0x1e);
	x = (short int)((xh << 8) + xl);
	y = (short int)((yh << 8) + yl);
	z = (short int)((zh << 8) + zl);
	
	
	  if (x < MagMinX) MagMinX = x;
  if (x > MagMaxX) MagMaxX = x;
  
  if (y < MagMinY) MagMinY = y;
  if (y > MagMaxY) MagMaxY = y;
 
  if (z < MagMinZ) MagMinZ = z;
  if (z > MagMaxZ) MagMaxZ = z;
	printf("v %f %f\n", (float)x,(float)y);
	printf("Value: %f\n", (float)atan2(y, x)*180/M_PI);
	printf("Mag  X Cal %f %f\n", MagMinX, MagMaxX);
	printf("Mag  Y Cal %f %f\n", MagMinY, MagMaxY);
	printf("Mag  Z Cal %f %f\n", MagMinY, MagMaxZ);
	
	}
	return 0;
}
