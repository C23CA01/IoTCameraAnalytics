<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\dashboard\Meeting;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;


// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::post('/auth/login-process', [LoginBasic::class, 'login_process'])->name('login-process');
Route::get('/auth/logout', [LoginBasic::class, 'logout'])->name('logout');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::post('/auth/register-process', [RegisterBasic::class, 'register_process'])->name('register-process');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// Main Page Route
Route::group(['prefix'=> 'admin','middleware' => ['auth'], 'as' => 'admin.'], function(){
    Route::get('/parking', [Analytics::class, 'index'])->name('dashboard-analytics');
    Route::get('/parking', [Analytics::class, 'parkingData'])->name('dashboard-analytics');
    Route::get('/meeting', [Meeting::class, 'index'])->name('dashboard-meeting');
});


