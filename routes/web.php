<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\Catalog\CategoryController;
use App\Http\Controllers\Admin\Catalog\TagController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\Catalog\TechnologyController;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/test-email', [HomeController::class, 'testemail']);
Route::post('/contact-us', [HomeController::class, 'ContectUs'])->name('ContectUs');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/profile-store', [DashboardController::class, 'profileStore'])->name('admin.profileStore');

    Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('admin.changePassword');
    Route::put('/change-password-update', [DashboardController::class, 'changePasswordupdate'])->name('admin.changePasswordupdate');


    //Start Category Route
    Route::prefix('admin/category')->name('admin.category.')->group(function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('categoryList');
        Route::post('/store', [CategoryController::class, 'catStore'])->name('catStore');
        Route::post('/update-category', [CategoryController::class, 'catUpdate'])->name('catUpdate');
        Route::post('/delete-category/{id}', [CategoryController::class, 'catDestroy'])->name('catDestroy');
    });
    //End Category Route

    //Start Technology  Route
    Route::prefix('admin/technology')->name('admin.technology.')->group(function () {
        Route::get('/list', [TechnologyController::class, 'index'])->name('technologyList');
        Route::post('/store', [TechnologyController::class, 'technologyStore'])->name('technologyStore');
        Route::post('/update-technology', [TechnologyController::class, 'technologyUpdate'])->name('technologyUpdate');
        Route::post('/delete-technology/{id}', [TechnologyController::class, 'technologyDestroy'])->name('technologyDestroy');
    });
   //End Technology  Route

    //Start Tags  Route
    Route::prefix('admin/tags')->name('admin.tags.')->group(function () {
        Route::get('/list', [TagController::class, 'index'])->name('tagList');
        Route::post('/store', [TagController::class, 'tagStore'])->name('tagStore');
        Route::post('/update-tags', [TagController::class, 'tagUpdate'])->name('tagUpdate');
        Route::post('/delete-tags/{id}', [TagController::class, 'tagDestroy'])->name('tagDestroy');
    });
   //End Tags  Route

   //Start Blog Route
    Route::get('/admin/blog', [BlogController::class, 'index'])->name('admin.blogList');
    Route::get('/admin/blog-add', [BlogController::class, 'blogCreate'])->name('admin.blogCreate');
    Route::post('/admin/blog-store', [BlogController::class, 'blogStore'])->name('admin.blogStore');
    Route::get('/admin/blog-edit/{id}', [BlogController::class, 'blogEdit'])->name('admin.blogEdit');
    Route::post('/admin/update-blog/{id}', [BlogController::class, 'blogUpdate'])->name('admin.blogUpdate');
    Route::post('/admin/delete-blog/{id}', [BlogController::class, 'blogDestroy'])->name('admin.blogDestroy');

    //End Blog Route

    //Start project Route
    Route::prefix('admin/projects')->name('admin.projects.')->group(function () {
        Route::get('/all', [ProjectController::class, 'index'])->name('all');
        Route::get('/completed', [ProjectController::class, 'completed'])->name('completed');
        Route::get('/incomplete', [ProjectController::class, 'incomplete'])->name('incomplete');
        Route::get('/ongoing', [ProjectController::class, 'ongoing'])->name('ongoing');
        Route::get('/pipeline', [ProjectController::class, 'pipeline'])->name('pipeline');
        Route::get('/rejected', [ProjectController::class, 'rejected'])->name('rejected');
    });
    Route::get('/admin/project-add', [ProjectController::class, 'addProject'])->name('admin.addProject');
    Route::post('/admin/project-store', [ProjectController::class, 'projectStore'])->name('admin.projectStore');
    Route::post('/admin/project-delete/{id}', [ProjectController::class, 'projectDestroy'])->name('admin.projectDestroy');
    Route::get('/admin/project-payments/{id}', [ProjectController::class, 'projectPayents'])->name('admin.projectPayents');
    Route::get('/admin/project-quotation/{id}', [ProjectController::class, 'projectquotation'])->name('admin.projectquotation');

    //End project Route

    //Start client Route
    Route::prefix('admin/clients')->name('admin.clients.')->group(function () {
        Route::get('/all', [ClientsController::class, 'index'])->name('clientsList');
        Route::get('/add', [ClientsController::class, 'addClient'])->name('addClient');
        Route::post('/store', [ClientsController::class, 'clientStore'])->name('clientStore');
        Route::get('/edit/{id}', [ClientsController::class, 'clientEdit'])->name('clientEdit');
        Route::put('/update/{id}', [ClientsController::class, 'clientUpdate'])->name('clientUpdate');
        Route::post('/delete/{id}', [ClientsController::class, 'clientDestroy'])->name('clientDestroy');
    });
    //End client Route




    //Start portfolio Route
    Route::get('/admin/portfolio', [PortfolioController::class, 'index'])->name('admin.galleryList');
    Route::post('/admin/portfolio-store', [PortfolioController::class, 'gallStore'])->name('admin.gallStore');
    Route::post('/admin/delete-portfolio/{id}', [PortfolioController::class, 'galDestroy'])->name('admin.galDestroy');

    //End gallery Route


    //Start contact Route
    Route::get('/admin/contact-list', [ContactController::class, 'index'])->name('admin.contactList');
    Route::post('/admin/contact-store', [ContactController::class, 'store'])->name('admin.contactstore');
    //End contact Route

    //Start Enquiry Route
    Route::get('/admin/enquiry-list', [EnquiryController::class, 'index'])->name('admin.enquiryList');
    Route::post('/admin/delete-enquiry/{id}', [EnquiryController::class, 'enquiryDestroy'])->name('admin.enquiryDestroy');
    //End Enquiry Route

    //Start Testimonials Route
    Route::get('/admin/testimonial-list', [TestimonialsController::class, 'index'])->name('admin.testimoniallist');
    Route::post('/admin/testimonial-store', [TestimonialsController::class, 'testimonialStore'])->name('admin.testimonialStore');
    Route::post('/admin/testimonial-update', [TestimonialsController::class, 'testimonialUpdate'])->name('admin.testimonialUpdate');
    Route::post('/admin/delete-testimonial/{id}', [TestimonialsController::class, 'testimonialDestroy'])->name('admin.testimonialDestroy');
    //End Testimonials Route

    //Start faq Route
    Route::get('/admin/faq-list', [FaqController::class, 'index'])->name('admin.faqlist');
    Route::post('/admin/faq-store', [FaqController::class, 'faqStore'])->name('admin.faqStore');
    Route::post('/admin/faq-update', [FaqController::class, 'faqUpdate'])->name('admin.faqUpdate');
    Route::post('/admin/delete-faq/{id}', [FaqController::class, 'faqDestroy'])->name('admin.faqDestroy');
    //End faq Route
});
