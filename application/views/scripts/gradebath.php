<input type="hidden" value="<?php echo $this_product_id; ?>" id="current_product"/>
<div id="steps-container">

</div>
<script type="text/template" id="steps">
    <div class="main-steps">
        <div class="steps">
            <a href="<%= steps.step1 %>" <% if(steps.step1=='') { %>           onclick="return false;" <% } %>>
                <div class="step1 <% if(hash=='1') { %> active <% } %> step" rel="1">
                    Шаг 1
                </div>
            </a>
            <a href="<%= steps.step2 %>" <% if(steps.step2=='') { %>           onclick="return false;" <% } %>>
                <div class="step2 <% if(hash=='2') { %> active <% } %> step" rel="2">
                    Шаг 2
                </div>
            </a>
            <a href="<%= steps.step3 %>" <% if(steps.step3=='') { %>           onclick="return false;" <% } %>>
                <div class="step3 <% if(hash=='3') { %> active <% } %> step" rel="3">
                    Шаг 3
                </div>
            </a>
            <a href="<%= steps.step4 %>" <% if(steps.step4=='') { %>           onclick="return false;" <% } %>>
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
                    Сумма <span class="summ" data-price="<%= product.price %>"><%= product.pricehtml %></span>
                    рублей
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


<div class="step2-body bodystep">
    <div id="step2-container">

    </div>
    <script type="text/template" id="step2">
        <div class="progres">
            <div class="progres-col2">
                <div class="progres-summ">
                    Сумма <span class="summ" data-price="<%= product.price %>"><%= product.pricehtml %></span>
                    рублей
                </div>
                <input type="button" class="green floatright" value="Заказать">
            </div>
        </div>
        <h2>Комплектация ванны</h2>
        <hr/>
        <h4>Шаг 2. Выберите комплектацию к ней <br/>(<%= product.name %>)</h4>
        <hr/>
        <div class="bath-image">
            <img src="<%= product.image %>"/>
        </div>
        <div class="bath-step1-info">
            <% _.each(product.gradestep2, function (grade) { %>



            <div class="checkbox">
                <label>
                    <input type="checkbox" class="grade-check" <% if(grade.disabled=='1') { %>    checked
                           disabled <% } else { if(grade.checked=='1') { %> checked <% } } %>    rel="<%= grade.id %>"/> <%= grade.name %>
                    </label>
                <span class="price-grade"><%= grade.price %></span> руб.
            </div>



                                                <% }); %>

                                                <a href="#!/step3">
                <input class="big-button step2-button step-button" rel="2" value="Далее"/>
            </a>
        </div>
        </div>
    </script>
</div>


<div class="step3-body bodystep">
    <div id="step3-container">

    </div>
    <script type="text/template" id="step3">
        <div class="progres">
            <div class="progres-col2">
                <div class="progres-summ">
                    Сумма <span class="summ" data-price="<%= product.price %>"><%= product.pricehtml %></span>
                    рублей
                </div>
                <input type="button" class="green floatright" value="Заказать">
            </div>
        </div>
        <h2>Комплектация ванны</h2>
        <hr/>
        <h4>Шаг 3. Массажные опции<br/>(<%= product.name %>) </h4>
        <hr/>

        <div class="bath-image">
            <img src="<%= product.image %>"/>
        </div>
        <div class="bath-step1-info">
            <div class="checkbox">
                <label>
                    <input type="checkbox"
                           class="massage-check gidro" <% if(product.gidromassage.required=='1') { %>  checked <% } %><% if(product.massages.length != 0) { _.each(product.massages, function (massage, index) { if(index == product.gidromassage.option_id) { %>
                            checked
                        <% } }) %> <% } %>    rel="<%= product.gidromassage.option_id %>"/> <%= product.gidromassage.name %>
                    </label>
                <span class="price-grade"><%= product.gidromassage.price %></span> руб.
            </div>


                                    <% _.each(product.underoptions, function (massage) {  %>





            <div class="checkbox inner-option">
                <label>
                    <input type="checkbox" class="massage-check under"
                           rel="<%= massage.option_id %>" <% if(massage.required=='1') { %>  checked <% } %> <% if(product.massages.length != 0) { _.each(product.massages, function (key, index) {  if(index == massage.option_id) { %>
                            checked
                        <% } }) %> <% } %> /> <%= massage.name %>
                    </label>
                <span class="price-grade"><%= massage.price %></span> руб.
            </div>



                                    <% }); %>

                                    <% _.each(product.othersoptions, function (massage) { %>





            <div class="checkbox">
                <label>
                    <input type="checkbox" class="massage-check <% if(massage.pnevmo=='on') { %>pnevmo<% } %>"
                           rel="<%= massage.option_id %>" <% if(massage.required=='1') { %>  checked <% } %> <% if(product.massages.length != 0) { _.each(product.massages, function (key, index) { if(index == massage.option_id) { %>
                            checked
                        <% } }) %> <% } %>/> <%= massage.name %>
                    </label>
                <span class="price-grade"><%= massage.price %></span> руб.
            </div>



                                    <% }); %>

                                    <a href="#!/step4">
            <input class="big-button step3-button step-button" rel="3" value="Далее"/>
        </a>
        </div>
        </div>
    </script>
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

