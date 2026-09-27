<?php

namespace Database\Seeders;

use Database\Seeders\AboutSeeder;
use Database\Seeders\CertificateSeeder;
use Database\Seeders\ChatbotCategorySeeder;
use Database\Seeders\ChatbotKnowledgeSeeder;
use Database\Seeders\ChatbotSettingSeeder;
use Database\Seeders\CounterSeeder;
use Database\Seeders\EducationSeeder;
use Database\Seeders\ExperienceSeeder;
use Database\Seeders\LegalPageSeeder;
use Database\Seeders\MediaSeeder;
use Database\Seeders\MessageSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\SeoSettingSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\SiteSettingSeeder;
use Database\Seeders\SkillSeeder;
use Database\Seeders\TestimonialSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // All seeders wrapped inside ONE single array
        $this->call([
            UserSeeder::class,

            AboutSeeder::class,
            MediaSeeder::class,

            ServiceSeeder::class,
            SkillSeeder::class,

            EducationSeeder::class,
            ExperienceSeeder::class,
            ProjectSeeder::class,
            TestimonialSeeder::class,
            CertificateSeeder::class,
            CounterSeeder::class,

            SiteSettingSeeder::class,
            SeoSettingSeeder::class,
            LegalPageSeeder::class,

            ChatbotCategorySeeder::class,
            ChatbotKnowledgeSeeder::class,
            ChatbotSettingSeeder::class,
        ]);
    }
}
