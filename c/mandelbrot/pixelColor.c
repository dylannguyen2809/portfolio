//Program by Dylan Nguyen on 27/4/19
//This program decides on the colours for the pixels in the Mandelbrot program

#include "pixelColor.h"
#define BLACK 0
#define WHITE 255

int r = 2;
int b = 2;
unsigned char stepsToRed (int steps) {
	unsigned char intensity;
	if(steps < 85){
		intensity = 85;
	} else if(steps < 170){
		intensity = 170;
	} else {
		intensity = 255;
	}
	return intensity;
}

unsigned char stepsToBlue (int steps) {
	unsigned char intensity;
	if(steps < 85){
		intensity = 255;
	} else if(steps < 170){
		intensity = 85;
	} else {
		intensity = 170;
	}
	return intensity;
}

unsigned char stepsToGreen (int steps) {
	unsigned char intensity;
	if(steps < 127){
		intensity = steps*2;
	} else {
		intensity = 200-steps;
	}
	return intensity;
}
