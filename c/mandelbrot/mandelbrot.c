/*
 *  Mandelbrot server file
 *  Created by Tim Lambert on 02/04/12.
 *  Containing code created by Richard Buckland on 28/01/11.
 *  Adapted by Dylan Nguyen on 27/4/19
 *  Copyright 2012 Licensed under Creative Commons SA-BY-NC 3.0.
 *
 */

#include <stdlib.h>
#include <stdio.h>
#include <netinet/in.h>
#include <string.h>
#include <assert.h>
#include <unistd.h>
#include <math.h>

/* ===================== *
 * Server defines        *
 * ===================== */

#define SIMPLE_SERVER_VERSION 1.0
#define REQUEST_BUFFER_SIZE 1000
#define DEFAULT_PORT 1980

// after serving this many pages the server will halt
#define NUMBER_OF_PAGES_TO_SERVE 1000

/* ===================== *
 * BMP header defines    *
 * ===================== */

#define BYTES_PER_PIXEL 3
#define BITS_PER_PIXEL (BYTES_PER_PIXEL*8)
#define NUMBER_PLANES 1
#define PIX_PER_METRE 2835
#define MAGIC_NUMBER 0x4d42
#define NO_COMPRESSION 0
#define OFFSET 54
#define DIB_HEADER_SIZE 40
#define NUM_COLORS 0

// Must be multiples of 4
#define WIDTH 512
#define HEIGHT 512

// Max steps
//define MAX_STEPS 256

typedef unsigned char  bits8;
typedef unsigned short bits16;
typedef unsigned int   bits32;

typedef struct _triordinate {
   double x;
   double y;
   int z;
} triordinate;

struct pixel {
  bits8 red;
  bits8 green;
  bits8 blue;
};

typedef struct pixel pixel;

struct coords {
	int zoom;
	double x;
	double y;
};

typedef struct coords coords;

/* ===================== *
 * Mandelbrot defines    *
 * ===================== */

struct complex {
   double re; // x coordinate
   double im; // y coordinate
};

typedef struct complex complex;

/* ===================== *
 * Include files that use
	complex				    *
 * ===================== */
#include "mandelbrot.h"
#include "pixelColor.c"

/* ===================== *
 * Function declarations *
 * ===================== */
double invPower(int base, int power);
complex toComplex(double x, double y);
complex add(complex z, complex w);
complex multiply(complex z, complex w);
int modulusSquared(complex z);
int waitForConnection(int serverSocket);
int makeServerSocket(int portno);
int extractCoordinates(char *request, complex *centre, int *zoom);
void writeHTML(FILE *stream);
void writeBMP(FILE *stream, complex centre, int zoom);
void writeBMPHeader(FILE *file);
void writePixels(FILE *file, complex centre, int zoom);
triordinate extract (char *message);
double myAtoD (char *message);
long myAtoL (char *message);

/* ======================== *
 * Function implementations *
 * ======================== */

int main(int argc, char *argv[]) {
   printf ("************************************\n");
   printf ("Starting simple server %f\n", SIMPLE_SERVER_VERSION);
   printf ("Serving bmps since 2012\n");

   int serverSocket = makeServerSocket (DEFAULT_PORT);
   printf ("Access this server at http://localhost:%d/\n", DEFAULT_PORT);
   printf ("************************************\n");

   char request[REQUEST_BUFFER_SIZE];

   int numberServed = 0;
   while (numberServed < NUMBER_OF_PAGES_TO_SERVE) {

      printf ("*** So far served %d pages ***\n", numberServed);

      int connectionSocket = waitForConnection (serverSocket);
      // wait for a request to be sent from a web browser, open a new
      // connection for this conversation

      // read the first line of the request sent by the browser
      int bytesRead;
      bytesRead = read (connectionSocket, request, (sizeof request)-1);
      assert (bytesRead >= 0);
      // were we able to read any data from the connection?

      // print entire request to the console
      printf (" *** Received http request ***\n \"%s\"\n", request);

      // Investigate to extract information from the request!
      printf (" *** Sending http response ***\n");
      FILE *stream = fdopen(connectionSocket, "wb");
      complex centre;
      int zoom;
		int isBMP = extractCoordinates(request, &centre, &zoom);
      if(isBMP){
      	writeBMP(stream, centre, zoom);
		} else {
			writeHTML(stream);
      }

      // close the connection after sending the page- keep aust beautiful
      fclose(stream);

      numberServed++;
   }

   // close the server connection after we are done- keep aust beautiful
   printf ("** shutting down the server **\n");
   close (serverSocket);

   return EXIT_SUCCESS;
}

