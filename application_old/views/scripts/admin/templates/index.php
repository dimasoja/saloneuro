<?php if ($success != '') { ?>
    <div class="alert alert-info noMargin bs-callout bs-callout-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $success; ?>
    </div>
<?php } ?>
<?php if ($error != '') { ?>
    <div class="alert alert-info noMargin bs-callout bs-callout-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $error; ?>
    </div>
<?php } ?>

<div class="table-container">
        <table cellpading="0" cellspacing="0" border="0" class="default-table blue">
            <thead>
                <tr align="left">
                    <th width="50">Description</th>
                    <th>Template</th>
                    <th>Edit</th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($templates as $template) { ?>
                    <tr>
                        <td width='20%'><?php echo $template->description; ?></td>
                        <td><?php echo $template->template; ?></td>
                        <td><input href="/admin/templates/edit/<?php echo $template->id; ?>" class="button button-turquoise " value="Редактировать" onclick="window.location='/admin/templates/edit/<?php echo $template->id; ?>'"></td>
                    </tr>                                    
                <?php } ?>
            </tbody>
        </table> 
    </div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.bs-callout.bs-callout-info, .bs-callout.bs-callout-danger').fadeOut(10000);
    });
</script>


