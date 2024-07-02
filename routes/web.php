<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\C3\Chart;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller(StockController::class)->group(function () {
    Route::get('/TableType', 'TP')->name('TableType');
    Route::post('/AddType', 'TypeProduct')->name('type.product');
    Route::put('/UpdateType', 'updateType')->name('type.update');
    Route::get('/types/search', 'searchType')->name('type.search');
    Route::delete('/deleteType{Type_Id}', 'DelType')->name('type.delete');

    Route::get('/TableUnit', 'UN')->name('TableUnit');
    Route::post('/AddUnit', 'Unit')->name('unit.product');
    Route::put('/UpdateUnit', 'updateUnit')->name('unit.update');
    Route::get('/units/search', 'searchUnit')->name('unit.search');
    Route::delete('/deleteUnit{Un_Id}', 'DelUnit')->name('unit.delete');

    Route::get('/TableFac', 'FAC')->name('TableFac');
    Route::post('/AddFac', 'Factory')->name('factory.add');
    Route::put('/UpdateFac','updateFac')->name('factory.update');
    Route::get('/Fac/search', 'searchFac')->name('factory.search');
    Route::get('/get-factory-details/{id}', 'getFactoryDetails');
    Route::delete('/DeleteFac{Fac_Id}', 'DelFac')->name('factory.delete');

    Route::get('/TableProduct', 'index')->name('TableProduct');
    Route::post('/AddProduct', 'Stock')->name('product.add');
    Route::put('/UpdateProduct','updatePro')->name('product.update');
    Route::get('/Pro/search', 'searchPro')->name('product.search');
    Route::delete('/DeleteProduct{Pro_Id}', 'DelPro')->name('product.delete');

    Route::get('/TableReport','showReportForm')->name('TableReport');
    Route::get('/report/result','generateReport')->name('report.result');
    Route::get('/Report/search', 'searchReport')->name('report.searchByDate');

    Route::get('/chart-data', 'getChartData')->name('chart-data');

});


Route::controller(LoginController::class)->group(function(){
    Route::get('/','showLoginForm')->name('login');
    Route::post('/login','processLogin')->name('login.process');

    Route::get('/logout','logout')->name('logout');
});

Route::controller(DownloadController::class)->group(function(){
    Route::get('/Download','PDFdownload')->name('download-pdf');
});

Route::controller(DashboardController::class)->group(function(){
    Route::get('dashboard','Dashboard');
});
Route::controller(ChartController::class)->group(function(){
    Route::get('chart', 'Chart')->name('chart-data');
    Route::get('chartproduct', 'ChartProduct')->name('chart-data');
    Route::get('chartfactory', 'ChartFactory')->name('chart-data');
});
