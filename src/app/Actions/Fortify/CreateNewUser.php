<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Account; // 1. Importamos o model Account
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // 2. Capturamos o usuário criado em uma variável
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // 3. Criamos a Account associada ao novo usuário
        Account::create([
            'user_id' => $user->id,
            'name' => $input['name'], // Usamos o nome do usuário como nome da conta
        ]);

        // 4. Retornamos o usuário criado, como esperado pela interface
        return $user;
    }
}
