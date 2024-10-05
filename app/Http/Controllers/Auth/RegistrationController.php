<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleTypeEnum;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.registration');
    }

    public function store(RegistrationRequest $request)
    {
        
        try {
            $role                           = \DB::table('roles')->where('name', RoleTypeEnum::Employee->value)->first();
            $user                           = User::firstOrNew(['email' => $request->email]);
            if($request->password):
                $user->password             = Hash::make($request->password);
            endif;
            $user->name                     = $request->name;
            $user->email                    = $request->email;
            $user->role_id                  = $role->id;
            $user->save();
            Auth::login($user, true);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}