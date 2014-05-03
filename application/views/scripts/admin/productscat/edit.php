<div class="inner-content">
    <div class="widget-content" align="center">

        <div class="category-toggle">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/productscat/edit/<?php echo $productscat->id; ?>"
                          method="POST" enctype="multipart/form-data">
                        <div class="widget-header">
                            <h5>Новый:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Наименование:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="name"
                                           style="float: left;width: 100%;" value="<?php echo $productscat->name; ?>"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Title (мета тэг):</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="title_meta" style="float: left;width: 100%;" value="<?php echo $productscat->title; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Keywords (мета тэг):</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="keywords" style="float: left;width: 100%;" value="<?php echo $productscat->keywords; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Description (мета тэг):</label>
                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="description" style="float: left;width: 100%;" value="<?php echo $productscat->description; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Выводить массажные опции:</label>

                                <div class="field" style="text-align: left;">
                                    <input type="checkbox" name="massage_on"
                                           class="uniform" <?php if ($productscat->massage_on == 'on') {
                                        echo 'checked';
                                    } ?>/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Выводить комплектацию:</label>

                                <div class="field" style="text-align: left;">
                                    <input type="checkbox" name="grade_on"
                                           class="uniform" <?php if ($productscat->grade_on == 'on') {
                                        echo 'checked';
                                    } ?>/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Изображение категории:</label>

                                <div class="field">
                                    <input type="file" name="image"/>
                                    <?php if ($productscat->image != '') { ?>
                                        <img src="<?php echo $productscat->image; ?>" width="200"/>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Порядок:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="order"
                                           style="float: left;width: 100%;" value="<?php echo $productscat->order; ?>">
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
