<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Form</title>
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
<center>
    
<?php
      
        require_once("..\Model\config.php"); 
       
        $bd = new config();
        $pdo = $bd::getConnexion();
        try {
          $query = $pdo->prepare('
        SELECT c.`idcolis`, c.`depart`, c.`arrivee`, c.`size`, c.`poids`, c.`budget`, i.`bin_image`
        FROM `colis` c
        LEFT JOIN `images` i ON c.`idcolis` = i.`idcolis`
        WHERE c.`idcolis` = :idcolis
    ');
      
      $query->execute([
          ':idcolis' => $_POST["update_id"],
      ]);
      
      $result = $query->fetchAll();
      

        }catch(PDOExcepion $e){
            echo "connection failed :". $e->getMessage();
        }
        foreach($result as $row){?>
        <?php
// Assuming $row['size'] contains the string "height*width*depth"
$sizeString = $row['size'];

// Split the string into an array using '*' as the delimiter
$sizeArray = explode('*', $sizeString);

// Assign values to variables
$height = $sizeArray[0];
$width = $sizeArray[1];
$depth = $sizeArray[2];


?>

  <h2>Order Form</h2>
  <form action="..\controller\update.php" method="POST" onsubmit="return validateForm()" class="createReq" enctype="multipart/form-data">
  <input type="text" id="idcolis" style="display:none;" name="idcolis" class="input-wht input" value="<?php echo $row['idcolis']?>">
    <div class="inner_card">
      <div>
        <p class="titles">Fill in pickup point</p>
        <div>
          <p class="sub-title"><i class="fa-solid fa-bullseye"></i> Pickup point</p>
          <input type="text" id="depart" name="depart" class="input-wht input" value="<?php echo $row['depart']?>">
          <span id="departError" class="error-message"></span>
        </div>
      </div>
    </div>
    <div class="inner_card">
    <div>
        <p class="titles">Fill in destination</p>
        <div>
          <p class="sub-title"><i class="fa-solid fa-bullseye"></i> Destination</p>
          <input type="text" id="arrivee" name="arrivee" class="input-wht input" value="<?php echo $row['arrivee']?>">
          <span id="departError" class="error-message"></span>
        </div>
      </div>
    </div>
    <div class="inner_card">
        <div>
          <p class="titles">Add Pictures</p>
          <div class="image-upload">
            <label for="pictures" class="sub-title"><i class="fa-solid fa-image"></i> Upload Pictures</label>
            <input type="file" id="pictures" name="images[]" accept="image/*" >
          </div>
        </div>
      </div>
    <div class="inner_infos_card">
      <p class="titles">Give an estimate for your delivery</p>
      <div class="colis_info">
        <div class="top">
          <div>
            <p class="size-text title">size</p>
            <img src="../view/assets/size.png" alt="size">
            <div class="inputs">
              <input type="text" id="height" name="height" placeholder="height" class="input" value="<?php echo $height?>">
              <input type="text" id="width" name="width" placeholder="width" class="input" value="<?php echo $width?>">
              <input type="text" id="depth" name="depth" placeholder="depth" class="input" value="<?php echo $depth?>">
            </div>
            <span id="sizeError" class="error-message"></span>
          </div>
        </div>
        <hr style="background-color:gray;height:.05vw;width:80%; ">
        <div class="bottom">
          <div>
            <p class="title">Weight</p>
            <img src="../view/assets/poids.png" alt="poid">
            <input type="text" id="Weight" name="poids" placeholder="Weight" class="input" value="<?php echo $row['poids']?>">
            <span id="weightError" class="error-message"></span>
          </div>

          <div>
            <p class="title">Budget</p>
            <img src="../view/assets/budget.png" alt="budget">
            <input type="text" id="budget" name="budget" placeholder="Budget" class="input" value="<?php echo $row['budget']?>">
            <span id="budgetError" class="error-message"></span>
          </div>
        </div>

      </div>
      <input type="submit" value="Confirm" class="button">
    </div>
  </form>
  <?php 
}
?>

  <script src="validation.js"></script>
</center>
</body>
</html>