<script type="text/javascript">
function slide1show() {
    jQuery('#slide1').css('display', 'block');
    jQuery('#slide2').css('display', 'none');
    jQuery('.big-arrow-left').attr('src','<?php echo URL::base(); ?>images/testimonials/arrow-left-fill.png');
    jQuery('.big-arrow-right').attr('src','<?php echo URL::base(); ?>images/testimonials/arrow-right-out.png');
    jQuery('#small-arrow-left').attr('src','<?php echo URL::base(); ?>images/testimonials/arrow-left-fill.png');
    jQuery('#small-arrow-right').attr('src','<?php echo URL::base(); ?>images/testimonials/arrow-right-out.png');
    jQuery('#num2').css('text-decoration', 'none');
    jQuery('#num1').css('text-decoration', 'underline');
}

function slide2show() {
    jQuery('#slide1').css('display', 'none');
    jQuery('#slide2').css('display', 'block');
    jQuery('.big-arrow-left').attr('src','<?php echo URL::base(); ?>images/testimonials/arrow-left-out.png');
    jQuery('.big-arrow-right').attr('src','<?php echo URL::base(); ?>images/testimonials/arrow-right-fill.png');
    jQuery('#small-arrow-left').attr('src','<?php echo URL::base(); ?>images/testimonials/arrow-left-out.png');
    jQuery('#small-arrow-right').attr('src','<?php echo URL::base(); ?>images/testimonials/arrow-right-fill.png');
    jQuery('#num1').css('text-decoration', 'none');
    jQuery('#num2').css('text-decoration', 'underline');
}
</script>
    <!--containt area holder -->
    <div id="supplies-containt_area_holder">
        <div id="testimonials-content"><br/>
            <h1>Testimonial Inspection</h1>

            <font class="under_h1">Look at the information given by the customer and if approved, upload to site.</font>
            <p class="fontsize17">
                The purposes of the testimonial is for Customer Awareness, Training and Marketing purposes. It is at our discretion, what submittances are 
                uploaded to site. To qualify to be uploaded to site the document satisfy what is considered a satisfactory testimonial by FloorSand UK. In
                the event that a customer expresses disatisfactory results it may be that the document is only used to make us "Aware of the Customer" dissatisfaction
                and we may choose to take some action to remedy the situation (subject to the individual circumstances), this could also qualify for us to use this 
                information for the further "Training" of the company staff and/or "Marketing"
            </p>

        </div>
        <div id="testimonials-form"><br/><br/>
            <form id="testimonials-form-add" method="post" action="<?php echo URL::base(); ?>testimonials/add">
                <div class="require-services bordernone">
                    <ul class="buff" style="overflow: hidden !important;">
                        <div id="slide1" style="display:block;">
                            <li>
                                <input id="name" type="text" title="First Name" name="name" value="<?php echo $testimonials_info['name'];?>" class="franchisee-name<?php if (isset($name_show_error)) echo $name_show_error; ?>" />
                                <?php if (isset($name_error) && '' != $name_error): ?>
                                    <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                                        <?php echo $name_error; ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                            <li>
                                <input id="surname" type="text" title="Last Name" name="surname" value="<?php echo $testimonials_info['surname']; ?>" class="franchisee-name<?php if (isset($surname_show_error)) echo $surname_show_error; ?>" />
                                <?php if (isset($surname_error) && '' != $surname_error): ?>
                                    <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                                        <?php echo $surname_error; ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                            <li>
                                <input id="email" type="text" title="E-mail" name="email" value="<?php echo $testimonials_info['email']; ?>" class="franchisee-name<?php if (isset($email_show_error)) echo $email_show_error; ?>"  />
                                <?php if (isset($email_error) && '' != $email_error): ?>
                                    <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                                        <?php echo $email_error; ?>
                                    </div>
                                <?php endif; ?>
                                <br/><br/>
                                <h4>Please answer the following questions by circling a rating of 1-5 <br/><b>(1= very bad 2 = bad 3 = fair 4 = good 5 = excellent)</b></h4>
                            </li>
                            <li>                     
                                <h2>What were your first impressions when we came to see you? (If a visit was made)</h2>
                                <div class="answer">1<input type="radio" name="quest1" value="1" <?php if($testimonials_info['quest1']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest1" value="2" <?php if($testimonials_info['quest1']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest1" value="3" <?php if($testimonials_info['quest1']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest1" value="4" <?php if($testimonials_info['quest1']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest1" value="5" <?php if($testimonials_info['quest1']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>How good was the timekeeping of our members of staff?</h2>
                                <div class="answer">1<input type="radio" name="quest2" value="1" <?php if($testimonials_info['quest2']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest2" value="2" <?php if($testimonials_info['quest2']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest2" value="3" <?php if($testimonials_info['quest2']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest2" value="4" <?php if($testimonials_info['quest2']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest2" value="5" <?php if($testimonials_info['quest2']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate the presentation of our workforce?</h2>
                                <div class="answer">1<input type="radio" name="quest3" value="1" <?php if($testimonials_info['quest3']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest3" value="2" <?php if($testimonials_info['quest3']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest3" value="3" <?php if($testimonials_info['quest3']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest3" value="4" <?php if($testimonials_info['quest3']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest3" value="5" <?php if($testimonials_info['quest3']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate the attitude of our workforce? </h2>
                                <div class="answer">1<input type="radio" name="quest4" value="1" <?php if($testimonials_info['quest4']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest4" value="2" <?php if($testimonials_info['quest4']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest4" value="3" <?php if($testimonials_info['quest4']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest4" value="4" <?php if($testimonials_info['quest4']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest4" value="5" <?php if($testimonials_info['quest4']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate your "first" impressions of our company, when we arrived to do the work?</h2>
                                <div class="answer">1<input type="radio" name="quest5" value="1" <?php if($testimonials_info['quest5']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest5" value="2" <?php if($testimonials_info['quest5']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest5" value="3" <?php if($testimonials_info['quest5']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest5" value="4" <?php if($testimonials_info['quest5']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest5" value="5" <?php if($testimonials_info['quest5']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>Overall, how professional did we look when we arrived and when doing the work?</h2>
                                <div class="answer">1<input type="radio" name="quest6" value="1" <?php if($testimonials_info['quest6']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest6" value="2" <?php if($testimonials_info['quest6']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest6" value="3" <?php if($testimonials_info['quest6']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest6" value="4" <?php if($testimonials_info['quest6']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest6" value="5" <?php if($testimonials_info['quest6']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate how friendly we are?</h2>
                                <div class="answer">1<input type="radio" name="quest7" value="1" <?php if($testimonials_info['quest7']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest7" value="2" <?php if($testimonials_info['quest7']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest7" value="3" <?php if($testimonials_info['quest7']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest7" value="4" <?php if($testimonials_info['quest7']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest7" value="5" <?php if($testimonials_info['quest7']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate how helpful we are? </h2>
                                <div class="answer">1<input type="radio" name="quest8" value="1" <?php if($testimonials_info['quest8']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest8" value="2" <?php if($testimonials_info['quest8']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest8" value="3" <?php if($testimonials_info['quest8']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest8" value="4" <?php if($testimonials_info['quest8']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest8" value="5" <?php if($testimonials_info['quest8']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>Are we tidy? </h2>
                                <div class="answer">1<input type="radio" name="quest9" value="1" <?php if($testimonials_info['quest9']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest9" value="2" <?php if($testimonials_info['quest9']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest9" value="3" <?php if($testimonials_info['quest9']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest9" value="4" <?php if($testimonials_info['quest9']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest9" value="5" <?php if($testimonials_info['quest9']=='5') echo 'checked'; ?>/></div>
                            </li>
                        </div>
                        <div id="slide2" style="display: none;">
                            <li>                     
                                <h2>Did we do what we said we would do? </h2>
                                <div class="answer">1<input type="radio" name="quest10" value="1" <?php if($testimonials_info['quest10']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest10" value="2" <?php if($testimonials_info['quest10']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest10" value="3" <?php if($testimonials_info['quest10']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest10" value="4" <?php if($testimonials_info['quest10']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest10" value="5" <?php if($testimonials_info['quest10']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>Did we do any more than you expected?</h2>
                                <div class="answer">1<input type="radio" name="quest11" value="1" <?php if($testimonials_info['quest11']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest11" value="2" <?php if($testimonials_info['quest11']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest11" value="3" <?php if($testimonials_info['quest11']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest11" value="4" <?php if($testimonials_info['quest11']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest11" value="5" <?php if($testimonials_info['quest11']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>How satisfied are you with the work we have carried out for you?</h2>
                                <div class="answer">1<input type="radio" name="quest12" value="1" <?php if($testimonials_info['quest12']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest12" value="2" <?php if($testimonials_info['quest12']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest12" value="3" <?php if($testimonials_info['quest12']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest12" value="4" <?php if($testimonials_info['quest12']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest12" value="5" <?php if($testimonials_info['quest12']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>Would you recommend us to your nearest & dearest family & friends?</h2>
                                <div class="answer">1<input type="radio" name="quest13" value="1" <?php if($testimonials_info['quest13']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest13" value="2" <?php if($testimonials_info['quest13']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest13" value="3" <?php if($testimonials_info['quest13']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest13" value="4" <?php if($testimonials_info['quest13']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest13" value="5" <?php if($testimonials_info['quest13']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>Would you recommend us to your acquaintances?</h2>
                                <div class="answer">1<input type="radio" name="quest14" value="1" <?php if($testimonials_info['quest14']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest14" value="2" <?php if($testimonials_info['quest14']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest14" value="3" <?php if($testimonials_info['quest14']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest14" value="4" <?php if($testimonials_info['quest14']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest14" value="5" <?php if($testimonials_info['quest14']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>                     
                                <h2>Overall, how professional did we look when we were finishing or finished the work?</h2>
                                <div class="answer">1<input type="radio" name="quest15" value="1" <?php if($testimonials_info['quest15']=='1') echo 'checked'; ?>/></div>
                                <div class="answer">2<input type="radio" name="quest15" value="2" <?php if($testimonials_info['quest15']=='2') echo 'checked'; ?>/></div>
                                <div class="answer">3<input type="radio" name="quest15" value="3" <?php if($testimonials_info['quest15']=='3') echo 'checked'; ?>/></div>
                                <div class="answer">4<input type="radio" name="quest15" value="4" <?php if($testimonials_info['quest15']=='4') echo 'checked'; ?>/></div>
                                <div class="answer">5<input type="radio" name="quest15" value="5" <?php if($testimonials_info['quest15']=='5') echo 'checked'; ?>/></div>
                            </li>
                            <li>
                                <h2>Any other comments? Please detail any other areas that I haven’t mentioned that you think may be of use. Again, its all taken as constructive criticism so be as helpful as you can - It’s much appreciated.</h2>
                                <textarea cols="100" rows="15" name="comment" id="comments-testimonials"><?php if(isset($testimonials_info['comment']) and ($testimonials_info['comment']!='')) echo $testimonials_info['comment']; ?></textarea>
                            </li>
                        </div>
                            <li>
                                <br/><br/>
                                <div class="clearboth">
                                    <img class="floatleft margin1 big-arrow-left" src="<?php echo URL::base(); ?>images/testimonials/arrow-left-fill.png" width="30" onclick="slide1show()"/>
                                    <img class="floatleft margin2 big-arrow-right" src="<?php echo URL::base(); ?>images/testimonials/arrow-right-out.png" width="30" onclick="slide2show()"/>
                                </div><br/>
                                <div class="clearboth">
                                    <img id="small-arrow-left" class="floatleft margin4" src="<?php echo URL::base(); ?>images/testimonials/arrow-left-fill.png" width="15" onclick="slide1show()"/>
                                    <font id="num1" class="number-test" style="text-decoration: underline;" onclick="slide1show()">1</font>
                                    <img class="floatleft" src ="<?php echo URL::base(); ?>images/testimonials/book-number-test.png" width="13" />
                                    <font id="num2" class="number-test margin3" onclick="slide2show()">2</font>
                                    <img class="floatleft" src ="<?php echo URL::base(); ?>images/testimonials/book-number-test.png" width="13" />
                                    <img id="small-arrow-right" class="floatleft margin2" src="<?php echo URL::base(); ?>images/testimonials/arrow-right-out.png" width="15" onclick="slide2show()"/>
                                </div>
                                <div class="border-orange"></div>
                                <div class="result-testimonials">
                                    <br/><br/>If approved, press "Upload to Site" to complete. If approval is not granted, press download to "Complaints" folder.
                                    </p><br/><br/>
                                    <?php 
                                    if($testimonials_info['status']!= 'approved') { ?>
                                        <input type="button" name="" value="Upload to Site" class="testimonials-submit" style="width: 200px !important;" onClick="parent.location='<?php echo URL::base()."admin/testimonials/changestatus?status=approved&id=".$testimonials_info['id']; ?>'"/>
                                    <?php } 
                                    if($testimonials_info['status']!= 'complaint') { ?>
                                        <input type="button" name="" value="Complaint" class="testimonials-submit" onClick="parent.location='<?php echo URL::base()."admin/testimonials/changestatus?status=complaint&id=".$testimonials_info['id']; ?>'"/>
                                    <?php }?> 
                                </div><br/>
                                <h2 style="text-align: center; color: white !important;">Please ensure all testimonials are processed within 24-48 hours</h2>
                            </li>
                    </ul>

            </form>
        </div>

    </div>


</div>















