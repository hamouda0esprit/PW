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
      margin: 20px;
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
      background-color: #4caf50;
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
      color: white;
    }

    .suppress-button {
      background-color: #dc3545; /* Suppress button color */
      color: white;
    }
    .hidden{
      display: none;
    }
  </style>
</head>
<body>
  <h2>My Deliveries</h2>
  <table>
    <thead>
      <tr>
        <th>Size</th>
        <th>Weight</th>
        <th>Departure Location</th>
        <th>Arrival Location</th>
        <th>Budget</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
   <?php 

   require("..\controller\admin.php");
   admin();?>

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
