<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dateOfBirth' => ['required', 'date'],
            'phone' => ['required', 'string', 'min:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'postNumber' => ['required', 'string', 'max:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $name = $data['name'];
        $surname = $data['surname'];
        $dateOfBirth = $data['dateOfBirth'];
        $phone = $data['phone'];
        $city = $data['city'];
        $region = $data['region'];
        $email = $data['email'];
        $postNumber = $data['postNumber'];
        $address = $data['address'];
        $password = Hash::make($data['password']);
        $role = User::ROLE_BUYER;

//        DB::insert('insert into users(name, surname, dateOfBirth, phone, email, address, password, role) values (?, ?, ?, ?, ?, ?, ?, ?)',
//            [$name, $surname, $dateOfBirth, $phone, $email, $address, $password, $role]);

        $user = new User();
        $user->name = $name;
        $user->surname = $surname;
        $user->dateOfBirth = $dateOfBirth;
        $user->phone = $phone;
        $user->email = $email;
        $user->city = $city;
        $user->postNumber = $postNumber;
        $user->region = $region;
        $user->address = $address;
        $user->password = $password;
        $user->role = $role;

        // Сохранение объекта пользователя в базу данных
        $user->save();

        // Возвращение объекта пользователя
        return $user;
    }
}
