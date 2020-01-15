//
//  testStack.c
//
//  Created by Dylan Nguyen on 17/6/19.
//  Copyright © 2019 Dylan Nguyen. All rights reserved.
//

#include <stdio.h>
#include <stdlib.h>
#include <assert.h>
#include "Stack.h"

void testStack (void);

int main(int argc, const char *argv[]){
    testStack();
    printf("All tests passed! woohoo!\n");
    return EXIT_SUCCESS;
}

void testStack (void){
    //create a stack, check that it is empty
    printf("testing empty stack...");
    Stack test1 = newStack();
    assert(isEmpty(test1) == TRUE);
    printf(" passed! \n");
    
    //make 1 element, check not empty, pop
    printf("testing 1 element stack... ");
    push(test1, 'a');
    assert(isEmpty(test1) == FALSE);
    assert(pop(test1) == 'a');
    printf("passed!\n");
    
    //check that push and pop work in correct order
    printf("testing 4 element stack... ");
    push(test1, 'a');
    push(test1, 'h');
    push(test1, 'o');
    push(test1, 'y');
    
    assert(pop(test1) == 'y');
    assert(pop(test1) == 'o');
    assert(pop(test1) == 'h');
    assert(pop(test1) == 'a');
    
    assert(isEmpty(test1) == TRUE);
    printf("passed! \n");
    
    //free stack
    printf("freeing stack... ");
    freeStack(test1);
    printf("passed! \n");
}
