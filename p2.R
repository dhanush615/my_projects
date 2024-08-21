 
summary(mtcars) # Summary of mtcars dataset
str(mtcars) # Structure of mtcars dataset
quantile(mtcars$mpg) # Quartiles of mpg in mtcars
 
subset(iris, Sepal.Length > 5) # Subset where Sepal.Length > 5
aggregate(Sepal.Length ~ Species, data = iris, mean) # Mean Sepal.Length by Species