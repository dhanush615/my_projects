# Load the data
data <- read.csv("C:/Users/Dhanush/Documents/output.csv")

# Check the unique values in the response variable
unique(data$response)

# Create the logistic regression model
model <- glm(response ~ predictor1 + predictor2, data = data, family = "binomial")

# Predict using the logistic regression model
predictions <- predict(model, newdata = data, type = "response")

