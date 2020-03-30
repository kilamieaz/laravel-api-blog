<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateUser
{
    use Dispatchable, Queueable;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return User::create([
            'name' => $this->request['name'],
            'email' => $this->request['email'],
            'password' => bcrypt($this->request['password']),
        ]);
    }
}
