<div class="grey_box_2 calc_right">
    <div class="button-order-modal">Заказать услугу</div>
</div>
<div class="container-order-modal">
    <div class="closed">x</div>
    <span class="h2"><span>Заказать услугу</span></span>
    <form id="form_order_service" method="post" onsubmit="yaCounter7139977.reachGoal('order_usluga'); return true;">
        <div class="form-group">
            <span class="form-caption">Ваше имя:<i>*</i></span>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <span class="form-caption">Телефон:<i>*</i></span>
            <input type="text" name="phone" required class="modal-phone" placeholder="+7(___) ___-__-__">
        </div>
        <div class="form-group">
            <span class="form-caption">E-mail:</span>
            <input type="text" name="email">
        </div>
        <div class="form-group">
            <span class="form-caption">Интересующая услуга:</span>
            <input type="text" name="service">
        </div>
        <div class="form-group">
            <span class="form-caption">Сообщение:</span>
            <textarea name="message" rows="3"></textarea>
        </div>
        <div class="form-group">
            <div id="g-recaptcha-form_order_service"></div>
            <div class="text-danger" id="recaptchaError"></div><br />
        </div>
        <div class="form-group">
            <input type="submit" value="Отправить">
        </div>
    </form>
</div>
<style>
    .container-order-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        background-color: #fff;
        padding: 0;
        border-radius: 5px;
        transform: translate(-50%, -50%);
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.23);
        display: none;
        width: 340px;
    }
    .form-group input, .form-group textarea {
        width: 100%;
        font-size: 16px;
        padding: 10px;
        background: none;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .container-order-modal .closed {
        float: right;
        cursor: pointer;
        margin-right: 20px;
        margin-top: 5px;
        color: #fff;
        font-size: 16px;
    }
    .container-order-modal input[type="submit"] {
        padding: 10px 20px;
        background: #ff6000;
        color: #fff;
        outline: none;
    }
    .container-order-modal .h2 span {
        width: 100%;
        display: block;
        text-align: center;
    }
    #form_order_service {
        padding: 20px;
    }
    .button-order-modal {
        display: block;
        margin: auto;
        width: auto;
        text-align: center;
        background-color: #ee6004;
        line-height: 36px;
        border-radius: 4px;
        color: #fff;
        font-size: 22px;
        cursor: pointer;
    }
</style>
<script>
    $(function() {
        $('.button-order-modal').click(function() {
            $('.container-order-modal').fadeIn();
            $('#form_order_service input[name="service"]').val($('h1').text());
        });
        $('.container-order-modal .closed').click(function() {
            $('.container-order-modal').fadeOut();
        });
    });
</script>