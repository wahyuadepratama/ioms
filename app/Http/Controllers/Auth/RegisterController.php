<?php

namespace App\Http\Controllers\Auth;

use App\Anggota;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nim' => 'required|string|max:10|unique:anggota',
            'nama' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:anggota',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Anggota::create([
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'id_role' => 3,
        ]);
    }
}
