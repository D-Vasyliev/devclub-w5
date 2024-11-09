a = int(input())
b = int(input())
с = int(input())
d = int(input())
maximum = None
    
    if a > b:
        max = a
    else:
        max = b
    if c > max: 
        max = c
    if d > max:
        max = d
    
    print(maximum)
