
<html>

<head>

   

		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/css/css_index/style.css"; ?>">

  

</head>

<body>
					

					
					
					
    
       <div class="ograda">
	   
        <div class="profil">
            <div class="profil1">
                <div class="pozicijaprofil">
                    <img class="slikaDim" src="<?php echo base_url()."/assets/images/uploads/".$slika; ?>" >
                    <div class="izmenaProfila">
					
					
				
				<?php echo form_open_multipart('upload/do_upload');?>
					<div class="upload1">
					<input type="file" name="userfile"  size="20" width="10px" />
					</div>
					<br /><br />

					<input type="submit" value="upload"  />

					</form>
					

					


						
						

                    <?php echo form_open('UserController/changeMail');?>
				        <label >E-mail</label>
						
				        <input type="text" placeholder="email" name="email" >
						<input type="submit" name="submit" value="Promeni mail">
						</form>
						
						<?php echo form_open('UserController/changePass');?>
				        <label >Old password</label>
				        <input type="password" placeholder="password" name="password"> 
				    
					
				        <label for="password">New Password</label>
				        <input type="password" placeholder="new-password" name="new-password"> 
				   
				        <label for="password">Repeat password</label>
				        <input type="password" placeholder="re-password" name="re-password"> 
				    
				        <input type="submit" name="submit" value="Promeni sifru">
				       
                        </form>
                    </div>
					
					<?php echo validation_errors();?>
                </div>
            </div>
        </div>
		</div>
    

   
</body>

</html>
