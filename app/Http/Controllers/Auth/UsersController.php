<?php

namespace App\Http\Controllers;

use function compact;
use Illuminate\Http\Request;
use function redirect;
use Session;
use Illuminate\Support\Str;
use function str_random;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        flash('다음 폼을 작성해주세요.');
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'gender' => 'required',
            'phoneNumber' => 'required|min:11',
            'bankName' => 'required',
            'accountNumber' => 'required',
            'recommend_code' => 'required',
        ]);

        $confirmCode = str_random(60);
        $type = 0; # 일반회원

        $user = \App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_code' => $confirmCode,
            'gender' => $request->input('gender'),
            'phoneNumber' => $request->input('phoneNumber'),
            'bankName' => $request->input('bankName'),
            'accountNumber' => $request->input('accountNumber'),
            'photo' => $request->input('photo'),
            'signature' => $request->input('signature'),
            'type' => $type,
            'recommender' => $request->input('recommender'),
            'recommend_code' => $request->input('recommend_code'),
        ]);

//        \Mail::send('emails.auth.confirm', compact('user'), function ($message) use ($user) {
//            $message->to($user->email);
//            $message->subject(
//                sprintf('[%s] 회원가입을 확인해 주세요.', config('app.name'))
//            );
//        });
//        event(new \App\Events\UserCreated($user));

        // 추천인 A클래스 추천인 체크
        $a_class_recommender = \App\User::where('recommend_code',$request->recommender)->first();
        if ($a_class_recommender)
        {
            if ($a_class_recommender->type==4)
            {
                // user id
                $recommend_commissioner_id = \App\User::where('email',$request->email)->first();
                //            return $recommend_commissioner_id;
                // A클래스 id
                $a_class = \App\A_Class::create([
                    'a_class_id' => $a_class_recommender->id,
                    'a_class_recommend_code' => $a_class_recommender->recommend_code,
                    'recommend_commissioner_id' => $recommend_commissioner_id->id,
                ]);
            }
        }

        auth()->login($user);

        return redirect(route('home'))->with('flash_message','가입하신 메일 계정으로 가입 확인 메일을 보내드렸습니다. 가입 확인하시고 로그인해 주세요.');
    }
    public function confirm($code)
    {
        $user = \App\User::whereConfirmCode($code)->first();

        if (! $user) {
            flash('URL이 정확하지 않습니다.');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        auth()->login($user);

        return redirect(route('home'))->with('flash_message', auth()->user()->name . '님, 환영합니다 가입 확인되었습니다.');
    }
//    protected function respondCreated($message)
//    {
//        flash($message);
//
//        return redirect('/home');
//    }
}