divisible = int(input()) 
divisor = int(input()) 
multiple =  int(input())

if divisor < 0: 
        divisor *= -1
    
multiple = divisible - divisible % divisor
    
if multiple < divisible: 
    multiple += divisor
    
    print(multiple)