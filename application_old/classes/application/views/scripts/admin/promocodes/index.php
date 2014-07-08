<br/><br/><br/><div style="width: 900px; float: left;"><h1>Promocodes</h1></div><br/><br/><br/>
<div class="promo-wrapper">
    <div class="col-1">
        <div class="users-table" >
            <table>
                <tr> 
                    <td></td><td>Code</td><td>Sale</td>
                </tr>
                <?php foreach ($promocodes as $code) { ?>
                    <tr id="line_<?php echo $code->id; ?>">
                        <td><input type="checkbox" class="code_check" id="<?php echo $code->id; ?>"</td>
                        <td><?php echo $code->code; ?></td>
                        <td><?php echo $code->sale; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <br/>
            <input type="button" onclick="deleteCodes()" class="submit" value="DELETE">
        </div>
    </div>
    <div class="col-2">
        <h2>Add promocode</h2>
        <form action="/admin/promocodes/addpromo" id="promo-form" type="POST">
        <input id="code" type="text" name="code" value="Promocode" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Promocode'){this.value=''};" onblur="if(this.value==''){this.value='Promocode'};" />
        <input id="sale" type="text" name="sale" value="Sale" class="franchisee-name-small franchisee-name" onfocus="if(this.value=='Sale'){this.value=''};" onblur="if(this.value==''){this.value='Sale'};" style="width: 33px;" maxlength="2" min="0" max="99"  onkeyup="this.value=this.value.replace(/[^\d]/,'')"/>
        <div class="percent-wrapper"><font class="percent">%</font></div>
        <input class="submit promo-button-add" type="button" value="ADD" onClick="sendPromo()"/>
        </form>
    </div>
</div>
