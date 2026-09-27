<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoSettingController extends Controller
{
    public function edit()
    {
        $seo = SeoSetting::first() ?? new SeoSetting();
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_author' => 'nullable|string|max:255',
            'twitter_handle' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $seo = SeoSetting::first() ?? new SeoSetting();

        $seo->meta_title = $request->meta_title;
        $seo->meta_description = $request->meta_description;
        $seo->meta_keywords = $request->meta_keywords;
        $seo->meta_author = $request->meta_author;
        $seo->twitter_handle = $request->twitter_handle;
        $seo->canonical_url = $request->canonical_url;

        if ($request->hasFile('og_image')) {
            $old = public_path('uploads/settings/' . $seo->og_image);
            if ($seo->og_image && file_exists($old)) {
                @unlink($old);
            }

            $fileName = time() . '_og.' . $request->og_image->getClientOriginalExtension();
            $request->og_image->move(public_path('uploads/settings'), $fileName);
            $seo->og_image = $fileName;
        }

        $seo->save();

        return redirect()->route('admin.seo.edit')->with('success', 'SEO Settings Updated Successfully!');
    }
}