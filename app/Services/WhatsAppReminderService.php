<?php

namespace App\Services;

use App\Models\Transaction;

class WhatsAppReminderService
{
      /**
       * Generate WhatsApp reminder message and wa.me link
       */
      public function generateReminder(Transaction $transaction): array
      {
            if (! $transaction->telepon) {
                  return [
                        'success' => false,
                        'message' => 'Nomor telepon donatur tidak tersedia',
                  ];
            }

            $phone = '62' . ltrim($transaction->telepon, '0');
            $paymentLink = url("/pembayaran/{$transaction->kode_transaksi}");

            $message = "Assalamu'alaikum Warahmatullahi Wabarakatuh,\n\n";
            $message .= "Yth. {$transaction->nama_donatur},\n\n";
            $message .= "Kami mengingatkan bahwa Anda masih memiliki transaksi yang belum dilengkapi bukti pembayarannya:\n\n";
            $message .= "Kode Transaksi: {$transaction->kode_transaksi}\n";
            $message .= 'Jenis: ' . $transaction->type_label . "\n";
            $message .= "Jumlah: {$transaction->jumlah_format}\n\n";
            $message .= "Silakan upload bukti pembayaran Anda melalui link berikut untuk menyelesaikan proses konfirmasi:\n\n";
            $message .= $paymentLink . "\n\n";
            $message .= "Terima kasih atas perhatian Anda.\n\n";
            $message .= "Wassalamu'alaikum Warahmatullahi Wabarakatuh.";

            $encodedMessage = urlencode($message);
            $waLink = "https://wa.me/{$phone}?text={$encodedMessage}";

            return [
                  'success' => true,
                  'phone' => $phone,
                  'message' => $message,
                  'wa_link' => $waLink,
                  'payment_link' => $paymentLink,
            ];
      }
}
