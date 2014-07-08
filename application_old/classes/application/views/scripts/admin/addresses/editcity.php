<div class="inner-content">
    <div class="widget-content" align="center">

        <div class="category-toggle" style="overflow:auto">
            <div class="span4" style="float: none !important; width:100%; margin-left:0px ">
                <div class="widget">
                    <form class="form-horizontal" action="/admin/addresses/editcity/<?php echo $addresses->id; ?>" method="POST">
                        <div class="widget-header">
                            <h5>Редактировать:</h5>
                        </div>
                        <div class="widget-content no-padding">
                            <div class="form-row">
                                <label class="field-name" for="standard">Город:</label>

                                <div class="field">
                                    <div class="field" style="text-align:left;margin-left:0%;">
                                        <?php $cities = ORM::factory('addresses')->group_by('city')->find_all()->as_array(); ?>
                                        <select name="city" class="uniform">
                                            <?php foreach ($cities as $city) { ?>
                                                <option value="<?php echo $city->city; ?>" <?php if($addresses->city==$city->city) { echo 'selected'; } ?>><?php echo $city->city; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
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
