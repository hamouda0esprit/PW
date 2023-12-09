<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>DeliveryLink - Log In / Sign Up</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'><link rel="stylesheet" href="./MainStyle.css">
<link rel="stylesheet" href="radio.css">

</head>
<body>
<!-- partial:index.partial.html -->
<a href="#" class="logo" target="_blank">
		<img src="../controller/Assets/logo.png" alt="">
	</a>
	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span class="login-text">Log In   </span><span>   Sign Up</span></h6>
			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Log In</h4>
											<form action="../model/Login.php" method="POST" onsubmit="return validateemail()">
												<div class="form-group">
													<input type="text" name="email" class="form-style" placeholder="Your Email" id="email" autocomplete="off">
													<i class="input-icon uil uil-at"></i>
												</div>	
												<div class="form-group mt-2">
													<input type="password" name="password" class="form-style" placeholder="Your Password" id="password" autocomplete="off">
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<button class="btn mt-4" type="submit">submit</button>
												<p class="mb-0 mt-4 text-center"><a href="index3.php" class="link">Forgot your password?</a></p>
											</form>
				      					</div>
			      					</div>
			      				</div>
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="test">Sign Up</h4>
											<?php 
												require_once '../vendor/autoload.php';
												session_start();
												// facebook
												$fb = new Facebook\Facebook([
													'app_id' => '327102486769135',
													'app_secret' => '380402fccaa88b39dbf6b63d6fc0c446',
													'default_graph_version' => 'v12.0', 
												]);
												// Facebook Login URL
												$helper = $fb->getRedirectLoginHelper();
												$permissions = ['email']; 
												$loginUrl = $helper->getLoginUrl('http://localhost/PW/view/fb-callback.php', $permissions);
												$clientID = '661837775057-h6a0s2kc0h15338salccf63e1k018m27.apps.googleusercontent.com';
												$clientSecret='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';
												$redirecturi='http://localhost/PW/view/Home.php';
													//Google
												$client = new Google_Client();
												$client->setClientId($clientID);
												$client->setClientSecret($clientSecret);
												$client->setRedirectUri($redirecturi);
												$client->addScope('profile');
												$client->addScope('email');
												//Google
												if(isset($_GET['code'])){
													$token=$client->fetchAccessTokenWithAuthCode($_GET['code']);
													$client->setAccessToken($token);
													$gauth = new Google_Service_Oauth2($client);
													$google_info = $gauth->userinfo->get();
													$email = $google_info->email;
													$name = $google_info->name;
													?>
													<form onsubmit="return validateForm()" action="../model/Send.php" method="POST" enctype="multipart/form-data">
														<div class="form-group">
															<input type="text" name="nom" class="form-style" placeholder="Your First Name" id="nom" autocomplete="off" value="<?php echo$name;?>">
															<i class="input-icon uil uil-user"></i>
														</div>	
														<div class="form-group mt-2">
															<input type="text" name="prenom" class="form-style" placeholder="Your Last Name" id="prenom" autocomplete="off">
															<i class="input-icon uil uil-user"></i>
														</div>	
														<div class="form-group mt-2">
															<input type="text" name="numero" class="form-style" placeholder="Your Number" id="numero" autocomplete="off">
															<i class="input-icon uil uil uil-user"></i>
														</div>
														<div class="form-group mt-2">
															<input type="email" name="email" class="form-style" placeholder="Your Email" id="email" autocomplete="off" value="<?php echo$email;?>">
															<i class="input-icon uil uil-at"></i>
														</div>
														<div class="form-group mt-2">
															<input type="password" name="password" class="form-style" placeholder="Your Password" id="password" autocomplete="off">
															<i class="input-icon uil uil-lock-alt"></i>
														</div>
														<div class="form-group mt-2">
															<input type="password" name="logpass" class="form-style" placeholder="Confirm Your Password" id="password" autocomplete="off">
															<i class="input-icon uil uil-lock-alt"></i>
														</div>
														<div class="form-group mt-2">
															<input type="password" name="logpass" class="form-style" placeholder="Confirm Your Password" id="password" autocomplete="off">
															<i class="input-icon uil uil-lock-alt"></i>
														</div>
														<div class="form-group mt-2">
															<input class="btn mt-4" type="file" name="image_url" required>
															
														</div>
														<ul>
															<li>
																<input id="r1" type="radio" name="radio" value="1">
																<label for="r1">Livreur</label>
															</li>
															<li>
																<input id="r2" type="radio" name="radio" value="2" checked>
																<label for="r2">Client</label>
															</li>
														</ul>
														<button class="btn mt-4" type="submit">submit</button>
														<div class="line"></div>
														<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn mt-4">Facebook</a>
														<a href="<?php echo $client->createAuthUrl();?>" class="btn mt-4">Google</a>
														
													</form>
												
												<?php
												}elseif (isset($_SESSION['fb_access_token'])){
													$userName = $_SESSION['userName'] ;
													$userEmail = $_SESSION['userEmail']; 
												?>
												<form onsubmit="return validateForm()" action="../model/Send.php" method="POST" enctype="multipart/form-data">
														<div class="form-group">
															<input type="text" name="nom" class="form-style" placeholder="Your First Name" id="nom" autocomplete="off" value="<?php echo$userName;?>">
															<i class="input-icon uil uil-user"></i>
														</div>	
														<div class="form-group mt-2">
															<input type="text" name="prenom" class="form-style" placeholder="Your Last Name" id="prenom" autocomplete="off">
															<i class="input-icon uil uil-user"></i>
														</div>	
														<div class="form-group mt-2">
															<input type="text" name="numero" class="form-style" placeholder="Your Number" id="numero" autocomplete="off">
															<i class="input-icon uil uil uil-user"></i>
														</div>
														<div class="form-group mt-2">
															<input type="email" name="email" class="form-style" placeholder="Your Email" id="email" autocomplete="off" value="<?php echo$userEmail;?>">
															<i class="input-icon uil uil-at"></i>
														</div>
														<div class="form-group mt-2">
															<input type="password" name="password" class="form-style" placeholder="Your Password" id="password" autocomplete="off">
															<i class="input-icon uil uil-lock-alt"></i>
														</div>
														<div class="form-group mt-2">
															<input type="password" name="logpass" class="form-style" placeholder="Confirm Your Password" id="password" autocomplete="off">
															<i class="input-icon uil uil-lock-alt"></i>
														</div>
														<div class="form-group mt-2">
															<input class="btn mt-4" type="file" name="image_url" required>
														</div>
														<ul>
															<li>
																<input id="r1" type="radio" name="radio" value="1">
																<label for="r1">Livreur</label>
															</li>
															<li>
																<input id="r2" type="radio" name="radio" value="2" checked>
																<label for="r2">Client</label>
															</li>
														</ul>
														<button class="btn mt-4" type="submit">submit</button>
														<div class="line"></div>
														<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn mt-4">Facebook</a>
														<a href="<?php echo $client->createAuthUrl();?>" class="btn mt-4">Google</a>
														
													</form>
												<?php
												}else{
												?>
													<form onsubmit="return validateForm()" action="../model/Send.php" method="POST" enctype="multipart/form-data">
														<div class="form-group">
															<input type="text" name="nom" class="form-style" placeholder="Your First Name" id="nom" autocomplete="off">
															<i class="input-icon uil uil-user"></i>
														</div>	
														<div class="form-group mt-2">
															<input type="text" name="prenom" class="form-style" placeholder="Your Last Name" id="prenom" autocomplete="off">
															<i class="input-icon uil uil-user"></i>
														</div>	
														<div class="form-group mt-2">
															<input type="text" name="numero" class="form-style" placeholder="Your Number" id="numero" autocomplete="off">
															<i class="input-icon uil uil uil-user"></i>
														</div>
														<div class="form-group mt-2">
															<input type="email" name="email" class="form-style" placeholder="Your Email" id="email" autocomplete="off">
															<i class="input-icon uil uil-at"></i>
														</div>
														<div class="form-group mt-2">
															<input type="password" name="password" class="form-style" placeholder="Your Password" id="password" autocomplete="off">
															<i class="input-icon uil uil-lock-alt"></i>
														</div>
														<div class="form-group mt-2">
															<input type="password" name="logpass" class="form-style" placeholder="Confirm Your Password" id="password" autocomplete="off">
															<i class="input-icon uil uil-lock-alt"></i>
														</div>
														<div class="form-group mt-2">
															<input class="btn mt-4" type="file" name="image_url" required>
															
														</div>
														<ul>
															<li>
																<input id="r1" type="radio" name="radio" value="1">
																<label for="r1">Livreur</label>
															</li>
															<li>
																<input id="r2" type="radio" name="radio" value="2" checked>
																<label for="r2">Client</label>
															</li>
														</ul>
														<button class="btn mt-4" type="submit">submit</button>
														<div class="line"></div>
														<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn mt-4">Facebook</a>
														<a href="<?php echo $client->createAuthUrl();?>" class="btn mt-4">Google</a>
															
													</form>
													<?php
													}
													?>
				      					</div>
			      					</div>
			      				</div>
			      			</div>
			      		</div>
			      	</div>
		      	</div>
	      	</div>
	    </div>
	</div>
<!-- partial -->
<script src="../controller/Js/Script.js"></script>
<script src="../controller/Js/Choices.js"></script>
</body>
</html>