jQuery(document).ready(function($) {
    /*
     * Общие настройки ajax-запросов, отправка на сервер csrf-токена
     */
    $.ajaxSetup({
        headers: {
            // 'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    });

    $('#staticBackdrop').on('show.bs.modal', prepareInformation);

    $('.btn-send-code').on('click', sendCode);


    function prepareInformation() {
        $('input[name=name]').val($('#name').val());
        $('input[name=password]').val($('#password').val());

        const phone_number = $('#phone_number').val();
        if (!phone_number) {
            $('input[name=phone_number]').val(phone_number);
            $('#cod-from-sms span').html("Укажите номер телефона для отправки смс");
            $('#cod-from-sms').attr('disabled', 'true');
        }
        else {
            $('input[name=phone_number]').val(phone_number);
            $('#cod-from-sms span').html(phone_number);
            $('#cod-from-sms').removeAttr('disabled');
        }

        const telegram_id = $('#telegram_id').val();
        if (!telegram_id) {
            $('input[name=telegram_id]').val(telegram_id);
            $('#cod-from-telegram span').html("Укажите аккаунт телеграм для отправки кода");
            $('#cod-from-telegram').attr('disabled', 'true');
        }
        else {
            $('input[name=telegram_id]').val(telegram_id);
            $('#cod-from-telegram span').html(telegram_id);
            $('#cod-from-telegram').removeAttr('disabled');
        }

        const email = $('#email').val();
        if (!email) {
            $('input[name=email]').val(email);
            $('#cod-from-email span').html("Укажите адрес почты для отправки кода");
            $('#cod-from-email').attr('disabled', 'true');
        }
        else {
            $('input[name=email]').val(email);
            $('#cod-from-email span').html(email);
            $('#cod-from-email').removeAttr('disabled');
        }

        $('input[name=about]').val($('#about').html());
    }

    function sendCode(event) {
        const name = $(event.currentTarget).data('name');


    }
});
