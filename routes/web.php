<?php

use App\Http\Controllers\ShipsController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\PHP;

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
    $user = App\Models\User::first();
    $ship = $user->ships->first();
    return
        'Galaxy Location: ' . $ship->GalaxyX . ':' . $ship->GalaxyY .
        PHP_EOL . '<br />Solar System Location: ' .  $ship->SolarSystemX . ':' . $ship->SolarSystemY;
});

Route::get('/ship/find/of/{user}', [ShipsController::class, 'index']);
Route::get('/ship/move/{ship}/{to_x}:{to_y}', [ShipsController::class, 'move']);
Route::get('/ship/can/move/{ship}', [ShipsController::class, 'canShipMove']);


# Planet routes
Route::get('/planet/check/seconds/between/last_check_and_now/{planet}', [\App\Http\Controllers\PlanetController::class, 'checkTimeBetweenNowAndLastCheck']);
Route::get('/planet/resource/to/add/count/{planet}', [\App\Http\Controllers\PlanetController::class, 'howManyResourcesToAdd']);
Route::get('/planet/add/resources/{planet}', [\App\Http\Controllers\PlanetController::class, 'addResources']);
