
import math
import pygame
pygame.init()

#variable defs
screen_dimensions = (600, 600)
screen = pygame.display.set_mode(screen_dimensions)
clock = pygame.time.Clock()
running = True

#calculates and draws the path of a projectile given initial velocity and launch angle
def launch(uInitial, angle):
    print('initial velocity:', uInitial, 'launch angle:', angle)
    uy = math.sin(math.radians(angle)) * uInitial
    ux = math.cos(math.radians(angle)) * uInitial

    tInitial = ((-2)*uy)/(-9.8)
    sx = ux * tInitial

    print('hori displacement:', sx)

    x, y = 0, 0
    t = 0
    while y >= 0:
        pygame.draw.circle(screen, (255, 100, 100), [int(x*(50)), int(y*-50)+600], 1)
        pygame.display.update()
        x = ux*t + (0.5*(0)*t*t)
        y = uy*t + (0.5*(-9.8)*t*t)
        t += 0.01

#escape key handler
def quitProgram():
    running = True
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            running == False
        if event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
            running = False
    return running

#initial launch variables
uInitial = 15
angle = 80

launch(uInitial, angle)

pygame.display.update()
while running == True:
    running = quitProgram()
    event = pygame.event.wait()

    #change velocity on up and down key presses
    if event.type == pygame.KEYDOWN and event.key == pygame.K_UP:
        screen.fill((0, 0, 0))
        uInitial += 2
        launch(uInitial, angle)
    if event.type == pygame.KEYDOWN and event.key == pygame.K_DOWN:
        screen.fill((0, 0, 0))
        uInitial -= 2
        launch(uInitial, angle)

    #change angle on right and left key presses
    if event.type == pygame.KEYDOWN and event.key == pygame.K_RIGHT:
        screen.fill((0, 0, 0))
        angle += 2
        launch(uInitial, angle)
    if event.type == pygame.KEYDOWN and event.key == pygame.K_LEFT:
        screen.fill((0, 0, 0))
        angle -= 2
        launch(uInitial, angle)
    
    #escape key
    if event.type == pygame.QUIT:
            running == False
    if event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
            running = False
    
    pygame.display.update()
pygame.display.quit()


