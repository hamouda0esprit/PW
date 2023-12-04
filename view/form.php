<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;display=swap'>
  <link rel="stylesheet" href="..\controller\style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--white);
    }

    /* Add new color variables */
    :root {
      --gold: rgb(255, 215, 0);
      --light-green: rgb(240, 255, 240); 
      --dark-blue: rgb(0, 0, 139);
      --grey: rgb(169, 169, 169);
      --white: #fff;
    }

    .createReq {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 80%;
      background-color: var(--white);
    }

    .inner_card,
    .inner_infos_card {
      width: 32%;
      border: 1px solid var(--white);
      box-shadow: rgba(0, 0, 0, 0.08) 0px 2px 26px 0px;
      -webkit-box-shadow: rgba(0, 0, 0, 0.08) 0px 2px 26px 0px;
      -moz-box-shadow: rgba(0, 0, 0, 0.08) 0px 2px 26px 0px;
      border-radius: 10px;
      background-color: var(--light-green);
    }

    .inner_card {
      height: 60%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .inner_infos_card {
      height: 100%;
    }

    .inner_infos_card {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .colis_info {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .colis_info .bottom {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: row;
    }

    .colis_info .title {
      margin: 4px;
      font-size: 0.8vw;
      font-weight: 600;
      color: var(--dark-blue);
    }

    .colis_info .size-text {
      font-size: 1vw;
    }

    .colis_info>div>div {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .colis_info>div>div>div {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: row;
    }

    .bottom {
      margin-top: 1vw;
    }

    .titles {
      font-weight: 600;
      font-size: 1vw;
      color: var(--dark-blue);
    }

    .sub-title {
      margin-left: 0.8vw;
      margin-top: 0.5vw;
      margin-bottom: 0.6vw;
      font-weight: 400;
      color: var(--dark-blue);
    }

    .fa-bullseye {
      margin-right: 0.5vw;
      color: var(--gold);
      font-size: 1vw;
    }

    .input {
      width: 60%;
      border: 1px solid var(--dark-blue);
      outline: none;
      height: 40px;
      border: none;
      padding: 5px;
      margin: 5px;
      text-align: center;
    }

    .input-wht {
      width: 90%;
      border-radius: 10px;
      border-bottom: 2px solid rgba(200, 200, 200, .6);
      text-align: left;
      transition: .2s ease-in;
    }

    .input-wht:focus {
      border-bottom: 2px solid rgba(180, 180, 180, 1);
    }

    .colis_info>div>div>img {
      width: 60px;
      height: 60px;
      border-radius: 10px;
      margin: 10px;
    }

    .button {
      margin: 30px 0;
    }

    .button {
      width: 7vw;
      height: 2vw;
      color: #fff;
      border-radius: 0.3vw;
      padding: 0.1vw;
      font-weight: 500;
      background: var(--gold);
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      display: inline-block;
      box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 20px 0px rgba(0, 0, 0, .1),
        4px 4px 5px 0px rgba(0, 0, 0, .1);
      outline: none;
      border: none;
    }

    .button:hover {
      background: var(--light-green);
      box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 25px 0px rgba(0, 0, 0, .1),
        4px 4px 6px 0px rgba(0, 0, 0, .3);
      transition: all 0.3s ease;
    }

    .inner_card>div>div {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .inner_card>div {
      width: calc(100% - 2vw);
    }

    .inner_card>div>div {
      padding: 10px;
      margin: 1vw;
      background: var(--light-green);
      border-radius: 10px;
      display: flex;
      align-items: flex-start;
    }

    /* New styling for the image upload section */
    .image-upload {
      margin-top: 1vw;
      width: calc(100% - 2vw);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .image-upload label {
      font-size: 1vw;
      margin-bottom: 0.5vw;
      color: var(--dark-blue);
    }

    .image-upload input {
      width: 60%;
      padding: 0.5vw;
      margin-bottom: 1vw;
      border: 1px solid var(--dark-blue);
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <h2>Order Form</h2>
  <center>
    <form action="..\controller\client.php" method="POST" onsubmit="return validateForm();" class="createReq"
      enctype="multipart/form-data" id="form">
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
            <span id="arriveeError" class="error-message"></span>
          </div>
        </div>
      </div>
      <div class="inner_card">
        <div>
          <p class="titles">Add Pictures</p>
          <div class="image-upload">
            <label for="pictures" class="sub-title"><i class="fa-solid fa-image"></i> Upload Pictures</label>
            <input type="file" id="pictures" name="images[]" accept="image/*" multiple>
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
              <span id="weightError" class="error-message"></span>
            </div>
          </div>
          <hr style="background-color: var(--grey); height: .05vw; width: 80%; ">
          <div class="bottom">
            <div>
              <p class="title">Weight</p>
              <img src="./assets/poids.png" alt="poid">
              <input type="text" id="Weight" name="poids" placeholder="Weight" class="input">

            </div>

            <div>
              <p class="title">Budget</p>
              <img src="./assets/budget.png" alt="budget">
              <input type="text" id="budget" name="budget" placeholder="Budget" class="input">
              <span id="budgetError" class="error-message"></span>
            </div>
          </div>
        </div>
        <?php
       require("..\controller\indexx.php");
       button();
    ?>

      </div>
    </form>

    <script src="..\controller\script.js"></script>
    <script src="validation.js"></script>
  </center>
</body>

</html>
