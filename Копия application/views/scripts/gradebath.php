<div class="main-steps">
    <div class="steps">
        <div class="step1 active step" rel="1">
            Шаг 1
        </div>
        <div class="step2 step" rel="2">
            Шаг 2
        </div>
        <div class="step3 step" rel="3">
            Шаг 3
        </div>
        <div class="step4 step" rel="4">
            Шаг 4
        </div>
    </div>
    <div class="progres">
        <div class="progres-col2">
            <div class="progres-summ">
                Сумма <span class="summ" data-price="18000">18 000</span> рублей
            </div>
            <input type="button" class="green floatright" value="Заказать">
        </div>
    </div>
</div>

<h2><?php if (isset($page_name)) {
        echo $page_name;
    } else {
        echo 'Комплектация ванны';
    } ?></h2>
<hr/>
<div id="step-container">
    <div class="step1-body">
        <h4>Шаг 1. Выберите модель и размер ванны</h4>
        <hr/>
        <div class="bath-image">
            <img src="/images/bath-featured.jpg"/>

            <div class="product-downloads">
                <!--                <a href="javascript:window.print()"><img src="/images/print.png"/></a>-->
                <a href="#" class="width32"><img src="/images/download.png"/></a>
                Схема монтажа
            </div>
            <div class="product-downloads">
                <!--                <a href="javascript:window.print()"><img src="/images/print.png"/></a>-->
                <a href="#" class="width32"><img src="/images/download.png"/></a>
                Инструкция по эксплуатации
            </div>
        </div>
        <div class="bath-step1-info">
            <div class="aligncenter">
                <h5>Размеры ванны</h5>
            </div>
            <div class="main-sizes">
                <div class="sizes">
                    Ширина
                    <label style="text-align:left;">
                        <select class="width">
                            <option value=""></option>
                            <?php foreach ($widths as $width_tut) { ?>
                                <option
                                    value="<?php echo $width_tut->width; ?>"><?php echo $width_tut->width; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                </div>
                <div class="sizes">
                    Длина
                    <label style="text-align:left;">

                        <select class="height">
                            <option value=""></option>

                        </select>
                    </label>
                </div>
            </div>
            <div class="corner">
                <h5>Угол размещения</h5>

                <div class="corner-change">
                    <select class="corner-select">
                        <option value="left">Левый угол</option>
                        <option value="left">Правый угол</option>
                    </select>
                </div>
            </div>
            <div class="grade-step1">
                <h5>В комплектацию входит</h5>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked disabled/> Модель Ванны
                    </label>
                    <span class="price-grade">16 000</span> руб.
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked disabled/> Рама-каркас
                    </label>
                    <span class="price-grade">2 000</span> руб.
                </div>
            </div>
            <input class="big-button step1-button step-button" rel="1" value="Далее"/>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('.width').change(function () {
                    var value = jQuery(this).val();
                    jQuery.post('/index/getsizes', {value: value}, function (response) {
                        var heights = jQuery.parseJSON(response);
                        jQuery('.height').html('<option value=""></option>');
                        jQuery.each(heights, function (index, key) {
                            jQuery('.height').append('<option value="' + key + '">' + key + '</option>');
                        });
                    });
                });
            });
        </script>
    </div>


    <div class="step2-body" style="display:none">
        <h4>Шаг 2. Выберите комплектацию к ней</h4>
        <hr/>
        <div class="bath-image">
            <img src="/images/step2.jpg"/>
        </div>
        <div class="bath-step1-info">
            <div class="checkbox">
                <label>
                    <input type="checkbox"/> Фронтальная
                </label>
                <span class="price-grade">6 000</span> руб.
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"/> Боковая правая панель
                </label>
                <span class="price-grade">6 000</span> руб.
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"/> Боковая левая панель
                </label>
                <span class="price-grade">6 000</span> руб.
            </div>
            <input class="big-button step2-button step-button" rel="2" value="Далее"/>
        </div>
    </div>
    <div class="step3-body" style="display:none">
        <h4>Шаг 3. Массажные опции</h4>
        <hr/>
        <div class="bath-image">
            <img src="/images/step3.jpg"/>
        </div>
        <div class="bath-step1-info">
            <div class="checkbox">
                <label>
                    <input type="checkbox"/> Гидромассаж
                </label>
                <span class="price-grade">2 000</span> руб.
            </div>
            <div class="checkbox inner-option">
                <label>
                    <input type="checkbox"/> Массаж спины
                </label>
                <span class="price-grade">2 000</span> руб.
            </div>
            <div class="checkbox inner-option">
                <label>
                    <input type="checkbox"/> Массаж ног
                </label>
                <span class="price-grade">2 000</span> руб.
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"/> Аэромассаж
                </label>
                <span class="price-grade">2 000</span> руб.
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"/> Хомотерапия
                </label>
                <span class="price-grade">2 000</span> руб.
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"/> Электронное управление
                </label>
                <span class="price-grade">2 000</span> руб.
            </div>
            <input class="big-button step3-button step-button" rel="3" value="Далее"/>
        </div>
    </div>
    <div class="step4-body" style="display:none">
        <h4>Шаг 4. Аксессуары к ванне</h4>
        <hr/>
        <div class="bath-image">
            <img src="/images/step4.jpg"/>
        </div>
        <div class="bath-step1-info">
            <h5>Категории</h5>

            <div class="inner-categories">
                <div class="checkbox">
                    <label>
                        Гидромассаж
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        Аэромассаж
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        Хомотерапия
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        Электронное управление
                    </label>
                </div>
            </div>
        </div>
        <input class="big-button step4-button" value="Оформить заказ"/>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.step-button').click(function () {
            var num = jQuery(this).attr('rel');
            var next = parseInt(num) + 1;
            jQuery('.step' + num + '-body').fadeOut();
            jQuery('.step' + next + '-body').fadeIn();
            jQuery('.steps .step').removeClass('active');
            jQuery('.step' + next).addClass('active');
        });
        jQuery('.step').click(function () {
            var num = jQuery(this).attr('rel');
            var prev = jQuery('.step.active').attr('rel');
            jQuery('.step' + prev + '-body').fadeOut();
            jQuery('.step' + num + '-body').fadeIn();
            jQuery('.steps .step').removeClass('active');
            jQuery('.step' + num).addClass('active');
        });
    });
</script>

