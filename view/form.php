<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Form</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
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
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-top: 10px;
      color: #555;
      font-weight: bold;
    }

    input {
      width: calc(100% - 16px);
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="button"] {
      background-color: #4caf50;
      color: white;
      cursor: pointer;
    }

    input[type="button"]:hover {
      background-color: #45a049;
    }

    .error-message {
      color: #dc3545;
      font-size: 12px;
    }

    /* Additional styles for the size inputs */
    #height, #width, #depth {
      width: calc(33.33% - 10px);
      margin-right: 10px;
    }

    /* Clearfix to prevent the form from collapsing */
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }
  </style>
</head>
<body>
  <h2>Order Form</h2>
  <form id="orderForm" action="..\controller\client.php" method="POST" onsubmit="return validateForm()">

    <label >Height:</label>
    <input type="text" id="height" name="height">
    <span id="heightError" class="error-message"></span>

    <label >Width:</label>
    <input type="text" id="width" name="width">
    <span id="widthError" class="error-message"></span>

    <label>Depth:</label>
    <input type="text" id="depth" name="depth">
    <span id="depthError" class="error-message"></span>

    <label >Weight:</label>
    <input type="text" id="weight" name="poids">
    <span id="weightError" class="error-message"></span>

    <label >Depart:</label>
    <input type="text" id="depart" name="depart">
    <span id="departError" class="error-message"></span>

    <label>Arrival:</label>
    <input type="text" id="arrivee" name="arrivee">
    <span id="arriveeError" class="error-message"></span>

    <label >Budget:</label>
    <input type="text" id="budget" name="budget">
    <span id="budgetError" class="error-message"></span>

    <div class="clearfix"></div>

    <input type="submit" value="Submit" >
  </form>

  <script src="validation.js"></script>
</body>
</html>

