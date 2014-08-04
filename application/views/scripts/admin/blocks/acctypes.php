<div class="inner-content">
    <script type="text/javascript" src="/js/ckeditor/ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
    <div class="row-fluid">
        <div class="widget">
            <form class="form-horizontal" id='asdf' style="text-align:center;">
                <div class="widget-header">
                    <h5>HTML код:</h5>
                </div>
                <div class="widget-content no-padding">
                    <div class="form-row">


                        <div class="field" style="margin-left:0px !important">
                            <input type="text" class="span12 blinds" name="standard" id="standard"
                                   value="<?php echo $blinds; ?>">
                        </div>
                    </div>
                    <div class="form-row">


                        <div class="field" style="margin-left:0px !important">
                            <input type="text" class="span12 mixer" name="standard" id="standard"
                                   value="<?php echo $mixer; ?>">
                        </div>
                    </div>
                    <div class="form-row">


                        <div class="field" style="margin-left:0px !important">
                            <input type="text" class="span12 sink" name="standard" id="standard"
                                   value="<?php echo $sink; ?>">
                        </div>
                    </div>
                    <div class="form-row">


                        <div class="field" style="margin-left:0px !important">
                            <input type="text" class="span12 accessory" name="standard" id="standard"
                                   value="<?php echo $accessory; ?>">
                        </div>
                    </div>
                    <div class="form-row">


                        <div class="field" style="margin-left:0px !important">
                            <input type="text" class="span12 rod" name="standard" id="standard"
                                   value="<?php echo $rod; ?>">
                        </div>
                    </div>
                    <div class="form-row">


                        <div class="field" style="margin-left:0px !important">
                            <input type="text" class="span12 bede" name="standard" id="standard"
                                   value="<?php echo $bede; ?>">
                        </div>
                    </div>

                    <br/>
                    <a href="#" class=" tutu button button-turquoise small-button configuration-button"
                       style="width: 296px !important; box-shadow: 2px 2px 12px lightgrey !important;">Сохранить</a>
                    <br/><br/>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="">

    jQuery(document).ready(function () {
        jQuery('.tutu').click(function () {
            var blinds = jQuery('.blinds').val();
            var mixer = jQuery('.mixer').val();
            var sink = jQuery('.sink').val();
            var accessory = jQuery('.accessory').val();
            var rod = jQuery('.rod').val();
            var bede = jQuery('.bede').val();
            jQuery.post('/admin/index/saveacctypes', {blinds: blinds, mixer:mixer, sink:sink, accessory: accessory, rod: rod, bede: bede}, function (data) {
                jQuery('.alert.alert-info.noMargin font').html('Сохранено.');
                jQuery('.alert.alert-info.noMargin').css('display', 'block');
                jQuery('.alert.alert-info.noMargin').fadeOut(3000);
            });
        });


    });
</script>
</div>