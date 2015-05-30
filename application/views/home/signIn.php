<html>
 <!-- autor : luka jovanovic --->
<head>
	
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/css/css_index/style.css"; ?>">
		
</head>




<body>
<div id="bg">
	<img src="<?php echo base_url()."/assets/images/psi.jpg"; ?>" width="100%" height="100%" style="position: fixed; top: 0px; left: 0px;">
</div>
<div id="container">
	

			<section class="main">
							
				<div class="logovanje">
							<?php echo validation_errors();?>
                            <?php echo form_open('UserController/checkLogin');?>
							
				    <h1>Login or Register</h1>
				    <p>
				        <label for="login">Username</label>
				        <input type="text" placeholder="username" name="username" >
				    </p>
				    <p>
				        <label for="password">Password</label>
				        <input type="password" placeholder="password" name="password"> 
				    </p>

				    <p>
				        <input type="submit" name="submit" value="sign in">
				    </p>       
				</div>
			</section>
 </div>
 </body>
 </html>