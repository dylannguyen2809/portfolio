//
//  Stack.h
//
//  Created by Dylan Nguyen on 12/6/19.
//  Copyright © 2019 Dylan Nguyen. All rights reserved.
//

#ifndef Stack_h
#define Stack_h

#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

#define MAX_STACK_SIZE 100
#define TRUE 1
#define FALSE 0

typedef struct stack *Stack;

Stack newStack (void);
void push (Stack stack, char elt);
char pop (Stack stack);
int isEmpty (Stack stack);
void freeStack (Stack stack);

#endif /* Stack_h */
