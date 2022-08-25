<?php

use App\Models\EpsilonAccountService;
use Illuminate\Http\Request;
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
    $accountServices = auth()->user()->accountServices()->latest()->paginate(10);
    return view('dashboard', compact('accountServices'));
})->middleware(['auth'])->name('dashboard');

Route::get('/manualySyncRemoteServices', function () {
    
    try {
        EpsilonAccountService::getSyncRemoteAccountServices();
    } catch (\Throwable $th) {
        throw $th;
    }
    return redirect('/');

})->middleware(['auth']);

Route::get('/services/{service}/view', function (EpsilonAccountService $service) {
    return view('service', compact('service'));
})->middleware(['auth'])->name('services.view');

Route::get('/user/credentials/epsilon', function () {
    return view('epsilon_credentials');
})->middleware(['auth'])->name('credentials.epsilon');

Route::post('/user/credentials/epsilon', function (Request $request) {

    $request->validate([
        'epsilon_client_id' => 'required',
        'epsilon_client_secret' => 'required',
    ]);

    auth()->user()->update([
        'epsilon_client_id' => $request->epsilon_client_id,
        'epsilon_client_secret'=> $request->epsilon_client_secret,
    ]);

    return redirect('/');
})->middleware(['auth']);
 
 
require __DIR__.'/auth.php';
