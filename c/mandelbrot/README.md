These are the files that I made to create a web server that displayed the mandelbrot set. The mandelbrot.c file creates a web server that can give images of particular spots on the Mandelbrot set. It does this by extracting a set of coordinates from the user's HTTP GET request, determining how many steps it would take for each particular point in that image to "escape" the set, and colours each pixel accordingly. The pixelColor.c file then decides what each pixel should be coloured to represent how long it took to "escape." It is by far one of the most ambitious projects I've done to date!

To run the program, compile and run mandelbrot.c using the Terminal. Then connect to http://localhost:1980/mandelbrot/2/{zoom}/{x coordinate}/{y coordinate}/tile.bmp

you might have to restart the server after a period of inactivity

I'd suggest looking at some of these cool spots:
http://localhost:1980/mandelbrot/2/7/0/0/tile.bmp
http://localhost:1980/mandelbrot/2/12/-0.7463/0.1102/tile.bmp
