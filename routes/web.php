<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CityController;
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
    Route::get('/add/county', [CountryController::class, 'create'])->name('add.country');
    
    Route::get('/dashboard/countries', [CityController::class, 'index'])->name('admin.countries');
    Route::get('/dashboard/states', [CityController::class, 'index'])->name('admin.states');

    Route::get('/dashboard/cities', [CityController::class, 'index'])->name('admin.cities');
    Route::get('/dashboard/city/create', [CityController::class, 'create'])->name('add.city');
    Route::post('/dashboard/city/store', [CityController::class, 'store'])->name('store.city');
    Route::post('/dashboard/city/edit/{city_code}', [CityController::class, 'edit'])->name('edit.city');
});
//for home page user display
Route::get('/', [HomeController::class, 'viewHome']);
Route::get('/lawyers/{state_code}', [HomeController::class, 'showByState']);
Route::get('/search/lawyers/{state}/{city_name}', [HomeController::class, 'showByCity']);
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
// Route::get('/dashboard/user/profile', [ProfileController::class, 'viewProfile'])->middleware(['auth'])->name('profile');
// Route::post('/dashboard/user/profile', [ProfileController::class, 'userProfileUpdate'])->middleware(['auth'])->name('profileUpdate');
