#ifndef MAG3110_H
#define MAG3110_H

#define MAG3110_ADDR = 0x0E

int mag3110_readx(char addr);
int mag3110_ready(char addr);
int mag3110_readz(char addr);
char mag3110_config(char addr);






#endif