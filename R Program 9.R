install.packages("e1071")
library(e1071)
 
# Example: SVM classifier
classifier <- svm(Species ~ ., data = iris)
summary(classifier)
 
predictions <- predict(classifier, iris)
table(predictions, iris$Species) # Confusion matrix