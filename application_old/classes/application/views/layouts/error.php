<?php require_once('header.php'); ?>
<?php $city_geo = (array)$city; ?>
<?php $city_geo = $city[0]; ?>
<div class="geocity" style="display:none">
    <?php echo $session_city; ?>
</div>
<div class="darker-stripe blocks-spacer more-space latest-news with-shadows">
    <div class="bread-center">
        <?php echo $breadcrumbs; ?>
    </div>
</div>
<div class="with-borders">
    <div class="oncenter">

    </div>
</div>
<div class="common inner">
    <div class="container">
        <div class="push-up blocks-spacer">
            <div class="row">

                <!--  ==========  -->
                <!--  = Main content =  -->
                <!--  ==========  -->
                <section class="span12">

                    <p class="container-404">
                        <img src="/images/404.png" alt="404 Error" width="394" height="161" />
                    </p>

                    <hr />

                    <p class="center-align size-16">
                        Страница, которую вы читаете, не существует.
                    </p>

                </section> <!-- /main content -->
            </div>
        </div>
    </div> <!-- /container -->
</div>

<?php require_once 'footer_catalog.php'; ?>
