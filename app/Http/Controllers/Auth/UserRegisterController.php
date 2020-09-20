<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Jobs\SendEmail;

class UserRegisterController extends Controller
{
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $user;
    protected $userRepository;

    /**
     * UserRegisterController constructor.
     * @param User $user
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(User $user, UserRepositoryInterface $userRepository)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function enqueue()
    {
        error_log('hehe');
        $emailJob = (new SendEmail());//->delay(Carbon::now()->addSeconds(1));
        dispatch($emailJob);

        echo config('queue.default');
    }

    public function testMail()
    {
        $to_name = 'Hai';
        $to_email = 'hngda01@gmail.com';
        $data = array('name'=>'Ogbonna Vitalis(sender_name)', 
                        'body' => 'A test mail'
        );
        Mail::send('email.register', $data, function($message) use ($to_name, $to_email)
            {
                $message->to($to_email, $to_name)->subject('Laravel Test Mail 2');
                $message->from('campaign.hanu@gmail.com','campaign.hanu@gmail.com');
            });
        return 'hello';
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, $this->user->rules);

        $user = $this->userRepository->register($request->all());

        if (empty($user)) {
            return redirect('/register')->withErrors(['error'=> trans('user.register.error')]);
        }

        return redirect('/login');

    }

}