<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\LegalPage;

class FrontendLegalPageController extends Controller
{
    public function privacy()
    {
        $page = LegalPage::where('type', 'privacy')->firstOrFail();
        return view('pages.legal.index', compact('page'));
    }

    public function terms()
    {
        $page = LegalPage::where('type', 'terms')->firstOrFail();
        return view('pages.legal.index', compact('page'));
    }
}