<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 20px;
    }

    h2 {
      color: #333;
    }

    form {
      max-width: 400px;
      margin: 20px auto;
      padding: 15px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-top: 10px;
      color: #555;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: white;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h2>Order Form</h2>
  <form action="..\controller\client.php" method="POST">
    <label for="size">Size:</label>
    <input type="text" id="size" name="size">

    <label for="weight">Weight:</label>
    <input type="text" id="weight" name="poids">

    <label for="depart">depart:</label>
    <input type="text" id="depart" name="depart">

    <label >arrivee:</label>
    <input type="text" id="arrivee" name="arrivee">

    <label for="budget">budget:</label>
    <input type="text" id="budget" name="budget">


    <input type="submit" value="Submit">
  </form>
</body>
</html>
