<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simple to create user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name       = $this->ask('What is your name?');
        $email      = $this->ask('What is your email?');
        $password   = $this->secret('What is the password?');

        $validator  = Validator::make([
            'name'      => $name,
            'email'     => $email,
            'password'  => $password
        ], [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8']
        ]);

        if ( $validator->fails() ) {
            $this->info('User not created. See error messages below:');

            foreach ( $validator->errors()->all() as $error ) {
                $this->error( $error );
            }

            return 1;
        }

        if ( $this->confirm('Do you wish to continue?') ) {
            User::create([
                'name'      => $name,
                'email'     => $email,
                'password'  => Hash::make( $password )
            ]);

            $this->info('User created.');

            return 0;
        }
    }
}
