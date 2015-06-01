



<div class="header">
				<div class="wrap">
				<div class="logo">
				
				</div>
				
				<div class="nav-icon">
				<p>Pin<a href="<?php echo base_url()."index.php/BoardController"; ?>">Board</a></p>
					<?php echo form_open('UserController/logout');  ?> <input type="submit"  name="submit" value=""  class="right_bt" id="activator" /><span> </span> </a></form>
				</div>
				        	  
				<div class="top-searchbar">
					<?php echo form_open('BoardController/search');  ?>
						<input type="text"	 name="name"/><input type="submit" name="submit" value="Search" />
					</form>
				</div>
				<div class="userinfo">
					<div class="user">
						<ul>

							<li><a href="<?php echo base_url()."index.php/BoardController/editUser"; ?>"><img src="<?php echo base_url()."/assets/images/user-pic.png"; ?>" title="user-name" /><span><?php echo $ime; ?></span></a></li>

							

						</ul>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
		</div>