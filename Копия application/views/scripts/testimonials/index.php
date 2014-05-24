<div id="inside-container-test">
    <!--containt area holder -->
    <div id="supplies-containt_area_holder">
        <div id="testimonials-content">
            <h1>Submit your Testimonial</h1>

            <font class="under_h1">Thank you for the time taken to fill in our testimonial!</font>
            <p class="fontsize17">
                We hope that we carried out your work to your absolute satisfaction. Please be as frank as possible, no offence taken if anything wasn't 
                a top score! Honestly! But if everything was perfect for you, then please let us know by filling in below. 
            </p>

        </div>
        <div id="testimonials-form"><br/><br/>
            <form id="testimonials-form-add" method="post" action="<?php echo URL::base(); ?>testimonials/add">
                <div class="require-services bordernone">
                    <ul class="buff">
                        <div id="slide1" style="display:block;">
                            <li>
                                <input id="name" type="text" title="First Name" name="name" value="<?php echo HTML::chars((isset($name)) ? $name : 'First Name') ?>" class="franchisee-name<?php if (isset($name_show_error)) echo $name_show_error; ?>" onfocus="if(this.value=='First Name'){this.value=''};" onblur="if(this.value==''){this.value='First Name'};" />
                                <?php if (isset($name_error) && '' != $name_error): ?>
                                    <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                                        <?php echo $name_error; ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                            <li>
                                <input id="surname" type="text" title="Last Name" name="surname" value="<?php echo HTML::chars((isset($surname)) ? $surname : 'Last Name') ?>" class="franchisee-name<?php if (isset($surname_show_error)) echo $surname_show_error; ?>" onfocus="if(this.value=='Last Name'){this.value=''};" onblur="if(this.value==''){this.value='Last Name'};" />
                                <?php if (isset($surname_error) && '' != $surname_error): ?>
                                    <div style="border: 1px solid red; margin: 5px; padding: 5px;">
                                        <?php echo $surname_error; ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                            <li>
                                <input id="email" type="text" title="E-mail" name="email" value="<?php echo HTML::chars((isset($email)) ? $email : 'E-mail') ?>" class="franchisee-name<?php if (isset($email_show_error)) echo $email_show_error; ?>" onfocus="if(this.value=='E-mail'){this.value=''};" onblur="if(this.value==''){this.value='E-mail'};" />
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
                                <div class="answer">1<input type="radio" name="quest1" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest1" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest1" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest1" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest1" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>How good was the timekeeping of our members of staff?</h2>
                                <div class="answer">1<input type="radio" name="quest2" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest2" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest2" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest2" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest2" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate the presentation of our workforce?</h2>
                                <div class="answer">1<input type="radio" name="quest3" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest3" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest3" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest3" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest3" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate the attitude of our workforce? </h2>
                                <div class="answer">1<input type="radio" name="quest4" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest4" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest4" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest4" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest4" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate your "first" impressions of our company, when we arrived to do the work?</h2>
                                <div class="answer">1<input type="radio" name="quest5" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest5" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest5" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest5" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest5" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>Overall, how professional did we look when we arrived and when doing the work?</h2>
                                <div class="answer">1<input type="radio" name="quest6" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest6" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest6" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest6" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest6" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate how friendly we are?</h2>
                                <div class="answer">1<input type="radio" name="quest7" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest7" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest7" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest7" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest7" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>How would you rate how helpful we are? </h2>
                                <div class="answer">1<input type="radio" name="quest8" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest8" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest8" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest8" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest8" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>Are we tidy? </h2>
                                <div class="answer">1<input type="radio" name="quest9" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest9" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest9" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest9" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest9" value="5"/></div>
                            </li>
                        </div>
                        <div id="slide2" style="display: none;">
                            <li>                     
                                <h2>Did we do what we said we would do? </h2>
                                <div class="answer">1<input type="radio" name="quest10" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest10" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest10" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest10" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest10" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>Did we do any more than you expected?</h2>
                                <div class="answer">1<input type="radio" name="quest11" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest11" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest11" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest11" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest11" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>How satisfied are you with the work we have carried out for you?</h2>
                                <div class="answer">1<input type="radio" name="quest12" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest12" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest12" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest12" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest12" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>Would you recommend us to your nearest & dearest family & friends?</h2>
                                <div class="answer">1<input type="radio" name="quest13" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest13" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest13" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest13" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest13" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>Would you recommend us to your acquaintances?</h2>
                                <div class="answer">1<input type="radio" name="quest14" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest14" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest14" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest14" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest14" value="5"/></div>
                            </li>
                            <li>                     
                                <h2>Overall, how professional did we look when we were finishing or finished the work?</h2>
                                <div class="answer">1<input type="radio" name="quest15" value="1"/></div>
                                <div class="answer">2<input type="radio" name="quest15" value="2"/></div>
                                <div class="answer">3<input type="radio" name="quest15" value="3"/></div>
                                <div class="answer">4<input type="radio" name="quest15" value="4"/></div>
                                <div class="answer">5<input type="radio" name="quest15" value="5"/></div>
                            </li>
                            <li>
                                <h2>Any other comments? Please detail any other areas that I haven’t mentioned that you think may be of use. Again, its all taken as constructive criticism so be as helpful as you can - It’s much appreciated.</h2>
                                <textarea cols="100" rows="15" name="comment" id="comments-testimonials"></textarea>
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
                                    <br/><br/>Once you completed the questions, Please press "Submit" below
                                    </p><br/><br/>
                                    <input type="button" name="" value="Submit" class="testimonials-submit" onClick="checkTestimonials()" />
                                </div>
                            </li>
                    </ul>

            </form>
        </div>

    </div>
    <div class="appreciate">
        We greatly appreciate the time you've taken to do this and as a thank you all submitting a testimonial receive 
        a free gift. Thanks
    </div>
    <div class="notes">
        Please Note: The purpose of this is for Customer Awareness, Training and Marketing purpose only. None of your personal 
        details will be disclosed to our staff or will be viewable on our website. Your submitted testimonial cat take
        upto 72 working hours before it is viewable on our website.
    </div>
    <div id="supplies-bottom-logo">
        <ul>
            <li><img src="<?php echo URL::base(); ?>images/lagler-img.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/bona-img.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/blanchon-img.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/dewalt-img.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/dewalt-img1.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/dewalt-img2.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/ball-img.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/morrells-img.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/mirka-img.jpg" alt="" /></li>
            <li><img src="<?php echo URL::base(); ?>images/3m-img.jpg" alt="" /></li>
        </ul>
    </div>
</div>
<!--End containt area holder -->
</div>
