<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {--name= : Name of the administrator} {--email= : Email of the administrator} {--role=super_admin : Role of the administrator} {--password= : Password of the administrator (optional, prompts securely if omitted)}', function () {
    $name = $this->option('name') ?: $this->ask('Administrator name', 'Kubu Administrator');
    $email = $this->option('email') ?: $this->ask('Administrator email');
    $role = $this->option('role') ?: 'super_admin';

    if (! in_array($role, array_keys(\App\Models\User::ROLES))) {
        $this->error("Invalid role [{$role}]. Available roles: " . implode(', ', array_keys(\App\Models\User::ROLES)));
        return 1;
    }

    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error('Invalid email address format.');
        return 1;
    }

    if (\App\Models\User::where('email', $email)->exists()) {
        $this->error("An account with email [{$email}] already exists.");
        return 1;
    }

    $password = $this->option('password') ?: $this->secret('Administrator password (min 8 characters)');

    if (! $this->option('password')) {
        $confirmPassword = $this->secret('Confirm administrator password');
        if ($password !== $confirmPassword) {
            $this->error('Passwords do not match.');
            return 1;
        }
    }

    $validator = \Illuminate\Support\Facades\Validator::make(
        ['password' => $password],
        ['password' => ['required', \Illuminate\Validation\Rules\Password::defaults()]]
    );

    if ($validator->fails()) {
        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }
        return 1;
    }

    \App\Models\User::create([
        'name' => $name,
        'email' => $email,
        'role' => $role,
        'password' => \Illuminate\Support\Facades\Hash::make($password),
    ]);

    $this->info("Administrator [{$email}] with role [{$role}] created successfully.");
    return 0;
})->purpose('Create an administrator account securely');

