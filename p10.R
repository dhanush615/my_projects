 
# Example: k-means clustering
set.seed(123)
clusters <- kmeans(iris[,1:4], centers = 3)
 
plot(iris$Sepal.Length, iris$Sepal.Width, col = clusters$cluster)