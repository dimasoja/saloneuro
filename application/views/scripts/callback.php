<form action="/callback/new" id="callback-form" method="POST">   
    <div class="resp">
        <h3>Заказать обратный звонок</h3>
        <div class="input-name">
            <input type="text" id="response-name" name="name" placeholder="Имя">
            <div class="response-err-name error"></div>
        </div>
        <div class="input-phone">
            <input type="text" id="response-phone" name="phone" placeholder="Телефон">
            <div class="response-err-phone error"></div>
        </div>
       <!-- <div class="input-question">
            <textarea id="response-question" name="response" placeholder="Сообщение..."></textarea>            
            <div class="response-err-question error"></div>
        </div> -->
        <div class="choose-time">
            <font class="form-font">Выбрать время звонка:</font>
        </div>
        <div class="time-container-from">                  
            <font class="form-font">c</font> <input type="text" name="time_from" id="time_from" class="input-time" value="09:00" />       
            <font class="form-font">до</font> <input type="text" name="time_to" id="time_to" class="input-time" value="17:59" />       					
            <script type="text/javascript">
                jQuery('#time_from').timepicker({
                    hourMin: 9,
                    hourMax: 17                                        
                });    
                jQuery('#time_to').timepicker({
                    hourMin: 9,
                    hourMax: 17                                        
                });
            </script>
        </div>
    </div><br/>
    <div class="order-submit">
        <input type="button" class="order-button" value="Заказать звонок" onclick="doCallBack()" style="margin-left:0px">
    </div>

    <div class="clearboth">&nbsp;</div>
</form>
<script type="text/javascript">

jQuery("#response-phone").mask("(999) 999 99 99");


$("#response-phone").on("blur", function() {
    var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );
    
    if( last.length == 3 ) {
        var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
        var lastfour = move + last;
        
        var first = $(this).val().substr( 0, 9 );
        
        $(this).val( first + '-' + lastfour );
    }
});
</script>

