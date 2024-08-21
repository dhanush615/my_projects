# Check the column names
colnames(data)

# Inspect the first few rows of the data
head(data)

# Fit the model with the correct column names
multi_model <- lm(admitted ~ gre + gpa + rank, data = data)
summary(multi_model)
