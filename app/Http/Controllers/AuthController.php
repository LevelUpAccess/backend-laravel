<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    
    public function register(RegistroRequest $request) {
        //validar registro
        $data = $request-> validated();

        //Crear usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        //Retornar la respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }
    
    public function login(LoginRequest $request) {
        $data = $request->validated();

        //Revisar el password
        if(!Auth::attempt($data)) {
            return response([
                'errors' => ['El email o password son incorrectos']
            ], 422);
        }

        //Autenticar al usuario
        $user = Auth::user();
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return [
            'user' => null
        ];
    }

    public function update(Request $request) {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        'current_password' => ['required'],
        'password' => ['nullable', 'confirmed', 'min:6'],
    ], [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo es obligatorio.',
        'email.email' => 'El correo debe ser una dirección válida.',
        'email.unique' => 'El correo ya está en uso.',
        'current_password.required' => 'Es necesario ingresar la contraseña actual para confirmar.',
        'password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
        'password.min' => 'La nueva contraseña debe tener al menos 6 caracteres.',
    ]);

    //si la validación falla, devolvemos errores personalizados
    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    $data = $validator->validated();

    //verificamos la contraseña actual
    if (!Hash::check($data['current_password'], $user->password)) {
        return response()->json([
            'message' => 'La contraseña actual es incorrecta.'
        ], 422);
    }

    $user->name = $data['name'];
    $user->email = $data['email'];

    if (!empty($data['password'])) {
        $user->password = Hash::make($data['password']);
    }

    $user->save();

    return response()->json([
        'message' => 'Usuario actualizado correctamente',
        'user' => $user,
    ]);
    }
}
