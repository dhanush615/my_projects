lst = [1, 1,2, 3, 4, 5, 6, 7, 8, 9, 10]


print(lst.count(1))# why i give first is sd because while using reverse sort all most string it considered list elements are string we cant count while coiunt process shows it is integer


lst.append(11)  # Add 11
print(lst)

lst.remove(11)  # Remove 11
print(lst)

lst.sort()      # Ascending
print(lst)

lst.reverse()   # Descending from only sorted
print(lst)




a=int(input("ENTER NUMBER:"))

if a not in lst:
    print("UNIQUE")
    lst.append(a)
else:
    print("EXIST!")