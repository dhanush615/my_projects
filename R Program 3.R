# Reading text file
data_txt <- read.table("C:/Users/Dhanush/Documents/data.txt")       

# Reading CSV file
data_csv <- read.csv("C:/Users/Dhanush/Documents/data.csv")         

# Writing to CSV file
write.csv(mtcars, "C:/Users/Dhanush/Documents/output.csv")       

# Reading Excel file
library(readxl)
data_excel <- read_excel("C:/Users/Dhanush/Documents/data.xlsx")   

# Reading XML file
library(XML)
data_xml <- xmlParse("C:/Users/Dhanush/Documents/data.xml")

