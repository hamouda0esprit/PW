<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Order confirm animation</title>
  <script  src="..\controller\script.js"></script>
</head>


<body>
<!-- partial:index.partial.html -->
<?php 
   function button (){
?><button onclick=" delay(); " class="order" type="submit"><span class="default" >Complete Order</span><span class="success">Order Placed
    <svg viewbox="0 0 12 10">
      <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
    </svg></span>
  <div class="box"></div>
  <div class="truck">
    <div class="back"></div>
    <div class="front">
      <div class="window"></div>
    </div>
    <div class="light top"></div>
    <div class="light bottom"></div>
  </div>
  <div class="lines"></div>
</button><!-- dribbble -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

  <?php } ?>
</body>
</html>
