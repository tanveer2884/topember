<?php

use App\Models\Menu;
use App\Models\Setting;
use App\Models\Admin\Staff;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Rules\SettingsImageValidation;

if (!function_exists('get_max_fileupload_size')) {
    function get_max_fileupload_size($maxUploadSize = null)
    {
        $maxAllowedServerSize = (int) ini_get('upload_max_filesize') * 1024;

        $mediaLibraryAllowedSize = config('media-library.max_file_size', 10000000000000) / 1024;

        $appConfiguredMaxSize = ($mediaLibraryAllowedSize < $maxAllowedServerSize) ? $mediaLibraryAllowedSize : $maxAllowedServerSize;

        if (!$maxUploadSize) {
            return $appConfiguredMaxSize;
        }

        if ($maxUploadSize < $appConfiguredMaxSize) {
            return $maxUploadSize;
        }

        return $appConfiguredMaxSize;
    }

    function get_general_site_settings($key = null, $type = 'type')
    {
        $settings = collect([
            //'general_setting' => ['value' => 'General Setting', 'type' => 'heading'],
            'site_title' => ['value' => 'Demo', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'meta_tag' => ['value' => 'Demo', 'type' => 'text', 'rules' => 'string|max:255'],
            'copyright_text' => ['value' => '<p>©:CURRENT_YEAR <span>topdot</span>', 'type' => 'text', 'rules' => 'string|max:255'],
            'phone_number' => ['value' => '+1 (123) 456 7890', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'contact_us_email' => ['value' => 'info@companyname.com', 'type' => 'email', 'rules' => 'required|email|max:255'],
            'information_email' => ['value' => 'info@companyname.com', 'type' => 'email', 'rules' => 'required|email|max:255'],
            'address' => ['value' => 'Address Comes Here Lorem Ipsum dolor 123', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'logos' => ['value' => '', 'type' => 'hidden'],
            'logo_full' => ['value' => '/frontend/images/logo.png', 'type' => 'file', 'rules' => ['bail', 'required', (new SettingsImageValidation)->mimes(['svg', 'png', 'jpeg']), 'max:3000']],
            'logo_small' => ['value' => '/frontend/images/logo.png', 'type' => 'file', 'rules' => ['bail', 'required', new SettingsImageValidation, 'max:3000']],
            'social_urls' => ['value' => "Social Url's", 'type' => 'heading'],
            'facebook_url' => ['value' => '', 'type' => 'text', 'rules' => 'string|max:255'],
            'twitter_url' => ['value' => '', 'type' => 'text', 'rules' => 'string|max:255'],
            'youtube_url' => ['value' => '', 'type' => 'text', 'rules' => 'string|max:255'],
            'instagram_url' => ['value' => '', 'type' => 'text', 'rules' => 'string|max:255'],
            'pinterest_url' => ['value' => '', 'type' => 'text', 'rules' => 'string|max:255'],
            'smtp_empty' => ['value' => '', 'type' => 'hidden'],
            'smtp_settings' => ['value' => 'SMTP Setting', 'type' => 'heading'],
            'smtp_host' => ['value' => 'smtp.example.com', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'smtp_port' => ['value' => '587', 'type' => 'text', 'rules' => 'required|numeric'],
            'smtp_username' => ['value' => 'your_smtp_username', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'smtp_password' => ['value' => 'your_smtp_password', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'smtp_encryption' => ['value' => 'tls', 'type' => 'text', 'rules' => 'string|max:255'],
            'mail_from_address' => ['value' => 'your_from_email_address', 'type' => 'text', 'rules' => 'email|max:255'],
            'mail_from_name' => ['value' => 'your_from_name', 'type' => 'text', 'rules' => 'string|max:255'],
            'aws' => ['value' => '', 'type' => 'hidden'],
            's3_settings' => ['value' => 'S3 Setting', 'type' => 'heading'],
            'aws_access_key_id' => ['value' => 'your_aws_access_key_id', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'aws_secret_access_key' => ['value' => 'your_aws_secret_access_key', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'aws_default_region' => ['value' => 'us-east-1', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'aws_bucket' => ['value' => 'your_aws_bucket', 'type' => 'text', 'rules' => 'required|string|max:255'],
            'aws_use_path_style_endpoint' => ['value' => false, 'type' => 'toggle', 'rules' => 'boolean'],
        ]);

        if ($key && $type) {
            return $settings[$key][$type] ?? null;
        }

        return $settings;
    }
}

if (!function_exists('vite')) {
    function vite($resource, $buildDirectory = 'tallAdmin')
    {
        return app(Vite::class)($resource, $buildDirectory);
    }
}

if (!function_exists('viteCssPath')) {
    function viteCssPath(string $resource, $buildDirectory = 'tallAdmin')
    {
        return Str::of(vite($resource, $buildDirectory))->after('href="')->before('" />')->toString();
    }
}

if (!function_exists('viteJsPath')) {
    function viteJsPath(string $resource, $buildDirectory = 'tallAdmin')
    {
        return Str::of(vite($resource, $buildDirectory))->after('src="')->before('">')->toString();
    }
}

if (!function_exists('get_menu')) {
    function get_menu($name)
    {
        return Menu::getMenuByName($name);
    }
}


if (!function_exists('auth_staff')) {
    function auth_staff()
    {
        /** @var Staff $staff */
        $staff = Auth::user();

        return $staff;
    }
}


