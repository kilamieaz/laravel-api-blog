<?php

namespace App\Jobs;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AuthLogin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Array $request)
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
        // Attempt logging
        if (!Auth::attempt(['email' => $this->request['email'], 'password' => $this->request['password']])) {
            return response()->json(['error' => 'The credentials provided do not match our records'], 401);
        }
        return User::whereEmail($this->request['email'])->get();
    }
}
