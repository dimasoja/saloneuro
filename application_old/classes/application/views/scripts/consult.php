<form action="/consult/new" id="response-form" method="POST">   
    <div class="resp">
        <h3>Консультация</h3>    
        <div class="input-name">
            <input type="text" id="response-name" name="name" placeholder="Имя">
            <div class="response-err-name error"></div>
        </div>
        <div class="input-email">
            <input type="text" id="response-email" name="email" placeholder="E-mail">
            <div class="response-err-email error"></div>
        </div>
        <div class="input-question">
            <textarea id="response-question" name="response" placeholder="Ваш вопрос..."></textarea>            
            <div class="response-err-question error"></div>
        </div>          
    </div><br/>
    <div class="order-submit">
        <input type="button" class="order-button" value="Отправить" onclick="doResponse()" style="margin-left:0px;">
    </div>
    <div class="clearboth">&nbsp;</div>
</form>
