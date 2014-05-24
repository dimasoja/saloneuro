<div>
<textarea class="form-control" style="width:100%; height:40%"><?php echo $value; ?></textarea><br/><br/>
    <a href="#" onclick="saveConf()" class="button button-turquoise small-button configuration-button"
       style="width: 296px !important; box-shadow: 2px 2px 12px lightgrey !important;">Сохранить</a>
</div>
<script type="text/javascript">
    function saveConf() {
        value = jQuery('.form-control').val();
        jQuery.post('/admin/css/savevalue', {value:value}, function(response){
            jQuery('.alert.alert-info.noMargin font').html('Новые стили сохранены');
            jQuery('.alert.alert-info.noMargin').css('display', 'block');
            jQuery('.alert.alert-info.noMargin').fadeOut(3000);
        });
    }
</script>