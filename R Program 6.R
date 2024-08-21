
library(foreign)
library(MASS)


data   <- read.csv("C:/Users/Dhanush/Documents/output.csv")


model <- glm(admitted ~ gre + gpa + rank, data = data, family = "binomial")
summary(model)

# Check model fit
fitted.values <- fitted(model)