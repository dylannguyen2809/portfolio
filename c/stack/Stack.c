//
//  Stack.c
//
//  Created by Dylan Nguyen on 12/6/19.
//  Copyright © 2019 Dylan Nguyen. All rights reserved.
//

#include "Stack.h"

//define stack struct
typedef struct stack {
    char values[MAX_STACK_SIZE];
} stack;

//make a new stack
Stack newStack (void) {
    Stack new = malloc(sizeof (stack));
    assert (new != NULL);
    return (new);
}

//push an item onto the top of stack
void push (Stack stack, char elt){
    int i = 0;
    while (stack->values[i] != '\0'){
        i++;
    }
    stack->values[i] = elt;
}

//return top item from the stack
char pop (Stack stack){
    int i = 0;
    while (stack->values[i] != '\0'){
        i++;
    }
    char toPop = stack->values[i-1];
    stack->values[i-1] = '\0';
    return toPop;
}

//check if the stack is empty
int isEmpty (Stack stack){
    int emp;
    if (stack->values[0] != '\0'){
        emp = FALSE;
    } else {
        emp = TRUE;
    }
    return emp;
}

//free stack memory
void freeStack (Stack stack){
    free(stack);
}
