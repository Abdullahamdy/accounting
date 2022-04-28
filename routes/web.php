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

Route::get('/login', \App\Http\Livewire\Login::class)->name('login');
Route::middleware('guest')->group(function () {
    Route::get('/register', \App\Http\Livewire\Register::class)->name('register');
    Route::get('/forgot', \App\Http\Livewire\Forgot::class)->name('forgot');
    Route::get('/password/restore/{token}', \App\Http\Livewire\ResetToken::class)->name('restore');
});

Route::middleware('auth')->group(function (){
    Route::get('/', \App\Http\Livewire\Home::class)->name('home');
    Route::get('/logout', \App\Http\Livewire\Logout::class)->name('logout');
    Route::get('/profile', \App\Http\Livewire\Profile::class)->name('profile');
    Route::get('/users', \App\Http\Livewire\Users\Users::class)->name('users');
    Route::get('/user/profile/{user_id}', \App\Http\Livewire\Users\UserShow::class)->name('users.show');
    Route::get('/roles', \App\Http\Livewire\Users\Roles\Roles::class)->name('users.roles');
    Route::get('/index-accounts', \App\Http\Livewire\IndexAccounts\IndexAccounts::class)->name('index-accounts');
    Route::get('/index-accounts/{index_account_id}', \App\Http\Livewire\IndexAccounts\IndexAccountShow::class)->name('index-accounts.show');
    Route::get('/account-guides', \App\Http\Livewire\AccountGuides\AccountGuides::class)->name('account-guides');
    Route::get('/account-guides/{account_guide_id}', \App\Http\Livewire\AccountGuides\AccountGuideShow::class)->name('account-guides.show');
    Route::get('/items', \App\Http\Livewire\Items\Items::class)->name('items');
    Route::get('/items/{item_id}', \App\Http\Livewire\Items\ItemShow::class)->name('items.show');
    Route::get('/invoices', \App\Http\Livewire\Invoices\Invoices::class)->name('invoices');
    Route::get('/invoices/{invoice_id}', \App\Http\Livewire\Invoices\InvoiceShow::class)->name('invoices.show');
    Route::get('/invoice-items/{invoice_id}', \App\Http\Livewire\InvoiceItems\InvoiceItems::class)->name('invoice-items');
    Route::get('/invoice-items/{invoice_item_id}', \App\Http\Livewire\InvoiceItems\InvoiceItemShow::class)->name('invoice-items.show');
    Route::get('/invoice-discounts/{invoice_id?}', \App\Http\Livewire\InvoiceDiscounts\InvoiceDiscounts::class)->name('invoice-discounts');
    Route::get('/invoice-discounts/{invoice_discount_id}', \App\Http\Livewire\InvoiceDiscounts\InvoiceDiscountShow::class)->name('invoice-discounts.show');
    Route::get('/arrest-receipts/{invoice_id?}', \App\Http\Livewire\ArrestReceipts\ArrestReceipts::class)->name('arrest-receipts');
    Route::get('/details-show/{arrest_receipt_id}', \App\Http\Livewire\ArrestReceipts\ArrestReceiptShow::class)->name('details-receipts.show');
    Route::get('/settings', \App\Http\Livewire\Settings\Settings::class)->name('settings');
    Route::get('/settings/{setting_id}', \App\Http\Livewire\Settings\SettingShow::class)->name('settings.show');
    Route::get('/payrolls', \App\Http\Livewire\Payrolls\Payrolls::class)->name('payrolls');
    Route::get('/payrolls/{payroll_id}', \App\Http\Livewire\Payrolls\PayrollShow::class)->name('payrolls.show');
    Route::get('/categories', \App\Http\Livewire\Categories\Categories::class)->name('categories');
    Route::get('/categories/{category_id}', \App\Http\Livewire\Categories\CategoryShow::class)->name('categories.show');
    Route::get('/units', \App\Http\Livewire\Units\Units::class)->name('units');
    Route::get('/units/{unit_id}', \App\Http\Livewire\Units\UnitShow::class)->name('units.show');
    Route::get('/serial-numbers', \App\Http\Livewire\SerialNumbers\SerialNumbers::class)->name('serial-numbers');
    Route::get('/serial-numbers/{serial_number_id}', \App\Http\Livewire\SerialNumbers\SerialNumberShow::class)->name('serial-numbers.show');
});
