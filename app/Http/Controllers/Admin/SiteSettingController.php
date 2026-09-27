<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::first() ?? new SiteSetting();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'footer_text' => 'nullable|string|max:255',
            'hcaptcha_enabled' => 'nullable|boolean',
            'hcaptcha_site_key' => 'nullable|required_if:hcaptcha_enabled,1|string|max:255',
            'hcaptcha_secret_key' => 'nullable|required_if:hcaptcha_enabled,1|string|max:255',
            'primary_color' => 'nullable|string|max:7',
            'logo_light' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'logo_dark' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon' => 'nullable|file|mimes:png,ico,svg|max:512',
            'cookie_consent_enabled' => 'nullable|boolean',
            'cookie_consent_text' => 'nullable|string|max:1000',
            'cookie_accept_text' => 'nullable|string|max:50',
            'cookie_decline_text' => 'nullable|string|max:50',
            'cookie_privacy_text' => 'nullable|string|max:50',
            'cookie_privacy_url' => 'nullable|string|max:255',
        ]);

        $setting = SiteSetting::first() ?? new SiteSetting();

        $setting->footer_text = $request->footer_text;
        $setting->hcaptcha_site_key = $request->hcaptcha_site_key;
        $setting->hcaptcha_secret_key = $request->hcaptcha_secret_key;
        $setting->hcaptcha_enabled = $request->boolean('hcaptcha_enabled');
        $setting->primary_color = $request->primary_color ?: $setting->primary_color;

        $setting->cookie_consent_enabled = $request->boolean('cookie_consent_enabled');
        $setting->cookie_consent_text = $request->cookie_consent_text;
        $setting->cookie_accept_text = $request->cookie_accept_text ?: 'Accept all';
        $setting->cookie_decline_text = $request->cookie_decline_text ?: 'Necessary only';
        $setting->cookie_privacy_text = $request->cookie_privacy_text ?: 'Privacy Policy';
        $setting->cookie_privacy_url = $request->cookie_privacy_url;

        if ($request->hasFile('logo_light')) {
            $this->replaceFile($setting, 'logo_light', $request->file('logo_light'));
        }

        if ($request->hasFile('logo_dark')) {
            $this->replaceFile($setting, 'logo_dark', $request->file('logo_dark'));
        }

        if ($request->hasFile('favicon')) {
            $this->replaceFile($setting, 'favicon', $request->file('favicon'));
        }

        $setting->save();

        return redirect()->route('admin.settings.edit')->with('success', 'Site Settings Updated Successfully!');
    }

    private function replaceFile(SiteSetting $setting, string $field, $file): void
    {
        // 1. Get the existing filename BEFORE modifying $setting->$field
        $oldFile = $setting->$field;

        // 2. Generate new unique filename
        $fileName = time() . '_' . $field . '.' . $file->getClientOriginalExtension();

        // 3. Move uploaded file to destination folder
        $file->move(public_path('uploads/settings'), $fileName);

        // 4. Update the model property
        $setting->$field = $fileName;

        // 5. Delete the old file if it existed
        if ($oldFile) {
            $oldPath = public_path('uploads/settings/' . $oldFile);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }
    }
}