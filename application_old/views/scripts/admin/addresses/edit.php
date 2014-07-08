<div class="inner-content">
    <div class="widget-content" align="center">

        <div class="category-toggle" style="overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/addresses/edit/<?php echo $addresses->id; ?>" method="POST">
                        <div class="widget-header">
                            <h5>Редактировать:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Город:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="city"
                                           style="float: left;width: 100%;" value="<?php if(isset($addresses->city)) echo $addresses->city; ?>"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Адрес:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="address"
                                           style="float: left;width: 100%;" value="<?php if(isset($addresses->address)) echo $addresses->address; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Телефон:</label>

                                <div class="field">
                                    <input type="text" class="input-large name-edit" name="phone"
                                           style="float: left;width: 100%;" value="<?php if(isset($addresses->phone)) echo $addresses->phone; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="field-name" for="standard">Яндекс карты (<a target="_blank" href="http://api.yandex.ru/maps/tools/constructor/">Generator</a>)</label>
                                <div class="field">
                                    <input type="text" class="span12 map_code" name="map" id="standard" value='<?php if(isset($addresses->map)) echo $addresses->map; ?>'>
                                </div>
                            </div>
                            <br/>
                            <input type="submit" class="button button-blue small-button margintop18 marginleft128"
                                   value="Редактировать">
                            <br/>
                            <br/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
