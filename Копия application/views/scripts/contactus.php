
<div id="inside_container">
    <div>
        <?php echo ViewMessage::renderMessages(); ?>
    </div>
    <form onsubmit="return chk1();" action="<?php echo URL::base(); ?>contact-us/send" method="post" name="contform" id="contform">
        <h1>Contact Us</h1>
        <p class="fontsize18"><strong>Should you require any further information about FloorSand UK or any of the products or services we offer, simply enter your name, email and question below and a member of the FloorSandUK team will usually get back to you straight away.</strong></p>
        <div id="contact_form_block">
            <div class="field_set">
                <input name="txt_name" id="txt_name" type="text" value="Name" onfocus="if(this.value=='Name'){this.value=''};" onblur="if(this.value==''){this.value='Name'};" />
                <input name="email" id="email" type="text" value="Email" onfocus="if(this.value=='Email'){this.value=''};" onblur="if(this.value==''){this.value='Email'};" />
                <div class="clear"></div>
            </div>
            <div class="field_set">
                <textarea name="enquiry" id="enquiry" cols="" rows="" onfocus="if(this.value=='Enquiry'){this.value=''};" onblur="if(this.value==''){this.value='Enquiry'};">Enquiry</textarea>
            </div>
        </div>
        <div id="contact_inoformation">
            <div id="col1">
                <h3>Floor Sand  Limited (Residential)</h3>
                <p>Incorporated in England and Wales<br />
                    & registered under company<br />
                    number 07285768.</p>
                <p>&nbsp;</p>
                <h3>FloorSandUK  Limited (Commercial)</h3>
                <p>Incorporated in England and Wales<br />
                    &amp; registered under company<br />
                    number 07064910.</p>
                <p>V.A.T. Registration No. 981 3911 04</p>
                <p>&nbsp;</p>
                <p>Registered Office: 132 Great Ancoats Street,</p>
                <p>Manchester M4</p>
                <h4>&nbsp;</h4>
            </div>
            <div id="col2">
                <h3>Telephone Numbers:</h3>
                <p>01625 582567 Main Office Enquiries</p>
                <p>0161 798 0888 Accounts</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p><span class="orange">Email:</span> <a href="mailto:info@floorsanduk.com">info@floorsanduk.com</a></p>
                <p><span class="orange">Website:</span> <a href="http://www.floorsanduk.com">www.floorsanduk.com</a></p>
                <p><span class="orange">Fax:</span> 01625 582424</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
            <div id="col3">
                <input name="submit" type="submit" class="buttons" value="Submit Enquiry" />
            </div>
            <div class="clear"></div>
        </div>
    </form>
</div>