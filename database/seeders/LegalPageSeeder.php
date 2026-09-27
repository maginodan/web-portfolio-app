<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegalPageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('legal_pages')->insert([
            [
                'type' => 'privacy',
                'title' => 'Privacy Policy',
                'meta_title' => 'Privacy Policy || Magino Daniel',
                'meta_description' => 'Learn how Magino Daniel collects, uses, and protects your personal information when you visit this website or submit the contact form.',
                'content' => "This Privacy Policy explains how I collect, use, and protect the personal information you share through this website.\n\nWhen you submit the contact form, I collect your name, email address, subject, and message. This information is used solely to respond to your inquiry and is never sold or shared with third parties.\n\nYour data is stored securely and retained only for as long as necessary to address your inquiry. If you would like your information removed from my records, please contact me directly and I will process your request promptly.\n\nThis site does not use tracking cookies or third-party analytics beyond what is required for the site to function.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'terms',
                'title' => 'Terms of Use',
                'meta_title' => 'Terms of Use || Magino Daniel',
                'meta_description' => "Read the terms and conditions governing your use of Magino Daniel's portfolio website, including content ownership and usage guidelines.",
                'content' => "By accessing and using this website, you agree to the following terms.\n\nAll content on this site, including project descriptions, images, and written material, is the property of the site owner unless otherwise credited, and may not be reproduced without permission.\n\nThis website is provided for informational purposes. While every effort is made to keep information accurate and up to date, no guarantees are made regarding completeness or accuracy.\n\nAny inquiries submitted through the contact form do not constitute a binding agreement of any kind; they are simply a means of communication.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}