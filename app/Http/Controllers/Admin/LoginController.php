<?php
/**
 * Created by PhpStorm.
 * User: ttt
 * Date: 2018/10/13
 * Time: 16:44
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request){
        $validator = \Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'username.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码不正确',
        ]);
        if ($validator->fails()) {
            $warnings = $validator->getMessageBag()->first();
            return [
                'code'=>405,
                'msg'=> $warnings
            ];
        }
        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->input('remember', 0);
        $res = auth('admin')->attempt(['username' => $username, 'status'=> Admin::STATUS_NORMAL, 'password'=>$password], $remember);
        if ($res) {
            return [
                'code'=>200,
                'msg'=> '登录成功'
            ];
        }
        return [
            'code'=>405,
            'msg'=> '用户名或密码错误'
        ];
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect('admin/login');
    }

    protected function guard()
    {
        return \Auth::guard('admin');
    }


}