

<?php 
/*
list_user bd//search person specific
*/

  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <?php 
            $ID = $_SESSION['id'];
            $query = "SELECT banned FROM users WHERE user_id = '$ID'";
            $result = mysqli_query($conn, $query);

            if ($result) {
              $KK = mysqli_fetch_assoc($result);
              if ($KK['banned'] == 0) {
                echo '
                    <div class="content">
                      <div class="wrapper">
                        <section class="users">
                          <header>
                            <div class="content">
                              <img src="php/images/' . $row['img'] . '" alt="">
                              <div class="details">
                                <span>' . $row['fname'] . ' ' . $row['lname'] . '</span>
                                <p>' . $row['status'] . '</p>
                              </div>
                            </div>
                            <a href="php/logout.php?logout_id=' . $row['unique_id'] . '" class="logout">Logout</a>
                          </header>
                    
                          <div class="search">
                            <span class="text">Select an user to start chat</span>
                            <input type="text" placeholder="Enter name to search...">
                            
                            <input type="text" >
                            <button><i class="fas fa-search"></i></button>
                          </div>
                          <div class="users-list">
                      
                          </div>
                        </section>
                      </div>';
            } else {//Afficher you are banned
                echo 'You are banned';
            }
            }
          ?>
          
  <script src="javascript/users.js"></script>

</body>
</html>
