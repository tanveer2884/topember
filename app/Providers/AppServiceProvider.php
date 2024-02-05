<?php

namespace App\Providers;

use App\Models\Setting;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->setCustomConfig();
        $this->configureSmtp();
    }

    public function setCustomConfig(): void
    {
        $config = Setting::getKeyValues();
        $logo_full = $config['logo_full'] ?? '';

        try {
            if (Str::endsWith($logo_full, '.svg')) {
                /** @var null|\Spatie\MediaLibrary\MediaCollections\Models\Media */
                $media = Setting::query()
                    ->where('key', 'logo_full')
                    ->first()
                    ?->media
                    ->first();

                if ($media) {
                    $config['logo_full_svg'] = Storage::disk($media->disk)
                        ->get($media->getPathRelativeToRoot());
                } else {
                    $config['logo_full_svg'] = file_get_contents("http://webserver{$logo_full}");
                }
            }
        } catch (Exception $ex) {
        }

        Config::set('custom', $config->toArray());
    }

    protected function configureSmtp()
    {
        $smtpSettings = Setting::whereIn('key', [
            'smtp_host',
            'smtp_port',
            'smtp_username',
            'smtp_password',
            'smtp_encryption',
        ])->pluck('value', 'key')->toArray();

        Config::set('mail.mailers.smtp', array_merge(config('mail.mailers.smtp'), [
            'host' => $smtpSettings['smtp_host'] ?? 'smtp.mailgun.org',
            'port' => $smtpSettings['smtp_port'] ?? 587,
            'encryption' => $smtpSettings['smtp_encryption'] ?? 'tls',
            'username' => $smtpSettings['smtp_username'] ?? null,
            'password' => $smtpSettings['smtp_password'] ?? null,
        ]));

        Config::set('mail.from.address', $smtpSettings['mail_from_address'] ?? null);
        Config::set('mail.from.name', $smtpSettings['mail_from_name'] ?? config('app.name'));
    }
}