int extractCoordinates(char *request, complex *centre, int *zoom) {
   // Set the values for centre and zoom according to the msg request	
	if(request[6] != 'H'){	
		triordinate data;	

		//zoom stuff
		int i = 0;
		while(request[i] != '2'){
			i++;
		}
		i = i + 2; //This skips past the "/" after the 2 in the link
		char zoomChar[6];
		int j = 0;
		while(request[i] != '/'){
			zoomChar[j] = request[i];
			i++;
			j++;
		}
		zoomChar[j] = '\0';
		data.z = myAtoL(zoomChar); 	//Call the AtoL function to turn zoomChar into a long
		i = i + 1; 	//This skips past the "/" before the x coordinate
	
		//x coordinate stuff
		char xcoord[10]; //makes string of length 10
		int k = 0;
		while(request[i] != '/'){ //iterate through link until end point is reached
			xcoord[k] = request[i];
			i++;
			k++;
		}
		xcoord[k] = '\0';
		if(xcoord[0] == '-'){	//if number is negative, multiply by -1
			data.x = -1 * myAtoD(xcoord);
		} else {
			data.x = myAtoD(xcoord);
		}
		i++; //Skips past the / before y coordinate
	
		//y coordinate stuff
		char ycoord[10]; // makes a string of length 10
		int n = 0;
		while(request[i] != '/'){ //iterate through the link
			ycoord[n] = request[i];
			i++;
			n++;
		}
		ycoord[n] = '\0';
		if(ycoord[0] == '-'){	//if number is negative, multiply by -1
			data.y = -1 * myAtoD(ycoord);
		} else {
			data.y = myAtoD(ycoord);
		}
		centre->re = data.x;
		centre->im = data.y;
		*zoom = data.z;
		return 1;
	} else {
		return 0;
	}
}

double myAtoD (char *message){
	int digits = strlen(message) - 1;
	double number = 0;
	int m = 0;
	while(message[m] != '\0'){
		int currentDigit = m;
		if(message[m] == '-'){
			m++;
			continue;
		}
		if(message[m] == '.'){
			int toDivide = pow(10, digits - m + 1);
			while(message[m] != '\0'){	
				if(message[m+1] != '\0'){
					currentDigit = message[m+1] - '0';
					number = number + (currentDigit * pow(10, digits - m));
				}
				m++;
			}
			number = number/toDivide;
			break;
		}	else {
			currentDigit = message[m] - '0';
			number = number + (currentDigit * pow(10, digits - m));
			m++;
		}
	}
	return number;
}

long myAtoL (char *message){
	int digits = strlen(message) - 1;
	long number = 0;
	int m = 0;
	while(message[m] != '\0'){
		int currentDigit = message[m] - '0';
		number = number + (currentDigit * pow(10, digits - m));
		m = m + 1;
	}
	return number;
}

void writeHTML(FILE *stream) {
   char * message =
      "HTTP/1.0 200 OK\r\n"
      "Content-Type: text/html\r\n"
      "\r\n"
      "<HTML><script src=\"http://almondbread.cse.unsw.edu.au/tiles.js\"></script></HTML>";
   printf("about to send=> %s\n", message);
   fwrite(message, strlen(message), 1, stream);
}

/* ======================== *
 * BMP functions            *
 * ======================== */

void writeBMP(FILE *stream, complex centre, int zoom) {
   char* message;

   // Send the http response header
   message =
    "HTTP/1.0 200 OK\r\n"
    "Content-Type: image/bmp\r\n"
    "\r\n";
   printf ("about to send=> %s\n", message);
   fwrite (message, strlen(message), 1, stream);

   writeBMPHeader(stream);
   writePixels(stream, centre, zoom);
}

// Send BMP pixel array
void writePixels(FILE *stream, complex centre, int zoom) {
   /* ====================================================== *
    * Print the pixel array for a mandelbrot set using 		 *
    * escapeSteps and stepsToRed, stepsToGreen, stepsToBlue  *
    * ====================================================== */
	double scale = invPower(2, zoom);
   pixel p;
	complex pix;
   int row = 0;
   while (row < HEIGHT) {
      int col = 0;
		pix.im = centre.im + (row + 0.5 - (0.5*HEIGHT))*scale;
      while (col < WIDTH) {
			pix.re = centre.re + (col + 0.5 - (0.5*WIDTH))*scale;	
			p.red = stepsToRed(escapeSteps(pix.re, pix.im));
			p.green = stepsToGreen(escapeSteps(pix.re, pix.im));
			p.blue = stepsToBlue(escapeSteps(pix.re, pix.im));
	   	fwrite (&p, sizeof p, 1, stream);
			col++;
      }
		row++;
   }
}

