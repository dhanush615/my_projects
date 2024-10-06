import numpy as np
from sklearn.linear_model import LinearRegression
import matplotlib.pyplot as plt

x = np.array([[1], [2], [3], [4], [5]])
y = np.array([2, 3, 5, 7, 11])
model = LinearRegression().fit(x, y)

plt.scatter(x, y)
plt.plot(x, model.predict(x), color='red')
plt.show()