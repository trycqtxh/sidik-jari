<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Transformers\GuruTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\ArrayToXml\ArrayToXml;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt(['nip'=>$request->nip, 'password'=>$request->password, 'jabatan'=>'Admin'])){
            return redirect()->route('absensi.index');
        }
        return redirect()->back()->withErrors(['message'=>'NIP atau Password yang anda masukan salah', 'error'=>true]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('absensi.home');
    }

    public function api_login(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt(['nip'=>$request->nip, 'password'=>$request->password, 'jabatan'=>'Admin'])){
            return response()
                ->json([
                    'error' => 'Your Credential is Wrong'
                ], 401);
        }

        $admin = Guru::find(Auth::user()->nip);

        return fractal()
            ->item($admin)
            ->transformWith(new GuruTransformer())
            ->addMeta([
                'token' => $admin->api_token
            ])
            ->toJson();
    }

    public function api_logout()
    {
        Auth::logout();
        return response()
            ->json([
                'redirect' => 'api/login'
            ]);
    }
}