// Send BMP header
void writeBMPHeader(FILE *file) {
   assert(sizeof (bits8) == 1);
   assert(sizeof (bits16) == 2);
   assert(sizeof (bits32) == 4);

   bits16 magicNumber = MAGIC_NUMBER;
   fwrite (&magicNumber, sizeof magicNumber, 1, file);

   bits32 fileSize = OFFSET + (WIDTH * HEIGHT * BYTES_PER_PIXEL);
   fwrite (&fileSize, sizeof fileSize, 1, file);

   bits32 reserved = 0;
   fwrite (&reserved, sizeof reserved, 1, file);

   bits32 offset = OFFSET;
   fwrite (&offset, sizeof offset, 1, file);

   bits32 dibHeaderSize = DIB_HEADER_SIZE;
   fwrite (&dibHeaderSize, sizeof dibHeaderSize, 1, file);

   bits32 width = WIDTH;
   fwrite (&width, sizeof width, 1, file);

   bits32 height = HEIGHT;
   fwrite (&height, sizeof height, 1, file);

   bits16 planes = NUMBER_PLANES;
   fwrite (&planes, sizeof planes, 1, file);

   bits16 bitsPerPixel = BITS_PER_PIXEL;
   fwrite (&bitsPerPixel, sizeof bitsPerPixel, 1, file);

   bits32 compression = NO_COMPRESSION;
   fwrite (&compression, sizeof compression, 1, file);

   bits32 imageSize = (WIDTH * HEIGHT * BYTES_PER_PIXEL);
   fwrite (&imageSize, sizeof imageSize, 1, file);

   bits32 hResolution = PIX_PER_METRE;
   fwrite (&hResolution, sizeof hResolution, 1, file);

   bits32 vResolution = PIX_PER_METRE;
   fwrite (&vResolution, sizeof vResolution, 1, file);

   bits32 numColors = NUM_COLORS;
   fwrite (&numColors, sizeof numColors, 1, file);

   bits32 importantColors = NUM_COLORS;
   fwrite (&importantColors, sizeof importantColors, 1, file);
}

/* ======================== *
 * Escape steps functions   *
 * ======================== */

int escapeSteps (double x, double y) {
   complex first = toComplex(x, y);
	complex z = toComplex(x, y);
	int steps = 0;
	while(modulusSquared(z) <= 4 && steps < MAX_STEPS){
		z = add(multiply(z, z), first);
		steps++;
	}	
	return steps;
}

complex toComplex(double x, double y){
	complex a;
	a.re = x;
	a.im = y;
	return a;
}

complex add(complex z, complex w){
	complex a;
	a.re = z.re + w.re;
	a.im = z.im + w.im;
	return a;
}

complex multiply(complex z, complex w){
	complex a;
	a.re = z.re * w.re - z.im * w.im;
	a.im = z.im * w.re + z.re * w.im;
	return a;
}

int modulusSquared(complex z){
	int a = z.re * z.re + z.im * z.im;
	return a;
}

/* ======================== *
 * power function			    *
 * ======================== */
double invPower(int base,  int power){
	if(power == 0){
		return 1;
	} else {
		double x = (double)base;
		int i = 0;
		while (i <= power){
			x = x/base;
			i++;
		}
		return x;
	}
}

/* ======================== *
 * Server functions         *
 * ======================== */

// start the server listening on the specified port number
int makeServerSocket (int portNumber) {

   // create socket
   int serverSocket = socket (AF_INET, SOCK_STREAM, 0);
   assert (serverSocket >= 0);
   // error opening socket

   // bind socket to listening port
   struct sockaddr_in serverAddress;
   memset ((char *) &serverAddress, 0,sizeof (serverAddress));

   serverAddress.sin_family      = AF_INET;
   serverAddress.sin_addr.s_addr = INADDR_ANY;
   serverAddress.sin_port        = htons (portNumber);

   // let the server start immediately after a previous shutdown
   int optionValue = 1;
   setsockopt (
      serverSocket,
      SOL_SOCKET,
      SO_REUSEADDR,
      &optionValue,
      sizeof(int)
   );

   int bindSuccess =
      bind (
         serverSocket,
         (struct sockaddr *) &serverAddress,
         sizeof (serverAddress)
      );

   // if this assert fails wait a short while to let the operating
   // system clear the port before trying again

   return serverSocket;
}

// wait for a browser to request a connection,
// returns the socket on which the conversation will take place
int waitForConnection (int serverSocket) {
   // listen for a connection
   const int serverMaxBacklog = 10;
   listen (serverSocket, serverMaxBacklog);

   // accept the connection
   struct sockaddr_in clientAddress;
   socklen_t clientLen = sizeof (clientAddress);
   int connectionSocket =
      accept (
         serverSocket,
         (struct sockaddr *) &clientAddress,
         &clientLen
      );

   assert (connectionSocket >= 0);
   // error on accept

   return (connectionSocket);
}
