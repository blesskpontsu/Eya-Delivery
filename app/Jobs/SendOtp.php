<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $http = Http::withHeaders([
            'api-key' => getenv("ARKESEL_API_TOKEN"),
        ])->accept('application/json')
            ->post('https://sms.arkesel.com/api/otp/generate', [
                'expiry' => 5,
                'length' => 6,
                'medium' => 'sms',
                'message' => 'Please enter this OTP to complete your registration, %otp_code%',
                'number' => $this->user->phone,
                'sender_id' => 'DpTek',
                'type' => 'numeric'
            ]);

        return $http;
    }
}
