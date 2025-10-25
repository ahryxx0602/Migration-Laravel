<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validationErrorMessages()
    {
        return [
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.current_password' => 'Mật khẩu không chính xác',
        ];
    }
    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);

        //Xử lí gửi email khi confirm thành công
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        Mail::send([], [], function ($message) use ($name, $email) {
            $content = 'Chào ' . $name . '<br/>';
            $content .= ' Bạn vừa xác nhận mật khẩu thành công';
            $message->to($email)
                ->subject('Xác nhận mật khẩu thành công!')
                ->setBody($content, 'text/html');
        });

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }
}
