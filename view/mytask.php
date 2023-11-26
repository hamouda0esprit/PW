<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Deliveries</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    h2 {
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: rgb(255, 215, 0);
      color: white;
    }

    .button-container {
      margin-top: 10px;
    }

    .modify-button, .suppress-button {
      padding: 5px 10px;
      margin-right: 5px;
      cursor: pointer;
    }

    .modify-button {
      background-color: #4285f4; /* Modify button color */
      box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),7px 7px 20px 0px rgba(0,0,0,.1),4px 4px 5px 0px rgba(0,0,0,.1);
      transition: all 0.3s ease;
      color: white;
    }
    .modify-button:hover{
      box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),7px 7px 25px 0px rgba(0,0,0,.1),4px 4px 6px 0px rgba(0,0,0,.3);
    }

    .suppress-button {
      background-color: #dc3545; /* Suppress button color */
      box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),7px 7px 20px 0px rgba(0,0,0,.1),4px 4px 5px 0px rgba(0,0,0,.1);
      transition: all 0.3s ease;
      color: white;
    }
    .suppress-button:hover {
      box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),7px 7px 25px 0px rgba(0,0,0,.1),4px 4px 6px 0px rgba(0,0,0,.3);
    }
  </style>
</head>
<body>
  <h2>My Deliveries</h2>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Size</th>
        <th>Weight</th>
        <th>Departure Location</th>
        <th>Arrival Location</th>
        <th>Budget</th>
        <th>Images</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
   <?php 
   require("..\controller\select.php");
   select();?>
    </tbody>
  </table>

  <script>
    function modifyDelivery(button) {
      // Add logic for modifying the delivery based on the row or button clicked
      alert("Modify button clicked");
    }

    function suppressDelivery(button) {
      // Add logic for suppressing the delivery based on the row or button clicked
      alert("Suppress button clicked");
    }
  </script>
</body>
</html>
