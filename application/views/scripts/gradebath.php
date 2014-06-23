<input type="hidden" value="<?php echo $this_product_id; ?>" id="current_product"/>
<div id="steps-container">

</div>
<script type="text/template" id="steps">
    <div class="main-steps">
        <div class="steps">
            <a href="<%= steps.step1 %>" <% if(steps.step1=='') { %> onclick="return false;" <% } %>>
                <div class="step1 <% if(hash=='1') { %> active <% } %> step" rel="1">
                    Шаг 1
                </div>
            </a>
            <a href="<%= steps.step2 %>" <% if(steps.step2=='') { %> onclick="return false;" <% } %>>
                <div class="step2 <% if(hash=='2') { %> active <% } %> step" rel="2">
                    Шаг 2
                </div>
            </a>
            <a href="<%= steps.step3 %>" <% if(steps.step3=='') { %> onclick="return false;" <% } %>>
                <div class="step3 <% if(hash=='3') { %> active <% } %> step" rel="3">
                    Шаг 3
                </div>
            </a>
            <a href="<%= steps.step4 %>" <% if(steps.step4=='') { %> onclick="return false;" <% } %>>
                <div class="step4 <% if(hash=='4') { %> active <% } %> step" rel="4">
                    Шаг 4
                </div>
            </a>
        </div>
    </div>
</script>


<div id="step-container">

<div class="step1-body bodystep">
    <div id="step1-container">

    </div>
    <script type="text/template" id="step1">
        <div class="progres">
            <div class="progres-col2">
                <div class="progres-summ">
                    Сумма <span class="summ" data-price="<%= product.price %>"><%= product.pricehtml %></span> рублей
                </div>
                <input type="button" class="green floatright" value="Заказать">
            </div>
        </div>
        <h2>Комплектация ванны</h2>
        <hr/>
        <h4>Шаг 1. Выберите модель и размер ванны <br/>(<%= product.name %>)</h4>
        <hr/>
        <input type="hidden" id="current_product" value="<%= product.id %>"/>
        <div class="bath-image">
            <img src="<%= product.image %>"/>

            <a href="/gradebath#!/step1/<%= product.leftProduct %>">
                <div id="sliderRevLeft"><i class="icon-chevron-left"></i></div>
            </a>
            <a href="/gradebath#!/step1/<%= product.rightProduct %>">
                <div id="sliderRevRight"><i class="icon-chevron-right"></i></div>
            </a>

            <div class="product-downloads">
                <a href="<%= product.scheme %>" class="width32"><img src="/images/download.png"/></a>
                Схема монтажа
            </div>
            <div class="product-downloads">
                <a href="<%= product.instruction %>" class="width32"><img src="/images/download.png"/></a>
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
                        <select class="width" disabled>
                            <option value="<%= product.width %>"><%= product.width %></option>
                        </select>
                    </label>
                </div>
                <div class="sizes">
                    Длина
                    <label style="text-align:left;">
                        <select class="height" disabled>
                            <option value="<%= product.length %>"><%= product.length %></option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="corner">
                <h5>Угол размещения</h5>

                <div class="corner-change">
                    <select class="corner-select">
                        <option value="right">Правый угол</option>
                        <option value="left">Левый угол</option>
                    </select>
                </div>
            </div>
            <div class="grade-step1">
                <h5>В комплектацию входит</h5>
                    <% _.each(product.othergrades, function (grade) { %>


                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked disabled/> <%= grade.name %>
                                    </label>
                    <span class="price-grade"><%= grade.price %></span> руб.
                </div>


                                                    <% }); %>


                            </div>
            <div class="nextstep">
                <a href="#!/step2">
                    <input class="big-button step1-button1 step-button" rel="1" value="Далее"/>
                </a>
            </div>
        </div>
    </script>
</div>


<div class="step2-body bodystep" style="display:none">
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
        <a href="#!/step3">
            <input class="big-button step2-button step-button" rel="2" value="Далее"/>
        </a>
    </div>
</div>
<div class="step3-body bodystep" style="display:none">
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
        <a href="#!/step4">
            <input class="big-button step3-button step-button" rel="3" value="Далее"/>
        </a>
    </div>
</div>
<div class="step4-body bodystep" style="display:none">
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
    var Controller = Backbone.Router.extend({
        routes: {
            "": "start",
            "!/step:hash/:productid": "switchProduct",
            "!/step:hash": "stepRoute"
        },
        start: function () {
            if (Steps != null) {
                Steps.render('1');
            }
            if (Step1 != null) {
                Step1.render();
            }

        },
        switchProduct: function (hash, productid) {
            Step1.reRender(productid);
        },
        stepRoute: function (hash) {
            if (Steps != null) {
                Steps.render(hash);
            }
            if (Step1 != null) {
                Step1.render();
            }
        }
    });

    var Product = Backbone.Model.extend({urlRoot: "/index/getproduct"});
    var getSteps = Backbone.Model.extend({urlRoot: "/index/getsteps"});

    var Steps = Backbone.View.extend({
        el: $("#steps-container"),
        template: _.template($('#steps').html()),
        render: function (hash) {
            var model = new getSteps({id: hash});
            var that = this;
            model.fetch({
                success: function (response) {
                    if(response.attributes.result=='success') {
                        $(that.el).html(that.template({ steps: response.attributes.steps, hash: hash}));
                        var prev = $('.step.active').attr('rel');
                        $('.bodystep').fadeOut();
                        $('.step' + hash + '-body').fadeIn();
                    } else {
                        $('.bodystep').fadeOut();
                    }
                }
            });

        }
    });

    var Step1 = Backbone.View.extend({
        el: $("#step1-container"),
        current_id: $('#current_product'),
        events: {
            "change select.corner-select": "changeCorner"
        },
        template: _.template($('#step1').html()),
        render: function () {
            var current_id = $(this.current_id).val();
            var model = new Product({id: current_id});
            var that = this;
            model.fetch({
                success: function (response) {
                    $(that.el).html(that.template({ product: response.attributes}));
                }
            });

        },
        changeCorner: function (e) {
            var elem = $(e.target);
            var image = $(this.el).find('.bath-image img');
            var value = elem.val();
            if (value == 'left') {
                image.addClass('reflection');
            } else {
                image.removeClass('reflection');
            }
        },
        reRender: function (param) {
            var model = new Product({id: param});
            var that = this;
            model.fetch({
                success: function (response) {
                    $(that.el).html(that.template({ product: response.attributes}));
                }
            });
        }
    });
    var Steps = new Steps();
    var Step1 = new Step1();

    var controller = new Controller(); // Создаём контроллер
    Backbone.history.start();
</script>

