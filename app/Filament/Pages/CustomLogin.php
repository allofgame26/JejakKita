<?php

namespace App\Filament\Pages;

use Filament\Pages\Auth\Login;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;

class CustomLogin extends Login
{
    protected static string $view = 'filament.auth.custom-login';
    
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getLoginFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label(__('Username / E - Mail'))
            ->required()
            ->autocomplete('username')
            ->autofocus()
            ->extraInputAttributes([
                'tabindex' => 1,
                'class' => 'fi-input rounded-lg bg-white/5 text-white border-white/10 focus:border-primary-500 focus:ring-primary-500/50'
            ])
            ->extraAttributes([
                'data-cy' => 'input-login',
                'class' => 'space-y-2'
            ]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->password()
            ->revealable(false) // Disable password reveal untuk keamanan
            ->required()
            ->autocomplete('current-password')
            ->autofocus(false)
            ->extraInputAttributes([
                'tabindex' => 2,
            ])
            ->extraAttributes([
                'data-cy' => 'password-input',
                'class' => 'space-y-2'
            ]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        return [
            $login_type => $data['login'],
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
