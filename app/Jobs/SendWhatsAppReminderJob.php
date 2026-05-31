<?php

namespace App\Jobs;

use App\Services\WhatsAppReminderService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWhatsAppReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model;

    protected string $type;

    /**
     * Create a new job instance.
     * $type can be 'transaction' or 'qurban'
     */
    public function __construct($model, string $type)
    {
        $this->model = $model;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle(WhatsAppReminderService $service): void
    {
        // Note: Real WhatsApp API sending would happen here.
        // For now, we simulate by logging the wa_link that would be sent.

        if ($this->type === 'transaction') {
            $reminder = $service->generateReminder($this->model);
        } else {
            $reminder = $service->generateReminderQurban($this->model);
        }

        if ($reminder['success']) {
            Log::info("WhatsApp Reminder Queued for {$this->type}: ".$reminder['wa_link']);

            // In a real scenario, you'd use a WhatsApp API provider here (e.g. Twilio, Wablas, etc.)
            // Http::post('whatsapp-api-url', [...]);
        } else {
            Log::warning("Failed to generate WhatsApp reminder for {$this->type} ID: {$this->model->id}");
        }
    }
}
