class circle:
    def __init__(self,radius):
        self.radius=radius
        self.pi=3.14

    def get_area(self):
        return self.pi* self.radius*self.radius
        

    def get_circumference(self):
        return 2*self.pi*self.radius    

radius=int(input('Enter the radius of the circle.'))    
C1=circle(radius)
print(C1.get_area())
print(C1.get_circumference())      