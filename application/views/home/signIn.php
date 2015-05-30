<html>
 <!-- autor : luka jovanovic --->
<head>
	
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/css/css_index/style.css"; ?>">
		
</head>




<body background="<?php echo base_url()."/assets/images/psi.jpg"; ?>">


			<section class="main">
							
				<div class="logovanje">
							<?php echo validation_errors();?>
                            <?php echo form_open('LoginController/checkLogin');?>
							
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
 
 </body>
 </html>