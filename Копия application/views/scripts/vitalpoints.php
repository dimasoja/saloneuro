            <div id="inside_container">
                <div>
                    <?php echo ViewMessage::renderMessages(); ?>
                </div>
<form method="post" action="<?php echo URL::base(); ?>vital-points">	
<div id="thanks">
<h1>Type in your name and email address<br /> 
to receive your FREE 20 Vital Points
<input type="text" name="username" value="My first name is" class="textbox" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" /><br />
<input type="text" name="surname" value="My last name is" class="textbox" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" /><br />
	<input type="text" name="email" value="My email is" class="textbox" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
</h1>
    
     
<center><img src="<?php echo URL::base(); ?>images/thanks-img.jpg" alt="" /></center>
<div class="clear"></div>
<div style="margin: 10px auto; width: 100px"><input type="submit" value="SUBMIT" class="back-button2" /></div>
	</div>
</form>
            </div>