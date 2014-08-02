<input type="hidden" value="<?php echo $this_product_id; ?>" id="current_product"/>
<div class="tp-loader-bath" style="display: none;"></div>
<div id="steps-container">

</div>
<div class="order-fixed-bottom order fixed">

</div>
<div class="hidden-container dn"></div>
<script type="text/template" id="order">
<div class="order fixed">
    <a href="<%= product.image %>" class="order-image button" rel="groupfancy" style="display: block;"><%= product.smallimage %></a>
    <span class="your-order">Ваш заказ:</span><br>
    <span class="floatleft"><%= product.name %></span>
    <span class="floatright block-price">
    <span class="global-price" data-value="<%= product.price %>"><%= product.pricehtml %> руб.</span>
    <br>
    <span class="order-details-show" style="display: block;"> Просмотреть заказ</span>
        <a href="#order-ways" class="order-form">
            <span class="order-button"> Заказать</span>
        </a>
    </span>
    <div class="clearboth order-details" style="display:none">
    <span class="floatleft accessory"></span>
    <% if(product.fororder_grades.length != 0) { %>
        <div class="grade-details-header" style="display: block;"><b>Комплектация</b></div>
        <div class="grade-details">
            <% _.each(product.fororder_grades, function (grade) { %>
                <span class="order-grade floatleft" data-id="<%= grade.id %>">
                    <span class="pl">
                        <%= grade.image %>
                    </span>
                    <%= grade.name %>
                </span>
            <% }); %>
        </div>
    <% } %>
    <% if(product.fororder_massages.length != 0) { %>
    <div class="massage-details-header" style="display: block;"><b>Массажные опции</b></div>
        <% _.each(product.fororder_massages, function (massage, index) { %>
            <span class="order-massage floatleft" data-id="<%= product.option_id %>">
                <span class="pl">
                    <%= massage.image %>
                        <div class="lookonthis">
                            <a href="<%= massage.path %>">Посмотреть</a>
                        </div>
                    </span>
                <%= massage.name %>
            </span>
        <% }); %>
    <% } %>
    <% if(product.fororder_accessories.length != 0) { %>
        <div class="accessory-details-header" style="display: block;"><b>Аксессуары</b></div>
            <% _.each(product.fororder_accessories, function (accessory, index) { %>
                <div class="accessory-details">
                    <span class="order-accessory floatleft" data-id="<%= accessory.id %>">
                        <span class="pl">
                            <%= accessory.image %>
                        </span>
                        <a target="_blank" href="<%= accessory.href %>">
                            <%= accessory.name %>
                        </a>
                    </span>
                </div>
            <% }); %>
        </div>
    <% } %>
</div>
</script>


