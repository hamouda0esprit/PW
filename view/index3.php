<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Log In / Sign Up - pure css - #12</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'><link rel="stylesheet" href="./ModStyle.css">

</head>
<body>
<!-- partial:index.partial.html -->
<a href="./Home.php" class="logo" target="_blank">
		<img src="../controller/Assets/logo.png" alt="">
	</a>
	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Reset Password</h4>
											<form action="../model/Update password.php" method="POST" onsubmit="return validatemdp();">
												<div class="form-group">
													<input type="email" name="email" class="form-style" placeholder="Your Email" id="email" autocomplete="off">
													<i class="input-icon uil uil-at"></i>
												</div>	
												<div class="form-group mt-2">
													<input type="password" name="newPassword" class="form-style" placeholder="Your new Password" id="password" autocomplete="off">
													<i class="input-icon uil uil-lock-alt"></i>
												</div>
												<button class="btn mt-4" type="submit">submit</button>
												<p class="mb-0 mt-4 text-center"><a href="./Home.php" class="link">Log In</a></p>
											</form>
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
  <script  src="./script.js"></script>

</body>
</html>
