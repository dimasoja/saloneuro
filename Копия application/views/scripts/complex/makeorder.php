<form action="/complex/new" id="response-form" method="POST">   
    <div class="resp">
        <h3>Заказать комплексную услугу "<?php echo $product->name; ?>"</h3>    
        <div class="input-name">
            <input type="text" id="response-name" name="name" placeholder="Имя">
            <div class="response-err-name error"></div>
        </div>
        <div class="input-email">
            <input type="text" id="response-email" name="email" placeholder="E-mail">
            <div class="response-err-email error"></div>
        </div>
        <div class="input-question">
            <textarea id="response-question" name="response" placeholder="Комментарий..."></textarea>            
            <div class="response-err-question error"></div>
        </div>          
    </div><br/>
    <div class="order-submit">
    <input type="hidden" id="product" name="product" value="<?php echo $product->id; ?>"/>
        <input type="button" class="order-button" value="Заказать" onclick="makeComplex()" style="margin-left:0px;">
    </div>
    <div class="clearboth">&nbsp;</div>
</form>
