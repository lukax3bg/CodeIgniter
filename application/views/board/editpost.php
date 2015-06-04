
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
                       
                    <?php echo form_open('BoardController/editujNote');?>
				        <label >Title</label>
						
						
						
				        <input type="text" placeholder="Title" name="title" value = "<?php echo $podaci['title']?>" >
						<input type="hidden" placeholder="Title" name="idNote" value = <?php echo $podaci['idNote']?> >
						<input type="hidden" placeholder="Title" name="tabela" value = <?php echo $podaci['tabela']?> >
						<input type="hidden" placeholder="Title" name="id_Group" value = <?php echo $podaci['id_Group']?> >
						<input type="hidden" placeholder="Title" name="lock" value = <?php echo $podaci['lock']?> >
						<div class="unesiNotes">
						<textarea  name="text" value = "<?php echo $podaci['text']?>" ><?php echo $podaci['text']?></textarea>
						</div>
						<input type="submit" name="submit" value="Promeni note!">
						</form>
						
                    </div>
					
                </div>
            </div>
        </div>
		</div>
    

   
</body>

</html>
