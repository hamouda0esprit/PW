
<!--Website: wwww.codingdung.com-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="styleM.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php 
            session_start();
            $_SESSION['ID'] = $_POST['ID'];
            ?>
    <?php 
    require("../model/Connection.php"); 
    $bd = new Connection();
    $pdo = $bd::getConnexion();
    if(isset($_POST['ID'])){
        $ID = $_POST['ID'];
        try{
            
            $query = $pdo->prepare("SELECT * FROM data WHERE ID = :ID");
            $query->bindParam(':ID', $ID);
            $query->execute();
            $result = $query->fetchAll();
            $Data = $result[0];
            if (count($result) > 0) {
                $nom = $Data['nom'];
                $prenom = $Data['prenom'];
                $email = $Data['email'];
                $numero = $Data['numero'];
                $mdp = $Data['password'];
                $image = $Data['image_url'];
            }else{
                echo"ID do not exsist";
            }
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }else{
        header("Location: Account.php");
        exit();
    }
    ?>
    <form action="../model/ModifyAccount.php" method="POST">
        <div class="container light-style flex-grow-1 container-p-y">
            <div class="form-group">
         </div>
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list"
                                href="#account-general">General</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-change-password">Change password</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-info">Info</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-social-links">Delete account</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                <div class="card-body media align-items-center">
                                <img src="./uploads/<?php echo $image; ?>" alt="Image not found test" class="d-block ui-w-80">

                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Nom</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo"$nom"; ?>" name="nom">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Prenom</label>
                                        <input type="text" class="form-control" value="<?php echo"$prenom"; ?>" name="prenom">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo"$email"; ?>" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                <div class="form-group">
                                        <label class="form-label">Current password : <?php echo"$mdp"; ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-info">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Bio</label>
                                        <textarea class="form-control"
                                            rows="5"><?php if($ID[0]=='C'){ echo"Client do not have this option"; }?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Birthday</label>
                                        <input type="text" class="form-control" value="May 3, 1995">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <select class="custom-select">
                                            <option>USA</option>
                                            <option selected>Tunisia</option>
                                            <option>UK</option>
                                            <option>Germany</option>
                                            <option>France</option>
                                        </select>
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">Contacts</h6>
                                    <div class="form-group">
                                        <label class="form-label">Numero</label>
                                        <input type="text" class="form-control" value="<?php echo"$numero"; ?>" name="numero">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Website</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-social-links">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Reason</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Delete ?</label>
                                        <input type="text" class="form-control" placeholder="'Yes' Or 'No'" name="Delete">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </form>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>