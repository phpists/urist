<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\SmsService\TurboSmsSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class SendVerificationCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User $user,
        private TurboSmsSender $sender,
        private string $relation
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $relation = $this->relation;
        $send = true;

        $userLatestCode = $this->user->$relation()->latest()->first();
        if ($userLatestCode)
            $send = $userLatestCode->created_at->timestamp < (time() - 60); // is at least 1 minute pass

        if ($send) {
            $this->user->$relation()->delete();
            $code = rand(1000, 9999);
            $message = Lang::get('messages.sms_code_sent') . ': ' . $code;
            $this->user->$relation()->create(['code' => $code]);
            $this->sender->sendMessage([$this->user->phone], $message);
        } else {
            \Log::warning('User trying to sent code but not even a minute has passed');
        }
    }
}
