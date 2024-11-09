a = int(input())
b = int(input())
с = int(input())
d = int(input())
maximum = None
    
    if a > b:
        maximum = a
    else:
        maximum = b
    if c > maximum: 
        maximum = c
    if d > maximum:
        maximum = d
    
    print(maximum)
