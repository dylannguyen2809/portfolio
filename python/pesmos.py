import math
import pygame
pygame.init()

#variable defs
screen_dimensions = (600, 600)
screen = pygame.display.set_mode(screen_dimensions)
clock = pygame.time.Clock()
zoom = 20
running = True

#function defs
def quitProgram():
    running = True
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            running == False
        if event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
            running = False
    return running

#draws grid
def drawGrid(zoom):
    pygame.draw.line(screen, (100, 100, 100), [300, 0], [300, 600], 1)
    pygame.draw.line(screen, (100, 100, 100), [0, 300], [600, 300], 1)
    xcounter = 0
    ycounter = 0    
    countY = 0
    font = pygame.font.SysFont('arial', int(zoom/2))

    #draws axes and notches on each of the axes according to the scale
    while xcounter <= 300:
        pygame.draw.line(screen, (100, 100, 100), [300, (300+xcounter)], [305, (300+xcounter)], 1)
        text = font.render(str(countY), True, (100, 100, 100))
        screen.blit(text, (310, (295+xcounter)))
        countY = countY - 1
        xcounter = xcounter + zoom
    countY = 1
    xcounter = 300 - zoom
    while xcounter > 0:
        pygame.draw.line(screen, (100, 100, 100), [300, (xcounter + zoom)], [305, (xcounter + zoom)], 1)
        text = font.render(str(countY), True, (100, 100, 100))
        screen.blit(text, (310, (xcounter-5)))
        xcounter = xcounter - zoom
        countY = countY + 1
    countX = 1
    ycounter = zoom
    while ycounter <= 300:
        pygame.draw.line(screen, (100, 100, 100), [(300+ycounter), 295], [(300+ycounter), 300], 1)
        text = font.render(str(countX), True, (100, 100, 100))
        screen.blit(text, ((295+ycounter), 305))
        countX = countX + 1
        ycounter = ycounter + zoom
    ycounter = 300 - zoom
    countX = -1
    while ycounter > 0:
        pygame.draw.line(screen, (100, 100, 100), [(ycounter), 295], [(ycounter), 300], 1)
        text = font.render(str(countX), True, (100, 100, 100))
        screen.blit(text, ((ycounter-5), 305))
        countX = countX - 1
        ycounter = ycounter - zoom

#graph function
def graphFunction(zoom, curCoor):
    for x in range(600):
        for y in range(600):
            gridX = (x - 300)/zoom
            gridY = (-1 * (y - 300)/zoom)
#--------------------CHANGE FOLLOWING LINE TO CHANGE EQUATION-------------------
            #equation = gridX #linear
            #equation = math.pow(gridX, 2) #quadratic
            #equation = math.pow(gridX, 3) #cubic
            equation = math.pow(2, gridX) #exponential
            if (gridY >= equation - 0.05 and gridY <= equation + 0.05) and curCoor != [0, 0]:
                pygame.draw.line(screen, (255, 100, 100), curCoor, [x, y], 1)
                curCoor[0] = x
                curCoor[1] = y
            elif (gridY >= equation - 0.05 and gridY <= equation + 0.05) and curCoor == [0, 0]:
                curCoor = [x, y]

#fills the screen with black
screen.fill((0, 0, 0))
drawGrid(zoom)
graphFunction(zoom, [0, 0])
pygame.display.update()
while running == True:
    running = quitProgram()
    event = pygame.event.wait()
    curCoor = [0, 0]

    #mouse zoom handler - up is zoom in, down is zoom out
    if event.type == pygame.MOUSEBUTTONDOWN:
        if event.button == 4:
            zoom = zoom * 2
            screen.fill((0, 0, 0))
            drawGrid(zoom)
            graphFunction(zoom, curCoor)
        elif event.button == 5:
            zoom = zoom /2
            if zoom <= 1:
                zoom = 1
            screen.fill((0, 0, 0))
            drawGrid(zoom)
            graphFunction(zoom, curCoor)

    #escape key
    if event.type == pygame.QUIT:
            running == False
    if event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
            running = False
    
    pygame.display.update()
pygame.display.quit()
