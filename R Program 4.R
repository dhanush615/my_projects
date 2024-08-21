# Data Distributions using Box and Scatter Plot
boxplot(mtcars$mpg) # Box plot for mpg
plot(mtcars$wt, mtcars$mpg) # Scatter plot for Weight vs MPG

# Outliers, Histograms, Bar Chart, and Pie Chart
boxplot(mtcars$mpg) # Outliers in mpg
hist(mtcars$mpg) # Histogram for mpg
barplot(table(mtcars$cyl)) # Bar chart for cylinders
pie(table(mtcars$cyl)) # Pie chart for cylinders

