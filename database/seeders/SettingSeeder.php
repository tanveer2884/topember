<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = get_general_site_settings();
        foreach ($settings as $key => $setting) {
            $createSetting = Setting::firstOrCreate([
                'key' => $key,
            ], [
                'user_id' => null,
                'key' => $key,
                'value' => $setting['type'] == 'file' ? 'file' : $setting['value'],
            ]);
            if ($setting['type'] == 'file') {
                $createSetting->clearMediaCollection($key);
                //add logo image
                $createSetting
                    ->addMedia(public_path($setting['value']))
                    ->preservingOriginal()
                    ->withCustomProperties(['caption' => null, 'primary' => true, 'position' => 1])
                    ->toMediaCollection($key);
            }
        }
    }
}
