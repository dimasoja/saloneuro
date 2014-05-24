<br/><br/><!--div class="box">
    <div class="top"></div>
    <div class="inner no-header">
        <?php echo ViewMessage::renderMessages(); ?>
        <form method="post" action="">
            <div>
                <?php echo __("Login: "); ?><br />
                <input type="text" name="username" class="textinput<?php echo $username_show_error; ?>" value="<?php echo Html::chars("$username", false); ?>" />
                <?php if ('' != $username_error) { ?>
                    <div class="form_element_text_error width200"><?php echo __($username_error) ?></div>
                <?php } ?>
            </div>
            <div>
                <?php echo __("Password: "); ?><br />
                <input type="password" name="password" class="textinput<?php echo $username_show_error ?>" value="<?php echo Html::chars("$password", false) ?>" /><br />
                <?php if ('' != $password_error) { ?>
                    <div class="form_element_text_error width200"><?php echo __($password_error) ?></div>
                <?php } ?>
            </div>
            <input type="submit" name="ok" value="<?php echo __("Log In"); ?>" />
        </form>
    </div>
    <div class="bottom"></div>
</div-->
<div class="login-container">
    <div class="login animated fadeInDownBig">
        <div class="avatar animate4 bounceInDown">
            <img src="/images/user-image.png" alt="">
        </div>
        <form action="" method="post" id="login-form">
            <div class="error-login">Введите все данные!</div>
            <input type="text" name="username" class="login-input" value="<?php echo Html::chars("$username", false); ?>" placeholder="Введите логин" />
<!--            <input type="text" class="login-input" placeholder="Enter your username here...">-->
<!--            <input type="password" class="password-input" placeholder="Enter your password here...">-->
            <input type="password" class="password-input" placeholder="Введите пароль" name="password" value="<?php echo Html::chars("$password", false) ?>" />
            <div class="remember fLeft">
<!--                <label class="form-button">-->
<!--                    <div class="checker"><span><input type="checkbox"></span></div> Remember me-->
<!--                </label>-->
            </div>
<!--            <a href="index.html" class="loginbutton fRight button small-button button-red">Авторизация</a>-->
            <input type="submit" class="loginbutton fRight button small-button button-red" style="padding-left:0px !important" value="<?php echo __("Войти"); ?>" name="submit" class="submit" />
            <div class="clearfix"></div>
        </form>
    </div>

    <div class="login-footer animated fadeInLeftBig">
        <?php $message = ViewMessage::renderMessages(); ?>
        <?php if($message!='') { ?>
            <div class="error-login" style="margin-bottom:2px; display:block"><?php echo $message; ?></div>
        <?php } ?>
    </div>
    <span class="animated fadeInLeftBig">Авторское право © 2012 SalonEvro.Ru</span>
</div>
<div class="top"></div>

<!--<form action="" method="post" id="login-form">-->
<!--    <label>--><?php //echo __("Login: "); ?><!--</label>-->
<!--    <input type="text" name="username" value="--><?php //echo Html::chars("$username", false); ?><!--" />-->
<!--    <label>--><?php //echo __("Password: "); ?><!--</label>-->
<!--    <input type="password" name="password" value="--><?php //echo Html::chars("$password", false) ?><!--" />-->
<!--    <input type="submit" value="--><?php //echo __("Log In"); ?><!--" name="submit" class="submit" />-->
<!--</form>	-->