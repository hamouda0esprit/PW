<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add a package</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" 
    />
    <link rel="stylesheet" href="..\..\controller\user\button\style.css">
    <link rel="stylesheet" href="..\..\controller\user\insertBid\insertPackage.css">
</head>
<body>
    <h2>add a package</h2>
    <center>
        <form action="..\..\controller\user\insertBid\addPackage.php" method="POST" onsubmit="return conrtol()" class="formColis" id="formColis" enctype="multipart/form-data">

            <div class="inner_card">
                <div>
                    <p class="titles">Fill in pickup point</p>
                    <div class="borderInner">
                        <p class="sub-title"><i class="fa-solid fa-bullseye"></i> Pickup point</p>
                        <input type="text" id="depart" name="depart" class="input-wht input">
                        <span id="departError" class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="inner_card">
                <div>
                    <p class="titles">Fill in destination</p>
                    <div class="borderInner">
                        <p class="sub-title"><i class="fa-solid fa-bullseye"></i> Destination</p>
                        <input type="text" id="arrivee" name="arrivee" class="input-wht input">
                        <span id="arriveeError" class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="inner_card">
                <div>
                    <p class="titles">Add Pictures</p>
                    <div class="image-upload borderInner">
                        <p class="sub-title"><i class="fa-solid fa-image"></i> Upload Pictures</p>
                        <input type="file" id="pictures" name="images[]" accept="image/*" multiple>
                    </div>
                </div>
            </div>


            <div class="inner_infos_card">
            <p class="titles">Give an estimate for your delivery</p>
            <div class="colis_info">
            <div class="top">
                <div class="topForm">
                <p class="size-text title">size</p>
                <img src="assets/size.png" alt="size">
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
                <img src="assets/poids.png" alt="poid">
                <input type="text" id="Weight" name="poids" placeholder="Weight" class="input">

                </div>

                <div>
                <p class="title">Budget</p>
                <img src="assets/budget.png" alt="budget">
                <input type="text" id="budget" name="budget" placeholder="Budget" class="input">
                <span id="budgetError" class="error-message"></span>
                </div>
            </div>
            </div>
            <div class="btn">
                <button type="submit" class="btnAdd">Add Package</button>
            </div>
        </div>
        </form>
    </center>
    <script src="..\..\controller\user\button\script.js"></script>
    <script src="..\..\controller\user\insertBid\insertPackage.js"></script>
</body>
</html>