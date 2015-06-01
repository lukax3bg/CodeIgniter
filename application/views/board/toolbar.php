



<div class="header">
				<div class="wrap">
				<div class="logo">
					<a href="index.html"><img src="<?php echo base_url()."/assets/images/logo1.png"; ?>" title="pinboard" /> </a>
				</div>
				
				<div class="nav-icon">
				<p>Pin<a href="<?php echo base_url()."index.php/BoardController"; ?>">Board</a></p>
					 <a href="<?php echo base_url()."#"; ?>" class="right_bt" id="activator"><span> </span> </a>
				</div>
				 <div class="box" id="box">
					 <div class="box_content">        					                         
						<div class="box_content_center">
						 	<div class="form_content">
								<div class="menu_box_list">
									<ul>
										<li><a href="<?php echo base_url()."#"; ?>"><span>home</span></a></li>
										<li><a href="<?php echo base_url()."#"; ?>"><span>About</span></a></li>
										<li><a href="<?php echo base_url()."#"; ?>"><span>Works</span></a></li>
										<li><a href="<?php echo base_url()."#"; ?>"><span>Clients</span></a></li>
										<li><a href="<?php echo base_url()."#"; ?>"><span>Blog</span></a></li>
										<li><a href="<?php echo base_url()."#"; ?>"><span>Contact</span></a></li>
										<div class="clear"> </div>
									</ul>
								</div>
								<a class="boxclose" id="boxclose"> <span> </span></a>
							</div>                                  
						</div> 	
					</div> 
				</div>       	  
				<div class="top-searchbar">
					<form>
						<input type="text" /><input type="submit" value="" />
					</form>
				</div>
				<div class="userinfo">
					<div class="user">
						<ul>
							<li><a href="<?php echo base_url()."index.php/BoardController/editUser"; ?>"><img src="<?php echo base_url()."/assets/images/user-pic1.png"; ?>" title="user-name" /><span><?php echo $ime; ?></span></a></li>
						</ul>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>