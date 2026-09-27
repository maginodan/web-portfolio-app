<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ChatbotCategoryController;
use App\Http\Controllers\Admin\ChatbotKnowledgeController;
use App\Http\Controllers\Admin\ChatbotSettingsController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\LegalPageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\ChatbotController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FrontendLegalPageController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

//PAGE ROUTE
Route::get('/', [PageController::class, 'index'])->name('pages.index');

//CONTACT & SUPPORT ROUTES
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/privacy-policy', [FrontendLegalPageController::class, 'privacy'])->name('privacy.show');
Route::get('/terms-of-use', [FrontendLegalPageController::class, 'terms'])->name('terms.show');

//Chatbot View Route
Route::get('/chatbot', [ChatbotController::class, 'widget'])->name('chatbot.widget');
//Chatbot Query Route (AJAX search)
Route::post('/chatbot/query', [ChatbotController::class, 'query'])->middleware('throttle:20,1')->name('chatbot.query');
//Chatbot Chat Route (proxies AI provider call server-side)
Route::post('/chatbot/chat', [ChatbotController::class, 'chat'])->middleware('throttle:20,1')->name('chatbot.chat');


//LOGIN & LOGOUT ROUTES
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
//LOGIN authenticate Route
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
//Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');



//Middleware Auth access to all pages
Route::middleware(['auth', 'verified', 'demo.mode'])->group(function(){
   
        //ADMIN ROUTE
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    //ABOUT ROUTES
    Route::get('/admin/abouts', [AboutController::class, 'edit'])->name('abouts.edit');
    //About patch or update
    Route::patch('/admin/abouts', [AboutController::class, 'update'])->name('abouts.update');


    //MEDIA ROUTES
    Route::get('/admin/medias', [MediaController::class, 'index'])->name('medias.index');
    //media post
    Route::post('/admin/medias', [MediaController::class, 'store'])->name('medias.store');
    Route::put('/admin/medias/{id}', [MediaController::class, 'update'])->name('medias.update');
    //media delete
    Route::delete('/admin/medias/{media}', [MediaController::class, 'destroy'])->name('medias.destroy');


    //SERVICES ROUTES
    Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services.index');
    //services store
    Route::post('/admin/services', [ServiceController::class, 'store'])->name('admin.services.store');
    //services get route
    Route::get('/admin/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    //services patch route
    Route::patch('/admin/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    //services delete route
    Route::delete('/admin/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');


    //SKILLS ROUTE
    Route::get('/admin/skills', [SkillController::class, 'index'])->name('admin.skills.index');
    //Skills post
    Route::post('/admin/skills', [SkillController::class, 'store'])->name('admin.skills.store');
    //Skills PATCH route
    Route::patch('/admin/skills/{skill}', [SkillController::class, 'update'])->name('admin.skills.update');
    //Skills delete route
    Route::delete('/admin/skills/{skill}', [SkillController::class, 'destroy'])->name('admin.skills.destroy');

    //COUNTERS ROUTES
    Route::get('/admin/counters', [CounterController::class, 'index'])->name('admin.counters.index');
    //Counter Post Route
    Route::post('/admin/counters', [CounterController::class, 'store'])->name('admin.counters.store');
    //Counter Update Route
    Route::patch('/admin/counters/{counter}', [CounterController::class, 'update'])->name('admin.counters.update');
    //Counter Delete Route
    Route::delete('/admin/counters/{counter}', [CounterController::class, 'destroy'])->name('admin.counters.destroy');

    //CERTIFICATE ROUTES
    Route::get('/admin/certificates', [CertificateController::class, 'index'])->name('admin.certificates.index');
        //Certificates create Route
    Route::get('/admin/certificates/create', [CertificateController::class, 'create'])->name('admin.certificates.create');
    //Certificates store Route
    Route::post('/admin/certificates/create', [CertificateController::class, 'store'])->name('admin.certificates.store');
    //Certificates edit Route
    Route::get('/admin/certificates/{certificate}/edit', [CertificateController::class, 'edit'])->name('admin.certificates.edit');
    //Certificates update or patch Route
    Route::patch('/admin/certificates/{certificate}', [CertificateController::class, 'update'])->name('admin.certificates.update');
    //Certificates Delete Route
    Route::delete('/admin/certificates/{certificate}', [CertificateController::class, 'destroy'])->name('admin.certificates.destroy');


    //EDUCATIONS ROUTES
    Route::get('/admin/educations', [EducationController::class, 'index'])->name('admin.educations.index');
    //Education Post Route
    Route::post('/admin/educations', [EducationController::class, 'store'])->name('admin.educations.store');
    //Education Update Route
    Route::patch('/admin/educations/{education}', [EducationController::class, 'update'])->name('admin.educations.update');
    //Education Delete Route
    Route::delete('/admin/educations/{education}', [EducationController::class, 'destroy'])->name('admin.educations.destroy');


    //EXPERIENCES ROUTES
    Route::get('/admin/experiences', [ExperienceController::class, 'index'])->name('admin.experiences.index');
    //Experience Post Routes
    Route::post('/admin/experiences', [ExperienceController::class, 'store'])->name('admin.experiences.store');
    //Experience Patch Routes
    Route::patch('/admin/experiences/{experience}', [ExperienceController::class, 'update'])->name('admin.experiences.update');
    //Experience Delete Routes
    Route::delete('/admin/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('admin.experiences.destroy');


    //PROJECTS ROUTES
    Route::get('/admin/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    //Projects create Route
    Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    //Projects store Route
    Route::post('/admin/projects/create', [ProjectController::class, 'store'])->name('admin.projects.store');
    //Projects edit Route
    Route::get('/admin/projects/{project}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    //Projects update or patch Route
    Route::patch('/admin/projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');
    //Projects Delete Route
    Route::delete('/admin/projects/{project}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');


    //TESTIMONIALS ROUTES
    Route::get('/admin/testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials.index');
    //Testimonials create Route
    Route::get('/admin/testimonials/create', [TestimonialController::class, 'create'])->name('admin.testimonials.create');
    //Testimonials Post Route
    Route::post('/admin/testimonials/create', [TestimonialController::class, 'store'])->name('admin.testimonials.store');
    //Testimonials Edit Route
    Route::get('/admin/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
    //Testimonials Update Route
    Route::patch('/admin/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('admin.testimonials.update');
    //Testimonials Delete Route
    Route::delete('/admin/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');


    //MESSAGES ROUTES
    Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    //Messages edit Route
    Route::get('/admin/messages/{message}', [MessageController::class, 'edit'])->name('admin.messages.edit');
    //Messages update_status Route
    Route::patch('/admin/messages/{message}', [MessageController::class, 'update_status'])->name('admin.messages.update_status');
    //Messages delete message Route
    Route::delete('/admin/messages/{message}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');


    //USER ROUTES
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    //User post Route
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    //User Patch Route
    Route::patch('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    //User Delete Route
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


    //USER ROUTES
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::patch('/admin/profile', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::patch('/admin/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password');


    //SITE SETTINGS ROUTES
    Route::get('/admin/settings', [SiteSettingController::class, 'edit'])->name('admin.settings.edit');
    Route::patch('/admin/settings', [SiteSettingController::class, 'update'])->name('admin.settings.update');

    //SEO SETTINGS ROUTES
    Route::get('/admin/seo', [SeoSettingController::class, 'edit'])->name('admin.seo.edit');
    Route::patch('/admin/seo', [SeoSettingController::class, 'update'])->name('admin.seo.update');

    Route::get('/admin/legal/{type}', [LegalPageController::class, 'edit'])->name('admin.legal.edit');
    Route::patch('/admin/legal/{type}', [LegalPageController::class, 'update'])->name('admin.legal.update');


    // ======================= CHATBOT ROUTES =======================
    Route::get('/admin/chatbot/settings', [ChatbotSettingsController::class, 'index'])->name('admin.chatbot.settings.index');
    Route::post('/admin/chatbot/settings/update', [ChatbotSettingsController::class, 'update'])->name('admin.chatbot.settings.update');

    Route::get('/admin/chatbot/knowledge', [ChatbotKnowledgeController::class, 'index'])->name('admin.chatbot.knowledge.index');
    Route::get('/admin/chatbot/knowledge/create', [ChatbotKnowledgeController::class, 'create'])->name('admin.chatbot.knowledge.create');
    Route::post('/admin/chatbot/knowledge/store', [ChatbotKnowledgeController::class, 'store'])->name('admin.chatbot.knowledge.store');
    Route::get('/admin/chatbot/knowledge/edit/{id}', [ChatbotKnowledgeController::class, 'edit'])->name('admin.chatbot.knowledge.edit');
    Route::put('/admin/chatbot/knowledge/update/{id}', [ChatbotKnowledgeController::class, 'update'])->name('admin.chatbot.knowledge.update');
    Route::delete('/admin/chatbot/knowledge/delete/{id}', [ChatbotKnowledgeController::class, 'destroy'])->name('admin.chatbot.knowledge.destroy');

    Route::get('/admin/chatbot/categories', [ChatbotCategoryController::class, 'index'])->name('admin.chatbot.categories.index');
    Route::get('/admin/chatbot/categories/create', [ChatbotCategoryController::class, 'create'])->name('admin.chatbot.categories.create');
    Route::post('/admin/chatbot/categories/store', [ChatbotCategoryController::class, 'store'])->name('admin.chatbot.categories.store');
    Route::get('/admin/chatbot/categories/edit/{id}', [ChatbotCategoryController::class, 'edit'])->name('admin.chatbot.categories.edit');
    Route::put('/admin/chatbot/categories/update/{id}', [ChatbotCategoryController::class, 'update'])->name('admin.chatbot.categories.update');
    Route::delete('/admin/chatbot/categories/delete/{id}', [ChatbotCategoryController::class, 'destroy']) ->name('admin.chatbot.categories.destroy');
        

    // ======================= CLEAR CACHE ROUTE =======================
    Route::get('/admin/clear-cache', function() {
        Artisan::call('optimize:clear');
        return redirect()->back()->with('success', 'All caches cleared successfully!');
    });

});





