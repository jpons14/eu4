<?php

namespace App\Http\Controllers;

use App\Events\AddResourcesEvent;
use App\Models\Planet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanetController extends Controller
{

    private $factoriesTypes = [
        'titanium',
        'copper',
        'iron',
        'aluminium',
        'silicon',
        'uranium',
        'nitrogen',
        'hydrogen',
    ];


    public function showBase(Planet $planet)
    {
        event(new AddResourcesEvent($planet));
        $result = [
            'resources' => [],
            'buildings' => []
        ];
        foreach ($this->factoriesTypes as $factoriesType) {
            $result['resources'][$factoriesType] = $planet->$factoriesType;
        }

        return response()->json($result);
    }


}
