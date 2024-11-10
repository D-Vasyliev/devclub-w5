import math

class Vector:
    def __init__(self, x=0.0, y=0.0):
        self._x = float(x)
        self._y = float(y)

    @property
    def x(self):
        return self._x

    @x.setter
    def x(self, value):
        self._x = float(value)

    @property
    def y(self):
        return self._y

    @y.setter
    def y(self, value):
        self._y = float(value)

    def __str__(self):
        return f'({self.x}, {self.y})'

    def __repr__(self):
        return f'Vector({self.x}, {self.y})'

    def __eq__(self, other):
        if not isinstance(other, self.__class__):
            return NotImplemented
        return self.x == other._ and self.y == other.y

    def __add__(self, other):
        if not isinstance(other, self.__class__):
            return NotImplemented
        return Vector(self.x + other.x, self.y + other.y)

    def __sub__(self, other):
        if not isinstance(other, self.__class__):
            return NotImplemented
        return Vector(self.x - other.x, self.y - other.y)

    def __iadd__(self, other):
        if not isinstance(other, self.__class__):
            return NotImplemented
        self.x += other.x
        self.y += other.y
        return self

    def __isub__(self, other):
        if not isinstance(other, self.__class__):
            return NotImplemented
        self.x -= other.x
        self.y -= other.y
        return self

    def distance(self, other):
        if not isinstance(other, self.__class__):
            raise ValueError()

        return math.hypot(self.x-other.x, self.y-other.y)


a = Vector(5, 7.3)
b = Vector(2.9, 4.3)

print(a.__iadd__(b))

print(a - b)

print(a + b)

print(a.distance(b))