<script type="text/template" id="steps">
    <div class="checkout-steps">
        <div class="clearfix">
            <a href="<%= steps.step1 %>" <% if(steps.step1=='') { %>            onclick="return false;" <% } %>>
                <div class="step step1 <% if(hash=='1') { %> active <% } %>" rel="2">
                    <div class="step-badge">1</div>
                    Выберите модель и размеры ванны
                </div>
            </a>
            <a href="<%= steps.step2 %>" <% if(steps.step2=='') { %>            onclick="return false;" <% } %>>
                <div class="step step2 <% if(hash=='2') { %> active <% } %>" rel="2">
                    <div class="step-badge">2</div>
                    Комплектация
                </div>
            </a>
            <a href="<%= steps.step3 %>" <% if(steps.step3=='') { %>            onclick="return false;" <% } %>>
                <div class="step step3 <% if(hash=='3') { %> active <% } %>" rel="2">
                    <div class="step-badge">3</div>
                    Массажные опции
                </div>
            </a>
            <a href="<%= steps.step4 %>" <% if(steps.step4=='') { %>            onclick="return false;" <% } %>>
                <div class="step step4 <% if(hash=='4') { %> active <% } %>" rel="2">
                    <div class="step-badge">4</div>
                    Аксессуары
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
                    <input type="checkbox" class="grade-check" <% if(grade.disabled=='1') { %>     checked
                           disabled <% } else { if(grade.checked=='1') { %>  checked <% } } %>     rel="<%= grade.id %>"
                           data-price="<%= grade.price %>"/> <%= grade.name %>
                    </label>
                    <%= grade.image %>
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
                           class="massage-check gidro" <% if(product.gidromassage.required=='1') { %>   checked <% } %><% if(product.massages.length != 0) { _.each(product.massages, function (massage, index) { if(index == product.gidromassage.option_id) { %>
                             checked
                        <% } }) %> <% } %>     rel="<%= product.gidromassage.option_id %>"
                           data-price="<%= product.gidromassage.price %>"/> <%= product.gidromassage.name %>
                    </label>
                <span class="price-grade"><%= product.gidromassage.price %></span> руб.
            </div>



                                                <% _.each(product.underoptions, function (massage) {  %>







            <div class="checkbox inner-option">
                <label>
                    <input type="checkbox" class="massage-check under"
                           rel="<%= massage.option_id %>" <% if(massage.required=='1') { %>   checked <% } %> <% if(product.massages.length != 0) { _.each(product.massages, function (key, index) {  if(index == massage.option_id) { %>
                             checked
                        <% } }) %> <% } %>  data-price="<%= massage.price %>"/> <%= massage.name %>
                    </label>
                <span class="price-grade"><%= massage.price %></span> руб.
            </div>




                                                <% }); %>

                                                <% _.each(product.othersoptions, function (massage) { %>







            <div class="checkbox">
                <label>
                    <input type="checkbox" class="massage-check <% if(massage.pnevmo=='on') { %>pnevmo<% } %>"
                           rel="<%= massage.option_id %>" <% if(massage.required=='1') { %>   checked <% } %> <% if(product.massages.length != 0) { _.each(product.massages, function (key, index) { if(index == massage.option_id) { %>
                             checked
                        <% } }) %> <% } %>  data-price="<%= massage.price %>"/> <%= massage.name %>
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


<div class="step4-body bodystep">
    <div id="step4-container">

    </div>
    <script type="text/template" id="step4">
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
        <h4>Шаг 4. Аксессуары к ванне <br/>(<%= product.name %>)</h4>
        <hr/>
        <input type="hidden" id="current_product" value="<%= product.id %>"/>
        <div class="bath-image">
            <img src="<%= product.image %>"/>

            <div class="product-downloads">
                <a href="<%= product.scheme %>" class="width32"><img src="/images/download.png"/></a>
                Схема монтажа
            </div>
            <div class="product-downloads">
                <a href="<%= product.instruction %>" class="width32"><img src="/images/download.png"/></a>
                Инструкция по эксплуатации
            </div>
        </div>
        <div class="bath-step4-info">
            <% _.each(product.accessories, function (accessory) { %>




            <div class="checkbox">
                <label>
                    <input type="checkbox" class="accessory-check"
                           rel="<%= accessory.id %>" <% if(accessory.checked=='1') { %>  checked <% } %>
                           data-price="<%= accessory.price %>"/> <%= accessory.name %>
            </label>
            <%= accessory.image %>
            <span class="price-grade"><%= accessory.price %></span> руб.
                &nbsp;&nbsp; <a href="<%= accessory.href %>" target="_blank"> Посмотреть </a>
            </div>




                                                            <% }); %>

                                                            <a href="#!/step4">
                <input class="big-button step2-button step-button" rel="4" value="Заказать"/>
            </a>
        </div>
    </script>
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
        $('.tp-loader-bath').show();
        if (Steps != null) {
            Steps.render('1');
        }
        if (Step1 != null) {
            Step1.render();
        }
        if(Order != null) {
            Order.render();
        }
        $('.tp-loader-bath').hide();
    },
    switchProduct: function (hash, productid) {
        $('.bodystep').fadeOut().promise().done(function(){
            $('.tp-loader-bath').show();
        });
        if (Steps != null) {
            Steps.render(hash);
        }
        Step1.reRender(productid);
    },
    stepRoute: function (hash) {
        $('.bodystep').fadeOut();
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
        electronic: false,
        accessories: {}
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

var Order = Backbone.View.extend({
    el: $(".order-fixed-bottom"),
    template: _.template($('#order').html()),
    render: function (product) {
        $(this.el).html(this.template({product: product}));
        this.hangEvents();
    },
    hangEvents: function() {
        var order_button = $('.order-details-show');
        var order_details = jQuery('.order-details');
        order_button.click(function () {
            var vis = order_details.css('display');
            if (vis == 'none') {
                order_details.slideDown();
                jQuery(this).html(' Скрыть заказ');
            } else {
                order_details.slideUp();
                jQuery(this).html(' Посмотреть заказ');
            }
        });
    }
});

var Step1 = Backbone.View.extend({
    el: $("#step1-container"),
    current_id: $('#current_product'),
    current_price: $('#current_price').val(),
    events: {
        "change select.corner-select": "changeCorner"
    },
    template: _.template($('#step1').html()),
    render: function () {
        var that = this;
        if (checkout.get('id') != '') {
            var current_id = checkout.get('id');
            var current_price = checkout.get('price');
        } else {
            var current_id = $(this.current_id).val();
            var current_price = $(this.current_price).data('price');
        }
        checkout.set('id', current_id);
        checkout.set('price', current_price);
        var model = new Product();
        model.save(checkout.toJSON(), {
            success: function (response) {
                var product = response.attributes;
                if(Order != null) {
                    Order.render(product);
                }
                var template = that.template({ product: product});
                var hc = $('.hidden-container');
                hc.html(template).promise().done(function(){
                    var imagesCount = hc.find('img').length;
                    var imagesLoaded = 0;
                    hc.find('img').load(function() {
                        ++imagesLoaded;
                        if (imagesLoaded >= imagesCount) {
                            $(that.el).html($('.hidden-container').html());
                            $('.tp-loader-bath').hide();
                            $('.step1-body').fadeIn();
                        }
                    });
                });
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
        checkout.set('corner', value);
    },
    reRender: function (param) {
        var that = this;
        checkout.set('corner', 'right');
        checkout.set('id', param);
        var model = new Product();
        model.save(checkout.toJSON(), {
            success: function (response) {
                var product = response.attributes;
                if(Order != null) {
                    Order.render(product);
                }
                var template = that.template({ product: product});
                var hc = $('.hidden-container');
                hc.html(template).promise().done(function(){
                    var imagesCount = hc.find('img').length;
                    var imagesLoaded = 0;
                    hc.find('img').load(function() {
                        ++imagesLoaded;
                        if (imagesLoaded >= imagesCount) {
                            $(that.el).html($('.hidden-container').html());
                            $('.tp-loader-bath').hide();
                            $('.step1-body').fadeIn();
                        }
                    });
                });
            }
        });
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
                    console.log(response.attributes);
                    var product = response.attributes;
                    if(Order != null) {
                        Order.render(product);
                    }
                    $(that.el).html(that.template({ product: product}));
                }
            });
            animateSwitch.switch(2);
        },
        selectGrades: function (e) {
            var model = new Product();
            var elem = $(e.target);
            var current_summ = $(this.el).find('.summ');
            var new_price = current_summ.data('price');

            if (elem.prop('checked')) {
                new_price = parseInt(current_summ.attr('data-price')) + elem.data('price');
            } else {
                new_price = parseInt(current_summ.attr('data-price')) - elem.data('price');
            }
            current_summ.html(new_price).attr('data-price', new_price);
            var selectedGrades = checkout.get('grades');
            $('.grade-check').each(function () {
                if ($(this).prop('checked')) {
                    selectedGrades[elem.attr('rel')] = elem.data('price');
                } else {
                    delete selectedGrades[$(this).attr('rel')];
                }
            });
            checkout.set('grades', selectedGrades);
            model.save(checkout.toJSON(), {
                success: function (response) {
                    var product = response.attributes;
                    if(Order != null) {
                        Order.render(product);
                    }
                }
            });
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
        this.updateMassages();
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
                selectedMassages[$(this).attr('rel')] = $(this).data('price');
            } else {
                delete selectedMassages[$(this).attr('rel')];
            }
        });
        checkout.set('massages', selectedMassages);
        this.updateGradeRama(selectedMassages);
        that = this;
        var model = new Product();
        model.save(checkout.toJSON(), {
            success: function (response) {
                var product = response.attributes;
                if(Order != null) {
                    Order.render(product);
                }
                $(that.el).html(that.template({ product: product}));
            }
        });
    },
    updateGradeRama: function(selectedMassages) {
        var selMasLength = Object.keys(selectedMassages).length;
        if(selMasLength>0) {
            var rama_elem = $('#step2-container label:contains("Рама") input');
            var rama_id = rama_elem.attr('rel');
            var rama_checked = rama_elem.attr('checked');
            if(rama_checked!='checked') {
                var selectedGrades = checkout.get('grades');
                selectedGrades[rama_elem.attr('rel')] = rama_elem.data('price');
                checkout.set('grades', selectedGrades);
            }
        }
    },
    updateMassages: function() {
        var rama_elem = $('#step2-container label:contains("Рама") input');
        console.log(rama_elem);
        var rama_id = rama_elem.attr('rel');
        var rama_checked = rama_elem.prop('checked');
        if(!rama_checked) {
            checkout.set('massages', {});
            console.log(checkout.get('massages'));
        }
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
var Step4 = Backbone.View.extend({
    el: $("#step4-container"),
    current_id: $('#current_product'),
    events: {
        "click .accessory-check": "selectAccessory"
    },
    template: _.template($('#step4').html()),
    render: function () {
        that = this;
        var model = new Product();
        model.save(checkout.toJSON(), {
            success: function (response) {
                var product = response.attributes;
                if(Order != null) {
                    Order.render(product);
                }
                $(that.el).html(that.template({ product: product}));
            }
        });
        animateSwitch.switch(4);
    },
    selectAccessory: function (e) {
        var model = new Product();
        var elem = $(e.target);
        var current_summ = $(this.el).find('.summ');
        var new_price = current_summ.data('price');
        if (elem.prop('checked')) {
            new_price = parseInt(current_summ.attr('data-price')) + elem.data('price');
        } else {
            new_price = parseInt(current_summ.attr('data-price')) - elem.data('price');
        }

        current_summ.html(new_price).attr('data-price', new_price)
        var selectedAccessories = checkout.get('accessories');
        $('.accessory-check').each(function () {
            if ($(this).prop('checked')) {
                selectedAccessories[$(this).attr('rel')] = $(this).data('price');
            } else {
                delete selectedAccessories[$(this).attr('rel')];
            }
        });
        checkout.set('accessories', selectedAccessories);
        model.save(checkout.toJSON(), {
            success: function (response) {
                var product = response.attributes;
                if(Order != null) {
                    Order.render(product);
                }
            }
        });
    }
});
var checkout = new Checkout();
var Steps = new Steps();
var Order = new Order();
var Step1 = new Step1();
var Step2 = new Step2();
var Step3 = new Step3();
var Step4 = new Step4();

var controller = new Controller();
Backbone.history.start();
</script>

