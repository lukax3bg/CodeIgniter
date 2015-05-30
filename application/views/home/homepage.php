<html>

<head>
	
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/css/css_index/style.css"; ?>"> 
		 <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>




<body>
<div id="bg">
	<img src="<?php echo base_url()."/assets/images/psi.jpg"; ?>" width="100%" height="100%" style="position: fixed; top: 0px; left: 0px;">
</div>
<div id="container">
	
			
			
			<section class="main">
					<?php echo validation_errors();?>		
				<div class="logovanje">
						
                        <?php echo form_open('UserController/checkLogin');?>	
							
				    <h1>Login</h1>
				    <p>
				        <label for="login">Username</label>
				        <input type="text" placeholder="username" name="username" >
				    </p>
				    <p>
				        <label for="password">Password</label>
				        <input type="password" placeholder="password" name="password"> 
				    </p>

				    <p>
				        <input type="submit" name="signin" value="sign in">
				    </p>
					</form>					
				</div>
			</section>
			
			<!-- druga -->
			
			<section class="main">
							
				<div class="logovanje">
						
                        <?php echo form_open('UserController/register');?>	
							
				    <h1>Register</h1>
				    <p>
				        <label for="login">Username</label>
				        <input type="text" placeholder="username" name="usernameR" >
				    </p>
					 <p>
				        <label for="password">Password</label>
				        <input type="password" placeholder="password" name="passwordR"> 
				    </p>
					<p>
				        <label for="password">Repeat password</label>
				        <input type="password" placeholder="re-password" name="re-password" >
				    </p>
					<p>
				        <label for="login">E-mail</label>
				        <input type="text" placeholder="email" name="email" >
				    </p>
				   

				    <p>
					
				        <input type="submit" name="signup" value="sign up">
				    </p>       
				</div>
				
			</section>
			
			
 </div>
 </body>
 </html>