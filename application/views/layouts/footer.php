<div class="container">
    <div class="row featured-items blocks-spacer">
        <div class="span12">
            <div class="main-titles">
                <div class="arrows">
                    <a href="#" class="icon-chevron-left" id="featuredItemsLeft"></a>
                    <a href="#" class="icon-chevron-right" id="featuredItemsRight"></a>
                </div>
            </div>
        </div>

        <?php echo ORM::factory('settings')->getSetting('benefits'); ?>
        </div>

</div>
<div class="darker-stripe blocks-spacer more-space latest-news with-shadows">
    <br/>
    <div class="container">
        <div class="footer-block1">
            <div class="inner-footer-block1">
                <a href="#">О компании</a><br/>
                <a href="#">Сотрудничество</a><br/>
                <a href="#">Частным лицам</a><br/>
                <a href="#">Полезная информация</a><br/>
                <a href="#">Контакты</a>
            </div>
        </div>
        <div class="footer-block2">
            <div class="inner-footer-block1">
                <a href="#">Продукция</a><br/>
                <a href="#">Наши сертификаты</a><br/>
                <a href="#">Новости и акции</a><br/>
                <a href="#">Интернет магазин производителя</a><br/>
                <a href="#">Политика безопасности</a>
            </div>
        </div>
        <div class="footer-block3">
            <div class="inner-footer-block1">
                <a href="#">Заказать обратный звонок</a><br/>
                <a href="#">Онлайн-консультант</a><br/>
                <a href="#">Форма обратной связи</a><br/>
            </div>
        </div>
        <div class="footer-block4">
            <div class="social">
                <a href="#">
                    <img src="/images/webmarket/twitter.png"/>
                </a>
                <a href="#">
                    <img src="/images/webmarket/facebook.png"/>
                </a>
                <a href="#">
                    <img src="/images/webmarket/vkontakte.png"/>
                </a>
                <a href="#">
                    <img src="/images/webmarket/odnoklassniki.png"/>
                </a>

            </div>
        </div>
    </div>
</div>
<!-- /latest news -->


<!--  ==========  -->
<!--  = Footer =  -->
<!--  ==========  -->
<footer>
    <div class="foot-last">
        <a href="#" id="toTheTop">
            <span class="icon-chevron-up"></span>
        </a>
        <div class="container">
            <div class="row">
                <div class="span6">
                    &copy; Все права защищены. Thermolux
                </div>
                <div class="span6">
                    <!--                    <div class="pull-right">Webmarket HTML Template by <a href="http://www.proteusthemes.com">ProteusThemes</a>-->
                    <!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /footer -->


<!--  ==========  -->
<!--  = Modal Windows =  -->
<!--  ==========  -->

<!--  = Login =  -->
<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="loginModalLabel"><span class="light">Login</span> To Webmarket</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="#">
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputEmail">Username</label>

                <div class="controls">
                    <input type="text" class="input-block-level" id="inputEmail" placeholder="Username" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputPassword">Password</label>

                <div class="controls">
                    <input type="password" class="input-block-level" id="inputPassword" placeholder="Password" required>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox">
                        Remember me
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary input-block-level bold higher">
                SIGN IN
            </button>
        </form>
        <p class="center-align push-down-0">
            <a data-toggle="modal" role="button" href="#forgotPassModal" data-dismiss="modal">Forgot your password?</a>
        </p>
    </div>
</div>

<!--  = Register =  -->
<div id="registerModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="registerModalLabel"><span class="light">Register</span> To Webmarket</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="#">
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputUsernameRegister">Username</label>

                <div class="controls">
                    <input type="text" class="input-block-level" id="inputUsernameRegister" placeholder="Username"
                           required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputEmailRegister">Email</label>

                <div class="controls">
                    <input type="email" class="input-block-level" id="inputEmailRegister" placeholder="Email" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputPasswordRegister">Password</label>

                <div class="controls">
                    <input type="password" class="input-block-level" id="inputPasswordRegister" placeholder="Password"
                           required>
                </div>
            </div>
            <button type="submit" class="btn btn-danger input-block-level bold higher">
                REGISTER
            </button>
        </form>
        <p class="center-align push-down-0">
            <a data-toggle="modal" role="button" href="#loginModal" data-dismiss="modal">Already Registered?</a>
        </p>

    </div>
</div>

<!--  = Forgot your password =  -->
<div id="forgotPassModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="forgotPassModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="forgotPassModalLabel"><span class="light">Forgot</span> your password?</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="#">
            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputUsernameRegister">Username</label>

                <div class="controls">
                    <input type="text" class="input-block-level" id="inputUsernameRegister" placeholder="Username">
                </div>
            </div>
            <p class="center-align">OR</p>

            <div class="control-group">
                <label class="control-label hidden shown-ie8" for="inputEmailRegister">Email</label>

                <div class="controls">
                    <input type="email" class="input-block-level" id="inputEmailRegister" placeholder="Email">
                </div>
            </div>
            <button type="submit" class="btn btn-primary input-block-level bold higher">
                SEND ME A NEW PASSWORD
            </button>
        </form>
    </div>
</div>

</div>
<!-- end of master-wrapper -->


<!--  ==========  -->
<!--  = JavaScript =  -->
<!--  ==========  -->

<!--  = FB =  -->

<div id="fb-root"></div>
<!--<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=126780447403102";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->


<!--  = jQuery - CDN with local fallback =  -->


<!--  = _ =  -->
<script>
    (function () {
        var widget_id = 699344;
        _shcp = [
            {widget_id: widget_id}
        ];
        var lang = (navigator.language || navigator.systemLanguage
            || navigator.userLanguage || "en")
            .substr(0, 2).toLowerCase();
        var url = "widget.siteheart.com/widget/sh/" + widget_id + "/" + lang + "/widget.js";
        var hcc = document.createElement("script");
        hcc.type = "text/javascript";
        hcc.async = true;
        hcc.src = ("https:" == document.location.protocol ? "https" : "http")
            + "://" + url;
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hcc, s.nextSibling);
    })();
</script>

</body>
</html>