<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\SpclController;
use App\Http\Controllers\Admin\QualCatgController;
use App\Http\Controllers\Admin\QualiController;
use App\Http\Controllers\Admin\PackageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/checks', function () {
//     return view('connection');    
// });
require __DIR__.'/auth.php';
Route::prefix('admin')->middleware(['admin'])->group( function () {
    Route::get('/profile', [AdminProfileController::class, 'viewProfile'])->name('admin.profile');
    Route::get('/profile/basicinfo', [AdminProfileController::class, 'basicInfo'])->name('admin.basic.info'); 
    Route::post('/profile/basicinfo/add', [AdminProfileController::class, 'basicinfoAdd'])->name('admin.add.basicinfo');
    Route::get('/profile/basicinfo/edit/{id}', [AdminProfileController::class, 'editBasicinfo'])->name('admin.basicinfo.edit');
    Route::post('/profile/basicinfo/update/{id}', [AdminProfileController::class, 'updateBasicinfo'])->name('admin.basicinfo.update');

    //profile image update
    Route::get('/profile/pic/edit/{id}', [AdminProfileController::class, 'editProfilePic'])->name('admin.profile.pic.edit');
    Route::post('/profile/pic/update/{id}', [AdminProfileController::class, 'updateProfilePic'])->name('admin.profile.pic.update');

    Route::post('/profile/edit/get-states-by-country', [AdminProfileController::class, 'getState']);
    Route::post('/profile/edit/get-cities-by-state', [AdminProfileController::class, 'getCity']);
    Route::post('/profile/update', [AdminProfileController::class, 'userProfileUpdate'])->name('admin.profile.update');

    //add country
    Route::get('/countries', [CountryController::class, 'index'])->name('admin.countries');
    Route::get('/add/country', [CountryController::class, 'create'])->name('add.country');
    Route::post('/country/store', [CountryController::class, 'store'])->name('store.country');
    Route::get('/country/edit/{country_code}', [CountryController::class, 'edit'])->name('edit.country');
    Route::post('/country/update/{country_code}', [CountryController::class, 'update'])->name('update.country');
    Route::get('/country/delete/{country_code}', [CountryController::class, 'delete'])->name('delete.country');

    Route::get('/states', [StateController::class, 'index'])->name('admin.states');
    Route::get('/add/state', [StateController::class, 'create'])->name('add.state');
    Route::post('/state/store', [StateController::class, 'store'])->name('store.state');
    Route::get('/state/edit/{state_code}', [StateController::class, 'edit'])->name('edit.state');
    Route::post('/state/update/{state_code}', [StateController::class, 'update'])->name('update.state');
    Route::get('/state/delete/{state_code}', [StateController::class, 'delete'])->name('delete.state');


    Route::get('/cities', [CityController::class, 'index'])->name('admin.cities');
    Route::get('/city/create', [CityController::class, 'create'])->name('add.city');
    Route::post('/city/get-state-by-country-code', [CityController::class, 'getState']);
    Route::post('/city/store', [CityController::class, 'store'])->name('store.city');
    Route::get('/city/edit/{city_code}', [CityController::class, 'edit'])->name('edit.city');
    Route::post('/city/update/{city_code}', [CityController::class, 'update'])->name('update.city');
    Route::get('/city/delete/{city_code}', [CityController::class, 'delete'])->name('delete.city');

    //specialization route
    Route::get('/specialization', [SpclController::class, 'index'])->name('admin.spcl');
    Route::get('/specialization/create', [SpclController::class, 'create'])->name('add.spcl');
    Route::post('/specialization/store', [SpclController::class, 'store'])->name('store.spcl');
    Route::get('/specialization/edit/{spcl_code}', [SpclController::class, 'edit'])->name('edit.spcl');
    Route::post('/specialization/update/{spcl_code}', [SpclController::class, 'update'])->name('update.spcl');
    Route::get('/specialization/delete/{spcl_code}', [SpclController::class, 'delete'])->name('delete.spcl');

    //education route
    Route::get('/education', [QualiController::class, 'index'])->name('admin.qual');
    Route::get('/education/create', [QualiController::class, 'create'])->name('add.qual');
    Route::post('/education/store', [QualiController::class, 'store'])->name('store.qual');
    Route::get('/education/edit/{qual_code}', [QualiController::class, 'edit'])->name('edit.qual');
    Route::post('/education/update/{qual_code}', [QualiController::class, 'update'])->name('update.qual');
    Route::get('/education/delete/{qual_code}', [QualiController::class, 'delete'])->name('delete.qual');

    //education categories route
    Route::get('/education/categories', [QualCatgController::class, 'index'])->name('admin.educatg');
    Route::get('/education/categ/create', [QualCatgController::class, 'create'])->name('add.educatg');
    Route::post('/education/categ/store', [QualCatgController::class, 'store'])->name('store.educatg');
    Route::get('/education/categ/edit/{qual_catg_code}', [QualCatgController::class, 'edit'])->name('edit.educatg');
    Route::post('/education/categ/update/{qual_catg_code}', [QualCatgController::class, 'update'])->name('update.educatg');
    Route::get('/education/categ/delete/{qual_catg_code}', [QualCatgController::class, 'delete'])->name('delete.educatg');

     //packages route
     Route::get('/packages', [PackageController::class, 'index'])->name('admin.package');
     Route::get('/package/create', [PackageController::class, 'create'])->name('add.package');
     Route::post('/package/store', [PackageController::class, 'store'])->name('store.package');
     Route::get('/package/edit/{package_id}', [PackageController::class, 'edit'])->name('edit.package');
     Route::post('/package/update/{package_id}', [PackageController::class, 'update'])->name('update.package');
     Route::get('/package/delete/{package_id}', [PackageController::class, 'delete'])->name('delete.package');
});
//for home page user display
Route::get('/', [HomeController::class, 'viewHome']);
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact.us');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.us');
Route::get('/lawyers/{state_code}', [HomeController::class, 'showByState']);
Route::get('/search/lawyers/{spcl_code}/{spcl}', [HomeController::class, 'showByCity']);
Route::get('/search/lawyers/{id}', [HomeController::class, 'detailsOfLawyers'])->name('lawyers.details');
//close user display

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/countries', [HomeController::class, 'viewCountry'])->middleware(['auth'])->name('countries');
Route::get('/dashboard/states', [HomeController::class, 'viewState'])->middleware(['auth'])->name('states');
Route::get('/dashboard/cities', [HomeController::class, 'viewCity'])->middleware(['auth'])->name('cities');

