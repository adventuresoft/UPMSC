<?php

namespace App\Jobs;

use App\Models\People;
use App\Services\AdaReachSmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendApprovalSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Number of times to retry the job
     * @var int
     */
    public $tries = 5;

    /**
     * Number of seconds to wait before retrying the job
     * @var array
     */
    public $backoff = [60, 120, 300, 600, 1800]; // 1min, 2min, 5min, 10min, 30min

    protected $peopleId;
    protected $name;
    protected $loginId;
    protected $password;
    protected $approvedId;
    protected $phone;

    /**
     * Create a new job instance.
     */
    public function __construct($peopleId, $name, $loginId, $password, $approvedId, $phone)
    {
        $this->peopleId = $peopleId;
        $this->name = $name;
        $this->loginId = $loginId;
        $this->password = $password;
        $this->approvedId = $approvedId;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     */
    public function handle(AdaReachSmsService $smsService): void
    {
        Log::info('[SendApprovalSms] Starting job', ['people_id' => $this->peopleId]);

        $message = AdaReachSmsService::buildApprovalMessage(
            $this->name,
            $this->loginId,
            $this->password,
            $this->approvedId
        );

        $result = $smsService->send($this->phone, $message);

        if (!$result['success']) {
            Log::error('[SendApprovalSms] Failed to send SMS', [
                'people_id' => $this->peopleId,
                'result' => $result
            ]);
            // Throw exception to retry the job
            throw new \Exception('Failed to send approval SMS');
        } else {
            Log::info('[SendApprovalSms] SMS sent successfully', ['people_id' => $this->peopleId]);
        }
    }
}