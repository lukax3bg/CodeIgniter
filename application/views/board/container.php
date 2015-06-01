






<div class="grupe">
<div class="grupe1">
						
						<h2><div class="close2"><input type="image" src="<?php echo base_url()."/assets/images/x.png"; ?>"  alt="submit" > </div></h2>
				       	<h2><a href="#">Grupa1</a><div class="close2"><input type="image" src="<?php echo base_url()."/assets/images/x.png"; ?>"  alt="submit" > </div></h3>
				   		<h2><a href="#">grupa 2 </a><div class="close2"><input type="image" src="<?php echo base_url()."/assets/images/x.png"; ?>"  alt="submit" > </div></h3>
				   		<h2><a href="#">grupa 3</a><div class="close2"><input type="image" src="<?php echo base_url()."/assets/images/x.png"; ?>"  alt="submit" > </div></h3>
						<h2><a href="#">Agrupa 4</a></h3>
						<div class="novagrupa">
			        		<input type="text" placeholder="nova grupa" width="200px;" name="title"><br>
						</div>
			        		<div class="post-info-rate-share1">

			        			<input type="submit" name="insert" value="Add new group">
			        		</div>
			        	</div>
						<div class="clanovi"">
						<div class="grupe1">
						
						<h2><div class="close2"><input type="image" src="<?php echo base_url()."/assets/images/x.png"; ?>"  alt="submit" > </div></h2>
				       	<h2><a href="#">Luka </a><div class="close2"><input type="image" src="<?php echo base_url()."/assets/images/x.png"; ?>"  alt="submit" > </div></h3>
				   		<h2><a href="#">Dusan </a><div class="close2"><input type="image" src="<?php echo base_url()."/assets/images/x.png"; ?>"  alt="submit" > </div></h3>
				   		<h2><a href="#">Anima</a><div class="close2"><input type="image" src="<?php echo base_url()."/assets/images/x.png"; ?>"  alt="submit" > </div></h3>
						<h2><a href="#">Aleksa</a></h3>
						<div class="novagrupa">
			        		<input type="text" placeholder="nov clan" width="200px;" name="title"><br>
						</div>
			        		<div class="post-info-rate-share1">

			        			<input type="submit" name="insert" value="Add new member">
			        		</div>
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
							<textarea  name="text"> </textarea>
							
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
					/*echo '<div class="one-note">
							<h1>'; echo $text; echo '</h1>
						</div>';*/
						
					/*echo '<div class="one-note">
					
					
					src="'; echo base_url()."/assets/images/psi.jpg"; echo '"
					
					
					<input type="image" src="'; echo base_url()."/assets/images/x.png"; echo '" name="hide" value="'; echo $note; echo '" alt="submit" >
					
					

						<div class="naslov">'; echo $naslov; echo '</div>
						<div class="tekst">'; echo $text; echo '</div>
						<div class="datum">'; echo $datum; echo'</div>
					</div>';*/
					
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
			?>
					
					<!--<li class="jedanNote">
					<div class="close1"> </div>
						<div class="post-basic-info">
						
				        		<h3><a href="<?php echo base_url()."#"; ?>">Animation films</a></h3>
				        		<span><a href="<?php echo base_url()."#"; ?>"><label> </label>30.5.2015 - 03:55</a></span>
				        		<p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. isl mus a euismod varius aenean massa. Suspendisse vivamus natoque cubilia volutpat praesent euismod primis.</p>
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
					</li>
			

					<li class="jedanNote">
						<div class="close1"> </div>
						<div class="post-basic-info">
				        		<h3><a href="<?php echo base_url()."#"; ?>">Animation films</a></h3>
				        		<span><a href="<?php echo base_url()."#"; ?>"><label> </label>30.5.2015 - 03:55</a></span>
				        		<p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. isl mus a euismod varius aenean massa. Suspendisse vivamus natoque cubilia volutpat praesent euismod primis.</p>
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
					</li>

					<li class="jedanNote">
						<div class="close1"> </div>
						<div class="post-basic-info">
				        		<h3><a href="<?php echo base_url()."#"; ?>">Animation films</a></h3>
				        		<span><a href="<?php echo base_url()."#"; ?>"><label> </label>30.5.2015 - 03:55</a></span>
				        		<p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. isl mus a euismod varius aenean massa. Suspendisse vivamus natoque cubilia volutpat praesent euismod primis.</p>
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
					</li>

					<li class="jedanNote">
						<div class="close1"> </div>
						<div class="post-basic-info">
				        		<h3><a href="<?php echo base_url()."#"; ?>">Animation films</a></h3>
				        		<span><a href="<?php echo base_url()."#"; ?>"><label> </label>30.5.2015 - 03:55</a></span>
				        		<p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. isl mus a euismod varius aenean massa. Suspendisse vivamus natoque cubilia volutpat praesent euismod primis.</p>
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
					</li>

					<li class="jedanNote">
						<div class="close1"> </div>
						<div class="post-basic-info">
				        		<h3><a href="<?php echo base_url()."#"; ?>">Animation films</a></h3>
				        		<span><a href="<?php echo base_url()."#"; ?>"><label> </label>30.5.2015 - 03:55</a></span>
				        		<p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. isl mus a euismod varius aenean massa. Suspendisse vivamus natoque cubilia volutpat praesent euismod primis.</p>
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
					</li>

					<li class="jedanNote">
						<div class="close1"> </div>
						<div class="post-basic-info">
				        		<h3><a href="<?php echo base_url()."#"; ?>">Animation films</a></h3>
				        		<span><a href="<?php echo base_url()."#"; ?>"><label> </label>30.5.2015 - 03:55</a></span>
				        		<p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. isl mus a euismod varius aenean massa. Suspendisse vivamus natoque cubilia volutpat praesent euismod primis.</p>
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
					</li>

					<li class="jedanNote">
						<div class="close1"> </div>
						<div class="post-basic-info">
				        		<h3><a href="<?php echo base_url()."#"; ?>">Animation films</a></h3>
				        		<span><a href="<?php echo base_url()."#"; ?>"><label> </label>30.5.2015 - 03:55</a></span>
				        		<p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. isl mus a euismod varius aenean massa. Suspendisse vivamus natoque cubilia volutpat praesent euismod primis.</p>
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
					</li>	
						<li class="jedanNote">
						<div class="close1"> </div>
						<div class="post-basic-info">
				        		<h3><a href="<?php echo base_url()."#"; ?>">Animation films</a></h3>
				        		<span><a href="<?php echo base_url()."#"; ?>"><label> </label>30.5.2015 - 03:55</a></span>
				        		<p>Lorem Ipsum is simply dummy text of the printing & typesetting industry. isl mus a euismod varius aenean massa. Suspendisse vivamus natoque cubilia volutpat praesent euismod primis.</p>
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
					</li>-->
					
				</ul>

				<br class="clear" />
				
			</div>
		</div>