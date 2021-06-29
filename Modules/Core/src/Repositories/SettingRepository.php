<?php


namespace Topdot\Core\Repositories;


use Topdot\Core\Models\TempMedia;
use Illuminate\Http\Request;

class SettingRepository
{
    public function update(Request $request)
    {

        saveGeneralSetting("site_title",$request->site_title);

        if ( $request->hasFile('site_logo')  ){
            $media = TempMedia::create()->addMediaFromRequest('site_logo')->toMediaCollection('site_logo');
            saveGeneralSetting("site_logo",route('api.medias.show',$media));
        } 
        
        saveGeneralSetting("copyright_text",$request->copyright_text);
        saveGeneralSetting("store_contact_email",$request->store_contact_email);
        saveGeneralSetting("store_contact_phone",$request->store_contact_phone);
        saveGeneralSetting("store_contact_address",$request->store_contact_address);
        saveGeneralSetting("facebook_url",$request->facebook_url);
        saveGeneralSetting("twitter_url",$request->twitter_url);
        saveGeneralSetting("linkedin_url",$request->linkedin_url);
        saveGeneralSetting("instagram_url",$request->instagram_url);

        saveGeneralSetting("contact_us_email",$request->contact_us_email);

        // Auth::user()->update([
        //     'timezone' => $request->timezone
        // ]);

        return true;
    }
}