var animateSwitch = {
    switch: function (id) {
        $('.bodystep').fadeOut();
        $('.step' + id + '-body').fadeIn();
    }
}

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
        if (Steps != null) {
            Steps.render(hash);
        }
        Step1.reRender(productid);
    },
    stepRoute: function (hash) {
        if (Steps != null) {
            Steps.render(hash);
        }
        if (hash == '1') {
            if (Step1 != null) {
                Step1.render();
            }
        }
        if (hash == '2') {
            if (Step2 != null) {
                Step2.render();
            }
        }
        if (hash == '3') {
            if (Step3 != null) {
                Step3.render();
            }
        }
        if (hash == '4') {
            if (Step4 != null) {
                Step4.render();
            }
        }

    }
});

var Product = Backbone.Model.extend({
    defaults: {
        name: '',
        param: ''
    },
    urlRoot: "/index/getproduct"
});
var getSteps = Backbone.Model.extend({urlRoot: "/index/getsteps"});
var Checkout = Backbone.Model.extend({
    defaults: {
        id: '',
        corner: '',
        grades: {},
        massages: {},
        electronic: false
    }
});

var Steps = Backbone.View.extend({
    el: $("#steps-container"),
    template: _.template($('#steps').html()),
    render: function (hash) {
        var model = new getSteps({id: hash});
        var that = this;
        model.fetch({
            success: function (response) {
                if (response.attributes.result == 'success') {
                    $(that.el).html(that.template({ steps: response.attributes.steps, hash: hash}));
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
        var that = this;
        if (checkout.get('id') != '') {
            var current_id = checkout.get('id');
        } else {
            var current_id = $(this.current_id).val();
        }
        checkout.set('id', current_id);
        var model = new Product();
        model.save(checkout.toJSON(), {
            success: function (response) {
                $(that.el).html(that.template({ product: response.attributes}));
            }
        });
        animateSwitch.switch(1)
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
        checkout.set('corner', value);
    },
    reRender: function (param) {
        var that = this;
        checkout.set('corner', 'right');
        checkout.set('id', param);
        var model = new Product();
        model.save(checkout.toJSON(), {
            success: function (response) {
                $(that.el).html(that.template({ product: response.attributes}));
            }
        });
        animateSwitch.switch(1);
    }
});

var Step2 = Backbone.View.extend({
        el: $('#step2-container'),
        events: {
            "click .grade-check": "selectGrades"
        },
        template: _.template($('#step2').html()),
        render: function () {
            that = this;
            var model = new Product();
            model.save(checkout.toJSON(), {
                success: function (response) {
                    $(that.el).html(that.template({ product: response.attributes}));
                }
            });
            animateSwitch.switch(2);
        },
        selectGrades: function (e) {
            var elem = $(e.target);
            var selectedGrades = checkout.get('grades');
            selectedGrades[elem.attr('rel')] = '';
            checkout.set('grades', selectedGrades);
        }
    })
    ;
var Step3 = Backbone.View.extend({
    el: $('#step3-container'),
    events: {
        "click .massage-check": "selectMassages"
    },
    template: _.template($('#step3').html()),
    render: function () {
        that = this;
        var model = new Product();
        model.save(checkout.toJSON(), {
            success: function (response) {
                $(that.el).html(that.template({ product: response.attributes}));
            }
        });
        animateSwitch.switch(3);
    },
    selectMassages: function (e) {
        var elem = $(e.target);
        var selectedMassages = checkout.get('massages');
        selectedMassages = this.switchGidro(elem, selectedMassages);
        this.setElectronic();
        $('.massage-check').each(function () {
            if ($(this).prop('checked')) {
                selectedMassages[$(this).attr('rel')] = '';
            } else {
                delete selectedMassages[$(this).attr('rel')];
            }
        });
        checkout.set('massages', selectedMassages);

        that = this;
        var model = new Product();
        model.save(checkout.toJSON(), {
            success: function (response) {
                $(that.el).html(that.template({ product: response.attributes}));
            }
        });
    },
    switchGidro: function (elem, selectedMassages) {
        if (elem.hasClass('gidro')) {
            if (!elem.prop('checked')) {
                $('.massage-check.under').each(function () {
                    $(this).prop('checked', false);
                    delete selectedMassages[$(this).attr('rel')];
                });
            }
        }
        if (elem.hasClass('under')) {
            if (elem.prop('checked')) {
                $('.massage-check.gidro').prop('checked', true);
                selectedMassages[$(this).attr('rel')] = '';
            }
        }
        return selectedMassages;
    },
    setElectronic: function () {
        if ($('.massage-check.pnevmo').prop('checked'))
            checkout.set('electronic', true);
        else
            checkout.set('electronic', false);
    }
});
var Step4 = Backbone.View.extend({});
var checkout = new Checkout();
var Steps = new Steps();
var Step1 = new Step1();
var Step2 = new Step2();
var Step3 = new Step3();
var Step4 = new Step4();

var controller = new Controller();
Backbone.history.start();
</script>

