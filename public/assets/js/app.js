jQuery(document).ready(function($) {
    /*
     * Общие настройки ajax-запросов, отправка на сервер csrf-токена
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': `${$('input[name=csrf]').val()}`
        }
    });

    $('#staticBackdrop').on('show.bs.modal', prepareInformation);

    $('.btn-send-code').on('click', sendCode);

    $('#save_form').submit(saveInformation);


    function prepareInformation() {

        $('input[name=id]').val($('#id').val());
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
        try {
            const name = $(event.currentTarget).data('name');
            const data = {};

            data.send_type = name;
            data.send_endpoint = $(`input[name=${name}]`).val();
            if (!data.send_type)
                notify('error', 'Ошибка выбора варианта отправки кода подтверждения');

            console.log(data.send_type, data.send_endpoint);
            $.ajax({
                async: false,
                url: `send_code`,
                type: 'POST',
                data: data,
                success: function(response) {
                    notify(response.status, response.message);
                    console.log('success:',response);
                },
                error: function (response) {
                    notify(response.status, response.message);
                    console.log('error:',response);
                }
            });
        } catch (e) {
            console.log(e.message);
        }
    }

    function notify(type, message) {
        if (type === 'success') {
            $('#notifier').removeClass('bg-danger');
            $('#notifier').addClass('bg-success');
        }
        else {
            $('#notifier').removeClass('bg-success');
            $('#notifier').addClass('bg-danger');
        }
        $('#notifier').html(message);
        $('#notifier').fadeIn();
        setTimeout(() => { $('#notifier').fadeOut(); }, 3000);
    }

    function saveInformation(event) {
        event.preventDefault();
        const form = $(this).serialize();
        $.ajax({
            async: false,
            url: `save`,
            type: 'POST',
            data: form,
            success: function(response) {
                console.log(response);
                notify(response.status, response.message);
                console.log('success:', response);
            },
            error: function (response) {
                console.log(response);
                notify(response.status, response.message);
                console.log('error:', response);
            }
        });
    }
});
