
//functions for simpler i2c communication


char write8(char slave_dev, char reg, char data){
	set_slave(slave_dev);
	i2c_buf[0] = reg;
	i2c_buf[1] = data;
if (write(file, inc_buf, 2) ! =2) {
    /* ERROR HANDLING: i2c transaction failed */
	return -1;
  }
  return 0;
}
char write16(char slave_dev, char data){

}
char read8(char slave_dev){
  if (read(file, buf, 1) != 1) {
    /* ERROR HANDLING: i2c transaction failed */
	return -1;
  } else {
    /* i2c_buf[0] contains the read byte */
	return i2c_buf[0];
  }
}
int read16(char slave_dev){
  if (read(file, buf, 2) != 2) {
    /* ERROR HANDLING: i2c transaction failed */
	return -1;
  } else {
    /* i2c_buf[0,1] contains the read byte */
	
	return ((i2c_buf[0]<<8)+i2c_buf[1]);
  }
}
char set_slave(int addr){

  if (ioctl(i2c_file, I2C_SLAVE, addr) < 0) {
    /* ERROR HANDLING; you can check errno to see what went wrong */
	return -1;
  }
	return 0;
}
char i2c_setup(char adapter_nr){
  snprintf(filename, 19, "/dev/i2c-%d", adapter_nr);
  i2c_file = open(filename, O_RDWR);
  if (i2c_file < 0) {
    /* ERROR HANDLING; you can check errno to see what went wrong */
    exit(1);
  }
}