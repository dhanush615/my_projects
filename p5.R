cor_matrix <- cor(iris[,1:4]) # Correlation matrix for numeric columns in iris
print(cor_matrix)


library(corrplot)
corrplot(cor_matrix, method = "circle") # Correlation plot for iris dataset

anova_result <- aov(Sepal.Length ~ Species, data = iris) # ANOVA on iris dataset
summary(anova_result)