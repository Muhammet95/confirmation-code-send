<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendCodeRequest;
use App\Http\Requests\SettingsSaveRequest;
use App\Models\User;
use App\Services\ConfirmationCode\MailService;
use App\Services\ConfirmationCode\SMSService;
use App\Services\ConfirmationCode\TelegramService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.setting');
    }

    public function sendCode(SendCodeRequest $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $request->validated();
            $send_type = $request->get('send_type');
            $send_endpoint = $request->get('send_endpoint');

            switch ($send_type) {
                case 'email':
                    $service = new MailService($send_endpoint);
                    break;
                case 'phone_number':
                    $service = new SMSService($send_endpoint);
                    break;
                case 'telegram_id':
                    $service = new TelegramService($send_endpoint);
            }

            if (!isset($service))
                return response(['status' => 'error', 'message' => 'Ошибка при попытке выбора сервиса для отправки кода подтверждения'], 404);

            $confirmation_code = substr(md5(uniqid(rand(), true)), 6, 6);
            $service->send($confirmation_code);
            Session::put('confirmation_code', $confirmation_code);

            return response(['status' => 'success', 'message' => 'Код успешно отправлен'], 200);
        } catch (Exception $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function save(SettingsSaveRequest $request)
    {
        try {
            $request->validated();

            if (Session::get('confirmation_code') !== $request->get('confirmation_code'))
                return response(['status' => 'error', 'message' => 'Код подтверждения не актуальный'], 200);

            $user = User::find($request->get('id'));
            if (!$user || $user->id !== auth()->user()->id)
                return response(['status' => 'error', 'message' => 'Данные пользователя не верны'], 200);

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if (!empty($request->get('password')))
                $user->password = bcrypt($request->get('password'));
            $user->phone_number = $request->get('phone_number');
            $user->telegram_id = $request->get('telegram_id');
            $user->about = $request->get('about');
            $user->save();

            Session::forget('confirmation_code');
            return response(['status' => 'success', 'message' => 'Данные успешно сохранены'], 200);
        } catch (Exception $exception) {
            return response(['status' => 'error', 'message' => $exception->getMessage()], $exception->getCode());
        }
    }
}
