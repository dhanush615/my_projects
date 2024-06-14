<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>On Duty Leave Application Generator</title>
</head>
<body>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
    transition: transform 0.3s ease;
  }

  form:hover {
    transform: translateY(-5px);
  }

  input[type="text"],
  input[type="date"],
  button {
    width: 100%;
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s ease;
  }

  input[type="text"]:focus,
  input[type="date"]:focus {
    outline: none;
    border-color: #3498db;
  }

  button {
    background-color: #3498db;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  button:hover {
    background-color: #2980b9;
    transform: scale(1.05);
  }

  @media screen and (max-width: 400px) {
    form {
      width: 90%;
    }
  }
</style>
    <form action="b.php" method="post">
	<h1>ONDUTY FORM</h1>
        <input type="text" name="studentName" placeholder="Student Name">
		<br>
		
  <input type="text" name="eventName" placeholder="Event Name"><br>
  <input type="date" name="eventDate" placeholder="Event Date">
  <br>
  
  
  
  

       
        <input type="text" name="rollNo" id="rollNo" placeholder="Rollno" required><br>

        <input type="text" name="department" id="department" placeholder="Department" required><br>

        <input type="text" name="degree" id="degree" placeholder="DEGREE"  required><br>

        <input type="text" name="year" placeholder="Year" id="year" required><br>

        <input type="text" name="class" id="class" placeholder="Class" required><br>

        <input type="text" name="section" id="section"  placeholder="Section" required><br>

        <button type="submit">Generate Application</button>
    </form>
</body>
</html>