<?php

namespace App\Http\Controllers\Admin;

use App\Models\LegalPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LegalPageController extends Controller
{
    public function edit($type)
    {
        $page = LegalPage::where('type', $type)->firstOrFail();
        return view('admin.legal.edit', compact('page'));
    }

    public function update(Request $request, $type)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $page = LegalPage::where('type', $type)->firstOrFail();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->save();

        return redirect()->route('admin.legal.edit', $type)->with('success', ucfirst($type) . ' page updated successfully!');
    }
}