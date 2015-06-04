






<div class="grupe">
<div class="grupe1">
						
					
				       	<h2><a href="<?php echo base_url()."index.php/BoardController?id=0"; ?>">All notes</a></h2>
				   		<h2><a href="<?php echo base_url()."index.php/BoardController?id=-1"; ?>">My notes</a>
						
						
						<?php
				
								$groups = $grupe;
								
								
									
								while ($row = mysqli_fetch_assoc($groups))
								{
									
									
									
									$name=$row['name'];
									$idGrupa = $row['idGroup'];
									
									
									
									echo '
									<div class="close2">';echo form_open('BoardController/leaveGroup'); echo  
									
									'
									<input type="hidden" placeholder="grupa" name="grupa" value='; echo $idGrupa; echo '>
									
									
									<input type="image" src="'; echo base_url()."/assets/images/x.png"; echo '" name="hide" value="'; echo $idGrupa; echo '" alt="submit" ></form></div></h2>';	
									
									
									
									
									//echo '<div class="close2"><input type="image" src="'; echo base_url()."/assets/images/x.png"; echo '"  alt="submit" > </div></h2>';
				   		
										echo '<h2><a href="'; echo base_url()."index.php/BoardController?id="; echo $idGrupa; echo '">'; echo $name; echo '</a></h2>';
										//echo '<h2><a href="#">Animation films</a></h3>';
										
									
								} 
							?>
						
						<?php echo form_open('BoardController/newGroup'); ?>
						<div class="novagrupa">
			        		<input type="text" placeholder="nova grupa" width="200px;" name="title"><br>
						</div>
			        		<div class="post-info-rate-share1">

			        			<input type="submit" name="insert" value="Add new group">
			        		</div>
							</form>	
						
			        	</div>
						
						
						<div class="clanovi"">
						<div class="grupe1">
						
						
						
						
						<?php
				
								$users = $korisnici;
								$isAdmin = $admin;
								if(($_SESSION["group"]>0)&&($isAdmin ==1))
								{
								
									
									while ($row = mysqli_fetch_assoc($users))
									{
										$nick=$row['nickname'];
										$userID = $row['idUser'];
										
										
										
										echo '
										<div class="close2">';echo form_open('BoardController/make_Admin'); echo  
										
										'
										<input type="hidden" placeholder="user" name="user" value='; echo $userID; echo '>
										
										<input type="image" src="'; echo base_url()."/assets/images/admin.png"; echo '" name="hide" value="'; echo $nick; echo '" alt="submit" ></div></form>';
										
										
										echo form_open('BoardController/ban_User'); echo  
										
										'<div class="close2">
										<input type="hidden" placeholder="user" name="user" value='; echo $userID; echo '>
										
										<input type="image" src="'; echo base_url()."/assets/images/x.png"; echo '" name="hide" value="'; echo $nick; echo '" alt="submit" ></form></div>';	
										
										
										
										//echo '<div class="close2"><input type="image" src="'; echo base_url()."/assets/images/x.png"; echo '"  alt="submit" > </div></h2>';
							
											echo '<h2><a href="'; echo base_url()."#"; echo '">'; echo $nick; echo '</a></h2>';
											//echo '<h2><a href="#">Animation films</a></h3>';
										
									}
									
									echo form_open('BoardController/add_User');
									echo '
									<div class="novagrupa">
										<input type="text" placeholder="nick" width="200px;" name="nick"><br>
									</div>
										<div class="post-info-rate-share1">

											<input type="submit" name="insert" value="Add new member">
										</div>
										</form>
									';
								}
								else if($_SESSION["group"]>0)
								{
									while ($row = mysqli_fetch_assoc($users))
									{
										$nick=$row['nickname'];
										$userID = $row['idUser'];
										
										
										
										echo '
										<div class="close2">
										<input type="hidden" placeholder="user" name="user" value='; echo $userID; echo '>
										
										
										</div></h2>';	
										
										
										
										//echo '<div class="close2"><input type="image" src="'; echo base_url()."/assets/images/x.png"; echo '"  alt="submit" > </div></h2>';
							
											echo '<h2><a href="'; echo base_url()."#"; echo '">'; echo $nick; echo '</a></h2>';
											//echo '<h2><a href="#">Animation films</a></h3>';
										
									}
									
									
								}
							?>
						
						
						</div>
						
					</div>	
						
						

</div>







