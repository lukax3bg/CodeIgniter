
<html>

<head>

   

		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()."/assets/css/css_index/style.css"; ?>">

  

</head>

<body>

    
       <div class="ograda">
        <div class="profil">
            <div class="profil1">
                <div class="pozicijaprofil">
                    <img class="slikaDim" src="<?php echo base_url()."/assets/images/pic10.jpg"; ?>" >
                    <div class="izmenaProfila">
                       
                    <?php echo form_open('UserController/changeMail');?>
				        <label >Title</label>
						
				        <input type="text" placeholder="Title" name="title" >
						<div class="unesiNotes">
						<textarea  name="text"> </textarea>
						</div>
						<input type="submit" name="submit" value="Promeni note!">
						</form>
						
						
				       
                        </form>
                    </div>
					
					<?php echo validation_errors();?>
                </div>
            </div>
        </div>
		</div>
    

   
</body>

</html>
