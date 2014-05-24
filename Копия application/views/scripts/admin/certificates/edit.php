<div class="inner-content">
    <div class="widget-content" align="center">

        <div class="category-toggle">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/certificates/edit/<?php echo $certificate->id; ?>"
                          method="POST" enctype="multipart/form-data">
                        <div class="widget-header">
                            <h5>Новый:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Описание:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="description"
                                           style="float: left;width: 100%;"
                                           value="<?php echo $certificate->description; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Выводить в блок:</label>

                                <div class="field" style="text-align: left;">
                                    <input type="checkbox" class="uniform" name="featured" <?php if(isset($certificate->featured)) {if($certificate->featured=='on') echo 'checked';} ?>/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Сертификат:</label>

                                <div class="field">
                                    <input type="file" name="image"/>
                                    <?php if ($certificate->image != '0') { ?>
                                        <img src="<?php echo $certificate->image; ?>" width="200"/>
                                    <?php } ?>
                                </div>
                            </div>
                            <br/>
                            <input type="submit" class="button button-blue small-button margintop18 marginleft128"
                                   value="Добавить">
                            <br/>
                            <br/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