Route::middleware(['auth'])->group(function(){
    //for basic information
    Route::get('/user/profile', [ProfileController::class, 'viewProfile'])->name('profile');
    Route::get('/user/profile/basicinfo', [ProfileController::class, 'userBasicInfo'])->name('basicinfo'); 
    Route::post('/user/profile/basicinfo/add', [ProfileController::class, 'basicinfoAdd'])->name('add.basicinfo');
    Route::get('/user/profile/basicinfo/edit/{id}', [ProfileController::class, 'editBasicinfo'])->name('basicinfoEdit');
    Route::post('/user/profile/basicinfo/update/{id}', [ProfileController::class, 'updateBasicinfo'])->name('basicinfoUpdate');

    //profile image update
    Route::get('/user/profile/pic/edit/{id}', [ProfileController::class, 'editProfilePic'])->name('profile.pic.edit');
    Route::post('/user/profile/pic/update/{id}', [ProfileController::class, 'updateProfilePic'])->name('profile.pic.update');

    // Route::get('/user/profile/edit/profile/{id}', [ProfileController::class, 'editProfile'])->name('profileEdit');
    Route::post('/profile/edit/get-states-by-country', [ProfileController::class, 'getState']);
    Route::post('/profile/edit/get-cities-by-state', [ProfileController::class, 'getCity']);
    Route::post('/user/profile', [ProfileController::class, 'userProfileUpdate'])->name('profileUpdate');

    //for specialization
    Route::get('/user/profile/specialization', [ProfileController::class, 'specialization'])->name('specialization');
    Route::post('/user/profile/specialization/add', [ProfileController::class, 'specializationAdd'])->name('add.specialization');
    Route::get('/user/profile/specialization/edit/{id}', [ProfileController::class, 'editSpecialization'])->name('specializationEdit');
    Route::post('/user/profile/specialization/update/{id}', [ProfileController::class, 'specializationUpdate'])->name('update.specialization');
    
    //for education
    Route::get('/user/profile/education', [ProfileController::class, 'qualification'])->name('qualification');
    Route::post('/profile/get-education-by-qual-type', [ProfileController::class, 'getEducation']);
    Route::post('/user/profile/education/add', [ProfileController::class, 'qualificationAdd'])->name('add.qualification');
    Route::get('/user/profile/education/edit', [ProfileController::class, 'editQualification'])->name('qualificationEdit');
    Route::post('/user/profile/education/update', [ProfileController::class, 'updateQualification'])->name('qualificationUpdate');

    //for prtectecing court
    Route::get('/user/profile/practicing-court', [ProfileController::class, 'prectecingCourt'])->name('prectecing.court');
    Route::post('/profile/get-court-by-court-type', [ProfileController::class, 'getCourt']);
    Route::post('/user/profile/practicing-court/add', [ProfileController::class, 'prectecingCourtAdd'])->name('add.prectecing.court');
    Route::get('/user/profile/practicing-court/edit/{id}', [ProfileController::class, 'editPrectecingCourt'])->name('prectecingCourtEdit');
    Route::post('/profile/edit/get-court-by-court-type', [ProfileController::class, 'editGetCourt']);
    Route::post('/user/profile/practicing-court/update/{id}', [ProfileController::class, 'updatePrectecingCourt'])->name('update.prectecing.court');
});
