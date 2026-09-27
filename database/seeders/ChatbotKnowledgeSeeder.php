<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatbotKnowledgeSeeder extends Seeder
{
    public function run(): void
    {
        $personalInformation = DB::table('chatbot_categories')
            ->where('name', 'Personal Information')
            ->value('id');

        $contact = DB::table('chatbot_categories')
            ->where('name', 'Contact')
            ->value('id');

        DB::table('chatbot_knowledge')->insert([
            [
                'title' => 'About Magino Daniel',
                'content' => "Magino Daniel, also known as Kent Danielz, is a Ugandan Software Developer with hands-on experience in full-stack software development, systems administration, database management, and AI-driven solutions.\n\nHe specializes in designing, developing, deploying, and maintaining secure and scalable software applications and technology systems.\n\nHis technical background includes Laravel, Django, ASP.NET Core, CodeIgniter, Next.js, PHP, Python, JavaScript, SQL, Linux systems administration, VPS deployment, database management, AI, machine learning, computer vision, Retrieval-Augmented Generation (RAG), and Generative AI.\n\nMagino is passionate about building practical, secure, efficient, and scalable software solutions while continuously learning and applying emerging technologies.",
                'category_id' => $personalInformation,
                'keywords' => 'about, bio, Magino Daniel, Kent Danielz, developer, software developer, full stack, profile, background',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Contact Information',
                'content' => "Magino Daniel can be contacted through the following channels:\n\nPhone: +256 772 842 331\nEmail: maginodan@gmail.com\nPortfolio: https://maginodaniel.com\nLinkedIn: https://www.linkedin.com/in/magino-daniel-06ab90208/\nGitHub: https://github.com/maginodan\n\nMagino is based in Uganda.",
                'category_id' => $contact,
                'keywords' => 'contact, email, phone, telephone, portfolio, website, LinkedIn, GitHub, social media, reach Daniel',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}