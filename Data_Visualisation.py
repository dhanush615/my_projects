
import matplotlib.pyplot as plt

x= []
y= []

totalaxis= int(input("ENTER Total Axis "))


i=0
while(i<totalaxis):
    i+=1
    in1= int(input("ENTER VALUES FOR X"))
    x.append(in1)

i=0
while(i<totalaxis):
    i+=1
    in2= int(input("ENTER VALUES FOR Y"))
    y.append(in2)

 
plottype=input("ENTER PLOT TYPE in Lower case")

if (plottype=="bar"):
     plt.bar(x,y)

elif (plottype=="histogram"):
    plt.hist(x,y)

elif (plottype=="box"):    
    plt.box(x,y)

elif (plottype=="boxplot"):    
    plt.boxplot(x,y)

elif (plottype=="pie"):    
    plt.pie(x,y)

elif (plottype=="pie"):    
    plt.scatter(x,y)

else:
    print("INVALID CHART")
    


plt.show()