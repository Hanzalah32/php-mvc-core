<?php

namespace anzalahMvc\Core\models;
use anzalahMvc\Core\Model;
use anzalahMvc\Core\Application;



class Dashboard extends Model
{
    public string $email = '';
    public string $password = '';
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return[
            'email' => 'Your email',
            'password' => 'Your Passowrd'
        ];
    }
    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User doesnot exits with this email');
            return false;
        }
        
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        return Application::$app->login($user);
    }
}