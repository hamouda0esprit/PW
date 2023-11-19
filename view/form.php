<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
     
    body {
      font-family: 'Poppins', sans-serif;
      background-color: white;
      margin: 20px;
      
    }
    /* *{
      border: 1px solid white;
    } */

    /* h2 {
      color: white;
    }

    form {
      max-width: 400px;
      margin: 20px auto;
      padding: 15px;
      background-color: rgba(255, 215, 0, 1);
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-top: 10px;
      color: white;
      font-weight: bold;
    }

    input {
      width: calc(100% - 16px);
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
      border: 1px solid transparent;
      border-radius: 4px;
      background-color: rgba(255, 255, 255, 0.8);
      color: #333;
    }

    input[type="button"] {
      background-color: rgba(255, 215, 0, 1);
      color: white;
      cursor: pointer;
    }

    input[type="button"]:hover {
      background-color: rgb(255, 255, 255);
      color: rgba(255, 215, 0, 1);
    }

    .error-message {
      color: rgb(255, 0, 0);
      font-size: 12px;
    } */

    /* Additional styles for the size inputs */
    /* #height, #width, #depth {
      width: calc(33.33% - 10px);
      margin-right: 10px;
    } */

    /* Clearfix to prevent the form from collapsing */
    /* .clearfix::after {
      content: "";
      clear: both;
      display: table;
    } */

    .createReq{
      display: flex;
      align-items: center;
      justify-content: space-between;
      width:80%;
    }
    .inner_card,.inner_infos_card{
      width:32%;
      border:1px solid white;
      box-shadow: rgba(0, 0, 0, 0.08) 0px 2px 26px 0px;
      -webkit-box-shadow: rgba(0, 0, 0, 0.08) 0px 2px 26px 0px;
      -moz-box-shadow: rgba(0, 0, 0, 0.08) 0px 2px 26px 0px;
      border-radius:10px;
    }
    .inner_card{
      height:60%;
      display: flex;
      flex-direction:column;
      align-items: center;
      justify-content: center;
    }

    .inner_infos_card{
      height:100%;
    }

    .inner_infos_card{
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction:column;
    }

    .colis_info{
      width:100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction:column;
    }
    .colis_info .bottom{
      width:100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction:row;
    }

    .colis_info .title{
      margin:4px;   
      font-size:.8vw;
      font-weight:600;
    }
    .colis_info .size-text{
      font-size:1vw;
    }
    .colis_info>div>div{
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction:column;
    }
    .colis_info>div>div>div{
      width:100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction:row;
    }
    .bottom{
      margin-top:1vw;
    }
    .titles{
      font-weight:600;
      font-size:1vw;

    }
    .sub-title{
      margin-left:.8vw;
      margin-top:.5vw;
      margin-bottom:.6vw;
      font-weight:400;
    }
    .fa-bullseye{
      margin-right:.5vw;
      color:rgb(255,215,0);
      font-size:1vw;
    }
    .input{
      width:60%;
      border: 1px solid black;
      outline: none;
      height:40px;
      border:none;
      padding:5px;
      margin:5px;
      text-align: center;
    }
    .input-wht{
      width: 90%;
      border-radius:10px;
      border-bottom: 2px solid rgba(200,200,200,.6);
      text-align:left;
      transition: .2s ease-in;
    }
    .input-wht:focus{
      border-bottom: 2px solid rgba(180,180,180,1);
    }
    .colis_info>div>div>img{
      width:60px;
      height:60px;
      border-radius:10px;
      margin:10px;
    }
    .button{
      margin: 30px 0;
    }

    .button {
      width: 7vw;
      height: 2vw;
      color: #fff;
      border-radius: .3vw;
      padding: .1vw;
      font-weight: 500;
      background: rgb(255, 215, 0);
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      display: inline-block;
      box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),7px 7px 20px 0px rgba(0,0,0,.1),4px 4px 5px 0px rgba(0,0,0,.1);
      outline: none;
      border:none;          
    }
    .button:hover{
      background: rgb(255, 225, 10);
      box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),7px 7px 25px 0px rgba(0,0,0,.1),4px 4px 6px 0px rgba(0,0,0,.3);
      transition: all 0.3s ease;
  
    }
    .inner_card>div>div{
      display:flex;
      justify-content: center;
      align-items: center;
      flex-direction:column;
    }
    .inner_card>div{
      width:calc(100% - 2vw);
      
    }
    .inner_card>div>div{
      padding:10px;
      margin:1vw;
      background:rgb(245, 245, 245);
      
      border-radius:10px;

      display:flex;
      align-items:flex-start;
    }
  </style>
</head>
<body>
  <h2>Order Form</h2>
  <!-- <form id="orderForm" action="..\controller\client.php" method="POST" onsubmit="return validateForm()">

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

    <input type="submit" value="Submit" class="bidBtn">
  </form> -->
<center>
  <form action="..\controller\client.php" method="POST" onsubmit="return validateForm()" class="createReq">
    <div class="inner_card">
      <div>
        <p class="titles">Fill in pickup point</p>
        <div>
          <p class="sub-title"><i class="fa-solid fa-bullseye"></i> Pickup point</p>
          <input type="text" id="depart" name="depart" class="input-wht input">
          <span id="departError" class="error-message"></span>
        </div>
      </div>
    </div>
    <div class="inner_card">
    <div>
        <p class="titles">Fill in destination</p>
        <div>
          <p class="sub-title"><i class="fa-solid fa-bullseye"></i> Destination</p>
          <input type="text" id="arrivee" name="arrivee" class="input-wht input">
          <span id="departError" class="error-message"></span>
        </div>
      </div>
    </div>
    <div class="inner_infos_card">
      <p class="titles">Give an estimate for your delivery</p>
      <div class="colis_info">
        <div class="top">
          <div>
            <p class="size-text title">size</p>
            <img src="./assets/size.png" alt="size">
            <div class="inputs">
              <input type="text" id="height" name="height" placeholder="height" class="input">
              <input type="text" id="width" name="width" placeholder="width" class="input">
              <input type="text" id="depth" name="depth" placeholder="depth" class="input">
            </div>
            <span id="sizeError" class="error-message"></span>
          </div>
        </div>
        <hr style="background-color:gray;height:.05vw;width:80%; ">
        <div class="bottom">
          <div>
            <p class="title">Weight</p>
            <img src="./assets/poids.png" alt="poid">
            <input type="text" id="Weight" name="poids" placeholder="Weight" class="input">
            <span id="weightError" class="error-message"></span>
          </div>

          <div>
            <p class="title">Budget</p>
            <img src="./assets/budget.png" alt="budget">
            <input type="text" id="budget" name="budget" placeholder="Budget" class="input">
            <span id="budgetError" class="error-message"></span>
          </div>
        </div>

      </div>
      <input type="submit" value="Confirm" class="button">
    </div>
  </form>
  <script src="validation.js"></script>
</body>
</html>
</center>

