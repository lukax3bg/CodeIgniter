


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
					/*echo '<div class="one-note">
							<h1>'; echo $text; echo '</h1>
						</div>';*/
						
					/*echo '<div class="one-note">
						<div class="naslov">'; echo $naslov; echo '</div>
						<div class="tekst">'; echo $text; echo '</div>
						<div class="datum">'; echo $datum; echo'</div>
					</div>';*/
					
					echo '<li class="jedanNote">
					<div class="close1"> </div>
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