<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class VerifyOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $phone;
    public $verification_code;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone, $verification_code)
    {
        $this->phone = $phone;
        $this->verification_code = $verification_code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $http = Http::withHeaders([
            'api-key' => getenv("ARKESEL_API_TOKEN")
        ])->accept('application/json')
            ->post('https://sms.arkesel.com/api/otp/verify', [
                'code' => $this->verification_code,
                'number' => $this->phone
            ]);
        $successful = $http->successful();
        return $successful;
    }
}
