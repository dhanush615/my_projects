# Creating tuples
tuple1 = (1, 2, 3, 4, 5)
tuple2 = tuple([6, 7, 8, 9, 10])

# Display the tuples
print("Tuple 1:", tuple1)
print("Tuple 2:", tuple2)


# Tuple concatenation
concatenated_tuple = tuple1 + tuple2
print("Concatenated Tuple:", concatenated_tuple)






# 1. Length of the tuple
length_tuple1 = len(tuple1)
print("Length of Tuple 1:", length_tuple1)

# 2. Minimum and maximum elements
min_tuple1 = min(tuple1)
max_tuple1 = max(tuple1)
print("Minimum of Tuple 1:", min_tuple1)
print("Maximum of Tuple 1:", max_tuple1)

# 3. Sum of elements (only if numeric)
sum_tuple1 = sum(tuple1)
print("Sum of Tuple 1:", sum_tuple1)

# 4. Counting occurrences of an element
count_of_2 = tuple1.count(2)
print("Count of 2 in Tuple 1:", count_of_2)

# 5. Finding index of an element
index_of_3 = tuple1.index(3)
print("Index of 3 in Tuple 1:", index_of_3)

# 6. Tuple packing and unpacking
packed_tuple = (1, 2, 3, 4)
a, b, c, d = packed_tuple
print("Unpacked values:", a, b, c, d)

# 7. Slicing a tuple
sliced_tuple = tuple1[1:4]
print("Sliced Tuple 1 (1 to 3):", sliced_tuple)
