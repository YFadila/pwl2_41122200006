<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifikasi Email Anda di KataWarga')
                ->greeting('Halo, ' . $notifiable->name . '!')
                ->line('Terima kasih telah mendaftar di KataWarga.')
                ->line('Untuk menyelesaikan proses pendaftaran, silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini.')
                ->action('Verifikasi Email Saya', $url)
                ->line('Jika tombol di atas tidak dapat diklik, Anda dapat menyalin dan membuka tautan berikut di browser:')
                ->line($url)
                ->line('Link verifikasi ini berlaku selama 60 menit.')
                ->line('Jika Anda tidak merasa mendaftar di KataWarga, Anda dapat mengabaikan email ini dengan aman.')
                ->salutation('Salam hangat, Tim KataWarga');
        });
    }
}
