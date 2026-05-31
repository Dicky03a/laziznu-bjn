<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportGeneratedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $fileName;

    protected string $filePath;

    public function __construct(string $fileName, string $filePath)
    {
        $this->fileName = $fileName;
        $this->filePath = $filePath;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = asset('storage/'.$this->filePath);

        return (new MailMessage)
            ->subject('Laporan Berhasil Dibuat')
            ->line('Laporan yang Anda minta telah berhasil dibuat.')
            ->line('Nama File: '.$this->fileName)
            ->action('Download Laporan', $url)
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Laporan Berhasil Dibuat',
            'message' => 'Laporan '.$this->fileName.' telah siap untuk diunduh.',
            'url' => asset('storage/'.$this->filePath),
            'file_name' => $this->fileName,
        ];
    }
}