<div id="outer">
						
			<div id="main">
			
			
			
			
			
			
				<ul class="gallery" >
					
					<li>
						
					<!--	<a href="images/pic02full.jpg"><img class="top" src="images/pic02.jpg" width="260" height="200" title="This is photo 1" alt="" /></a> -->
						<div class="post-info">
						<?php echo form_open('BoardController/newNote'); ?>
						<div class="notetitle">
			        		<input type="text" placeholder="title" width="200px;" name="title"><br>
						</div>
						<div class="unesiNotes">
							<textarea  name="text" > </textarea>
							
						</div>
			        		<div class="post-info-rate-share">
			        			<input type="submit" name="insert" value="Post me!">
			        		</div>
						</form>	
			        	</div>
					</li>
					
					
					<?php
				
				$result = $rezultat;
				
				
					
				while ($row = mysqli_fetch_assoc($result))
				{
					$text=$row['text'];
					$datum = $row['created_On'];
					$naslov = $row['title'];
					$note = $row['idNote'];
					$fav = $row['fav'];
					$slika = $linkovi["'".$note."'"];
					
					$textL = strtolower($text);
					$naslovL = strtolower($naslov);
					$argL = strtolower($arg);
					if ($filter == 0)
					{
						echo '<li class="jedanNote">
						<div class="close1">';echo form_open('BoardController/hideNote'); echo  
						
						'
						<input type="hidden" placeholder="idNote" name="idNote" value='; echo $note; echo '>
						
						
						<input type="image" src="'; echo base_url()."/assets/images/x.png"; echo '" name="hide" value="'; echo $note; echo '" alt="submit" ></form> </div>
							<div class="post-basic-info">
							
									<h3><a href="';echo base_url()."#";echo '">'; echo $naslov; echo '</a></h3>
									<span><a href="'; echo base_url()."#"; echo '"><label> </label>'; echo $datum; echo'</a></span>
									<p>'; echo $text; echo '</p>
								</div>
							
							<div class="post-info-rate-share">
									<div class="oceni">
										<span>';echo form_open('BoardController/favNote'); echo  
						
										'<input type="hidden" placeholder="idNote" name="idNote" value='; echo $note; echo '> <input type="image" src="';
										if($fav == 0)
										{
											echo base_url()."assets/images/zvezdicaSiva.png";
										}
										else
										{
											echo base_url()."assets/images/zvezdica.png";
										}
										
										echo'" name="fav" value="';echo $note;  echo '" alt="submit" >';echo ' </form></span>
										
									</div>
									<span id="qwe"> <input type="image" src="'; echo base_url()."/assets/images/lock.png"; echo '" name="hide" value="'; ; echo '" alt="submit" ></span>
									<span id="qwer">'; echo form_open('BoardController/stranicaEdit'); echo  
						
										'<input type="hidden" placeholder="idNote" name="idNote" value='; echo $note; echo '> <input type="image" src="'; echo base_url()."/assets/images/edit.png"; echo'" name="fav" value="';echo $note;  echo '" alt="submit" ></form></span>
									<div class="post-share">
										<span><img src="'; echo base_url()."/assets/images/uploads/".$slika; echo '" title="" /> </span>
									</div>
									<div class="clear"> </div>
								</div>
						</li>';
					}
					else if((strpos($textL,$argL)!== FALSE)||((strpos($naslovL,$argL)!== FALSE)))
					{
						echo '<li class="jedanNote">
						<div class="close1">';echo form_open('BoardController/hideNote'); echo  
						
						'
						<input type="hidden" placeholder="idNote" name="idNote" value='; echo $note; echo '>
						
						
						<input type="image" src="'; echo base_url()."/assets/images/x.png"; echo '" name="hide" value="'; echo $note; echo '" alt="submit" ></form> </div>
							<div class="post-basic-info">
							
									<h3><a href="';echo base_url()."#";echo '">'; echo $naslov; echo '</a></h3>
									<span><a href="'; echo base_url()."#"; echo '"><label> </label>'; echo $datum; echo'</a></span>
									<p>'; echo $text; echo '</p>
								</div>
							
							<div class="post-info-rate-share">
									<div class="oceni">
										<span> </span>
									</div>
									<div class="post-share">
										<span> </span>
									</div>
									<div class="clear"> </div>
								</div>
						</li>';
					}
					
				} 
			?>
					
					
					
				</ul>

				<br class="clear" />
				
			</div>
		</div>