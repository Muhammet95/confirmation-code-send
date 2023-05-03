<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/save" method="POST" enctype="multipart/form-data" id="save_form">
                <input type="hidden" name="csrf" value="{{csrf_token()}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Подтверждение сохранения через код</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 d-flex flex-column gap-2">
                        <label>Получить код подтверждения через:</label>
                        <button type="button" id="cod-from-telegram" data-name="telegram_id" class="btn btn-sm col-12 btn-info btn-send-code">
                            <img src="{!! url('images/telegram.png') !!}" alt="telegram logo" class="minimal-size">
                            Телеграмм аккаунт:
                            <span></span>
                        </button>
                        <button type="button" id="cod-from-email" data-name="email" class="btn btn-sm col-12 btn-info btn-send-code">
                            <img src="{!! url('images/gmail.png') !!}" alt="telegram logo" class="minimal-size">
                            Электронный адрес:
                            <span></span>
                        </button>
                        <button type="button" id="cod-from-sms" data-name="phone_number" class="btn btn-sm col-12 btn-info btn-send-code">
                            <img src="{!! url('images/sms.png') !!}" alt="telegram logo" class="minimal-size">
                            Смс на номер:
                            <span></span>
                        </button>
                    </div>
                    <label for="confirmation_code">Код подтверждения</label>
                    <input type="text" id="confirmation_code" name="confirmation_code" required>
                    <small id="confirmation_code_error" class="form-text text-muted">Код подтверждения обязателен к заполнению</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <input type="hidden" id="hidden-id" name="id">
                <input type="hidden" id="hidden-name" name="name">
                <input type="hidden" id="hidden-password" name="password">
                <input type="hidden" id="hidden-email" name="email">
                <input type="hidden" id="hidden-phone_number" name="phone_number">
                <input type="hidden" id="hidden-telegram_id" name="telegram_id">
                <input type="hidden" id="hidden-about" name="about">
            </form>
        </div>
    </div>
</div>
