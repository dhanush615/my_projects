# Creating a dictionary
dict = {
    'Abishek': 1,
    'Bala': 2,
    'Charles': 3,
    'Dhanush': 4,
    'Dharshan': 5
}

#Assigning
dict['Dhanush']=13


x=int(input("ENTER NO OF DATA NEED TO BE STORED IN DICTIONARY"))


for i in range(0,x):
    #Get Input
    
    name=input("ENTER NAME").isalpha()
    rollno=int(input("ENTER ROLL NO")).is_integer()
  
    if rollno in dict.values():
        print("ROLLNO ALREADY EXIST")
    else:
        dict[name]=rollno


print(dict)