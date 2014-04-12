<div class="zabor-bottom">&nbsp;</div>
<div class="footer">
    <div class="header-center-romb">
        <div class="footer-col1">
            <div class="found-us">Найти нас</div>
            <div class="map-contacts">
                <a href="#yandex-map" class='fancybox-map'>
                    <div class="mc-1">
                        <div class="mc-1-image"></div>
                        <div class="map" onclick='getFancyMap()'>Карта</div>
                        </a>
            </div>
            <div class="mc-2">
                <a href="http://kod-rostov.ru/contacts">
                    <div class="mc-2-image"></div>
                    <div class="map">Контакты</div>
                </a>
            </div>
        </div>
    </div>
    <div class="razdelitel">&nbsp;</div>
    <div class="footer-col2">
        <div class="contact-with-me">
            Связаться с нами
        </div>  
        <div class="footer-form">
            <div class="ff1">
                <div class="input-name">
                    <input type="text" id="footer-name" placeholder="Имя"/>
                    <div class="err-name error"></div>
                </div>
                <div class="input-email">
                    <input type="text" id="footer-email" placeholder="E-mail"/>
                    <div class="err-email error"></div>
                </div>
            </div>
            <div class="ff2">
                <div class="input-question">
                    <textarea id="footer-question" name="footer-question" placeholder="Ваш вопрос..."></textarea>
                    <div class="err-question error"></div>
                </div>
            </div>
            <div class="ff3" onclick="sendFooterData()">
                <div class="reload">
                    <div class="reload-button">&nbsp;</div>
                </div>
                <div class="submit-reload">
                    Отправить
                </div>
            </div>
        </div>
        <div class="QapTcha"></div>
        <div class="response"></div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            // Simple call
            //jQuery('.QapTcha').QapTcha();
    
            // More complex call
            jQuery('.QapTcha').QapTcha({
                autoSubmit : false,
                autoRevert : true,
                PHPfile : '/captcha'
            });
            jQuery('.fancybox-map').fancybox();
        });        
        function getFancyMap() {
	//  jQuery.fancybox(jQuery('.yandex-map').html());
        }
    </script>
    <div class="razdelitel">&nbsp;</div>
    <div class="footer-col3">
        <div class="we-with-you">
            Мы с вами
        </div>
        <div class="social-icons">
            <div class="vk">
                <a href="http://vk.com/oookod" target="_blank"><img src="/images/vk.png"/></a>
            </div>
            <div class="face">
                <a href="https://www.facebook.com/kodrostov"  target="_blank"><img src="/images/face.png"/></a>
            </div>
            <div class="twitter">
                <a href="https://twitter.com/kodrostov" target="_blank"><img src="/images/twitter.png"/></a>
            </div>
        </div>
    </div>
    <div class="copyright-footer"><?php echo ORM::factory('settings')->getSetting('copyright'); ?></div>                          
</div>


</div>                        
</div><div class="zabor-footer"></div>
<!--End Navigation Block -->

<div style='display:none'>
  <div id='yandex-map'>
<!--     <script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=J1nDSVVzZzTY3UvFm902SYMJcJzZ0rLE&width=600&height=450"></script> -->
<?php echo ORM::factory('settings')->getSetting('map_code'); ?>
  </div>
</div>  
<?php echo ORM::factory('settings')->getSetting('yandex_metrika'); ?>
<?php echo ORM::factory('settings')->getSetting('goole_analytics'); ?>
</body>
</html>
