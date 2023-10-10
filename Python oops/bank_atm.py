class ATM:
    #Constructor a constructor is a special method that is automatically called when an object of a class is created The constructor method is named __init__

    def __init__(self):

        self.pin="69"
        self.balance=69

    def menu(self):
        user_input=input("""
                         Hello, How would you like to proceed?
                         1. Enter 1 to create pin
                         2. Enter 2 to deposit
                         3. Enter 3 to withdraw
                         4. Enter 4 to check balance
                         5. En
                         
                         ter 5 to exit
                         """)
        if user_input==1:
            print('Create Pin')
        elif user_input==2:
            print('Deposit')
        elif user_input==3:
            print('Withdraw')
        elif user_input==4:
            print('Balance')
        else:
            print('Byeee!')

    def create_pin(self):
        self.pin=input('Enter your pin')
        print('Pin set successfull')                        

    def deposit(self):
        temp=input('Enter your pin')
        if temp==self.pin:
            amount=int(input('Enter the amount'))
            self.balance=self.balance+amount
            print('Deposit successful')
        else:
            print('invalid pin')

    def withdraw(self):
        temp=input('Enter your pin')
        if temp==self.pin:
            amount=int(input('Enter the amount'))
            if amount<self.balance:
                self.balance=self.balance-amount
                print('Cash withdrawn')
            else:
                print('Not enough cash')    
        else:
            print('invalid pin')

    def check_balance(self):
        temp=input('Enter your pin')
        if temp==self.pin:
            print(self.balance)
        else:
            print('invalid pin')  
