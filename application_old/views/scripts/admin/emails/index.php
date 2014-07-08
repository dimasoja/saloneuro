<?php 
   echo ViewMessage::renderMessages();
?>
<h1>E-mail Templates</h1>
<select id="templates" onchange="editTemplate(this)">
    <option value="0">Please, select template...</option>
    <?php if (!empty($email_templates)): ?>
    <?php foreach ($email_templates as $email_template): ?>
        <option value="<?php echo $email_template->id_template; ?>"<?php if (isset($uid) && $uid == $email_template->id_template) echo " selected=\"selected\""; ?>><?php echo $email_template->template_name; ?></option>
    <?php endforeach; ?>
    <?php endif; ?>
</select>
<p>&nbsp;</p>
<h2>Add new template</h2>
<form method="post" action="<?php echo URL::base(); ?>admin/emails<?php if (isset($uid)) echo '/index/' . $uid; ?>" enctype="multipart/form-data">
<table cellpadding="0" cellspacing="0" class="edit-user">
    <tr>
        <td width="150">Template Name:</td>
        <td><input type="text" name="template_name" value="<?php echo $et->template_name; ?>" style="width: 300px;" /></td>
    </tr>
    <tr>
        <td width="150">Subject:</td>
        <td><input type="text" name="subject" value="<?php echo $et->subject; ?>" style="width: 300px;" /></td>
    </tr>
    <tr>
        <td valign="top">Message:</td>
        <td>
            <p>You could use the following statements (if allowed by a template), which would be interpreted into their real values at client side:</p>
            <ul style="margin-bottom: 20px;">
                <li><strong>::name::</strong> - Name;</li>
                <li><strong>::email::</strong> - E-mail;</li>
                <li><strong>::date::</strong> - Current date;</li>
                <li><strong>::address::</strong> - Address (incl. town and postcode);</li>
                <li><strong>::phone::</strong> - Landline phone;</li>
                <li><strong>::mobile::</strong> - Mobile phone;</li>
            </ul>
            <textarea id="mess" name="message"><?php echo $et->message; ?></textarea>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="submit" value="Save" class="submit" />
            <?php if (isset($uid)): ?>
            <input type="button" class="submit" value="Delete" onclick="deleteTemplate(<?php echo $uid; ?>)" />
            <?php endif; ?>
        </td>
    </tr>
</table>
</form>
<p>&nbsp;</p>
<div class="clear"></div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        var editor = CKEDITOR.replace('mess',
        {
            uiColor : 'orange',
            language: 'en'
        });
         CKFinder.setupCKEditor( editor, '/js/ckeditor/ckfinder/' );
    });
    
    function editTemplate(obj) {
        var id = obj.value;
        
        location.href = baseurl + 'admin/emails/index/' + id;
    }
    
    function deleteTemplate(id) {
        if (confirm("Do you want to delete this template?")) {
            location.href = baseurl + 'admin/emails/delete/' + id;
        }
    }
</script>