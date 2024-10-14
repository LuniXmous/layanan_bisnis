<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['verify' => true,
                'register' => false, // Registration Routes...
                'reset' => false,
            ]);
Route::get('/sso/login', [App\Http\Controllers\UserController::class, 'loginSSO'])->name('sso.login');
Route::get('/sso/cb', [App\Http\Controllers\UserController::class, 'callbackSSO'])->name('sso.callback');
Route::post('/sso/cb', [App\Http\Controllers\UserController::class, 'registerSSO'])->name('sso.register');

if (env('GOD_MODE')) {
    Route::prefix('god_mode')->name('god_mode.')->group(function () {
        Route::get('forcelogin/{id}', [App\Http\Controllers\UserController::class, 'forceLogin'])->name('forcelogin');
    });
}

Route::group(['middleware' => ['verified', 'auth']], function () {
    // ? MIDDLEWARE AUTH LOGGED IN, WHATEVER ROLE
    //api
    Route::get('/api/category/{id}', [App\Http\Controllers\CategoryController::class, 'getCategoryByUnit'])->name('api.category');
    Route::get('/api/activity/{categoryID}/{unitID}', [App\Http\Controllers\ActivityController::class, 'getActivityByCategory'])->name('api.activity');

    //api end
    Route::get('/roleCheck', [App\Http\Controllers\RoleController::class, 'checkRole'])->name('role.check');
    Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::post('profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');


    if (env('GOD_MODE')) {
        // ? MANAJEMEN PENGGUNA ROUTES
        Route::prefix('pengguna')->name('user.')->group(function () {
            Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('index');
            Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
            Route::post('create', [App\Http\Controllers\UserController::class, 'store'])->name('store');
            Route::get('{id}/delete', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete');
            Route::get('{id}/update', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
            Route::post('{id}/update', [App\Http\Controllers\UserController::class, 'updateUser'])->name('update');
        });
        // ? MANAJEMEN UNIT ROUTES
        Route::prefix('unit')->name('unit.')->group(function () {
            Route::get('/', [App\Http\Controllers\UnitController::class, 'index'])->name('index');
            Route::post('create', [App\Http\Controllers\UnitController::class, 'store'])->name('store');
            Route::get('/{id}', [App\Http\Controllers\UnitController::class, 'show'])->name('detail');
            Route::post('/{id}/activity', [App\Http\Controllers\UnitController::class, 'updateOrCreateActivity'])->name('updateOrCreateActivity');
        });


    } else {
        // ? MIDDLEWARE AUTH LOGGED IN & IS ADMIN
        Route::group(['middleware' => ['isAdmin']], function () {
            // ? MANAJEMEN PENGGUNA ROUTES
            Route::prefix('pengguna')->name('user.')->group(function () {
                Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('index');
                Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
                Route::post('create', [App\Http\Controllers\UserController::class, 'store'])->name('store');
                Route::get('{id}/delete', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete');
                Route::get('{id}/update', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
                Route::post('{id}/update', [App\Http\Controllers\UserController::class, 'updateUser'])->name('update');
            });
            // ? MANAJEMEN UNIT ROUTES
            Route::prefix('unit')->name('unit.')->group(function () {
                Route::get('/', [App\Http\Controllers\UnitController::class, 'index'])->name('index');
                Route::post('create', [App\Http\Controllers\UnitController::class, 'store'])->name('store');
                Route::get('/{id}', [App\Http\Controllers\UnitController::class, 'show'])->name('detail');
                Route::post('/{id}/activity', [App\Http\Controllers\UnitController::class, 'updateOrCreateActivity'])->name('updateOrCreateActivity');
            });
        });
    }

    // ? PENGAJUAN ROUTES
    Route::prefix('application')->name('application.')->group(function () {
        // ? MIDDLEWARE ROLE PEMOHON ONLY
        Route::group(['middleware' => 'isApplicant'], function () {
            Route::get('create', [App\Http\Controllers\ApplicationController::class, 'create'])->name('create');
            Route::post('create', [App\Http\Controllers\ApplicationController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [App\Http\Controllers\ApplicationController::class, 'edit'])->name('edit');
            Route::post('/{id}/edit', [App\Http\Controllers\ApplicationController::class, 'update'])->name('update');
            // Route::get('/{id}/edit/extra', [App\Http\Controllers\ApplicationController::class, 'edit'])->name('extra.edit');
            // Route::post('/{id}/edit/extra', [App\Http\Controllers\ApplicationController::class, 'updateExtra'])->name('extra.update');
            Route::get('/{id}/done', [App\Http\Controllers\ApplicationController::class, 'done'])->name('done');
            Route::post('/{id}/applys', [App\Http\Controllers\ApplicationController::class, 'applyExtra'])->name('applyExtra');
    
        });

        // ? MIDDLEWARE ROLE ADMIN, WADIR 4, DIREKTUR, ADMIN UNIT
        // Route::group(['middleware' => 'isAdmin', 'isAdminUnit', 'isWadir4', 'isDirektur'], function () {
        Route::get('/{id}/approve', [App\Http\Controllers\ApplicationController::class, 'approve'])->name('approve');
        Route::post('/{id}/approve', [App\Http\Controllers\ApplicationController::class, 'approveWithFile'])->name('approveWithFile');
        Route::post('/{id}/reject', [App\Http\Controllers\ApplicationController::class, 'reject'])->name('reject');
        Route::get('/export', [App\Http\Controllers\ApplicationController::class, 'export'])->name('export');
        // });
        // ? MIDDLEWARE AUTH LOGGED IN, WHATEVER ROLE
        Route::get('', [App\Http\Controllers\ApplicationController::class, 'index'])->name('index');
        Route::get('/tebusan', [App\Http\Controllers\ApplicationController::class, 'indexTebusan'])->name('tebusan');
        // Add the new route here
        Route::get('/{id}/submission-log', [App\Http\Controllers\ApplicationController::class, 'showSubmissionLog'])->name('submissionLog');
        Route::get('/{identifier}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('detail');
        Route::get('/data', action: [App\Http\Controllers\ApplicationController::class, 'getData'])->name('data');
    });
    // Grup route manajemen pengguna
        Route::group(['middleware' => ['isAdminOrWadir4']], function () {
            Route::prefix('pengguna')->name('user.')->group(function () {
                Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('index');
                Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
                Route::post('create', [App\Http\Controllers\UserController::class, 'store'])->name('store');
                Route::get('{id}/delete', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete');
            });
    });
    Route::get('application/adminData', [App\Http\Controllers\ApplicationController::class, 'adminData'])->name('application.adminData');
    Route::get('application/wadir4Data', [App\Http\Controllers\ApplicationController::class, 'wadir4Data'])->name('application.wadir4Data');    
});
