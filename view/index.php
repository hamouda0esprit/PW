<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Animated Checkout Form (Recreation of Image)</title>
  <link
      href="https://fonts.googleapis.com/css2?family=Anton&family=Mulish:wght@700&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/29fec4c397.js"
      crossorigin="anonymous"
    ></script><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<body>
  <form action="..\controller\client.php" method="POST" onsubmit="return validateForm();" class="createReq"
      enctype="multipart/form-data" id="form">
    <div>
      <h1>package info</h1>

    </div>
    <ul>
      <li>
        <i class="fas fa-truck"></i>
        <p>Shipping</p>
      </li>
      
    </ul>
    <fieldset id="shipping">
     
      <input type="text" placeholder="Departure eg:Sousse" id="depart" name="depart"/><span id="departError" class="error-message"></span>
     
      <input type="text" placeholder="Arrival eg:Tunis" id="arrivee" name="arrivee"/><span id="arriveeError" class="error-message"></span>
    
   
      <input type="file" id="pictures" name="images[]" accept="image/*" multiple>
   
     <div class="size">
      <input type="text" placeholder="Height" id="height" name="height"/>
      <input type="text" placeholder="Width" id="width" name="width"/>
      <input type="text" placeholder="Depth" id="depth" name="depth"/>
     </div > 
       <div class="both">
        <input type="text" id="Weight" name="poids" placeholder="Weight" >
        <input type="text" placeholder="budget" id="budget" name="budget"/>
       </div>
     

      <button id="next">CONFIRM SHIPPING</button>


    </fieldset>
    <fieldset id="payment">
      <label for="Name on Card">Name On Card</label>
      <input type="text" />
      <label for="Card Number">Card Number</label>
      <input type="text" />
      <label for="CVV">CVV</label>
      <input type="text" />
      <label for="Expiration Date">Expiration Date</label>
      <input type="text" />

      
    </fieldset>
    <?php
       require("..\controller\indexx.php");
       button();
    ?>
  </form>
  <script src="..\controller\scriptt.js"></script>
    <script src="validation.js"></script>
</body>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

</body>
</html>
