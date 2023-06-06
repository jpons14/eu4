<?php

namespace Database\Seeders;

use App\Models\Galaxy;
use App\Models\SolarSystem;
use App\Models\Planet;
use App\Models\ResourcesType;
use App\Models\PlanetsResource;
use App\Models\Ship;
use App\Models\ShipsType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private int $boardSize = 10;

    private $resourcesTypes = [
        'titanium',
        'copper',
        'iron',
        'aluminium',
        'silicon',
        'uranium',
        'nitrogen',
        'hydrogen',
    ];

    private $resourcesTypesIDs = [];

    /**
     * Seed the application's database.
     * SS == solar system
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        Galaxy::create([
            'name' => 'Galaxy1'
        ]);
        echo 'Galaxy created' . PHP_EOL;
        $this->createSolarSystems();
        echo 'Solar Systems created' . PHP_EOL;
        $this->createResourcesTypes();
        echo 'Resources types created' . PHP_EOL;
        $this->setResourcesPercentagesToEachPlanet();

        $shipType = ShipsType::create([
            'Name' => 'Sonda',
            'NormalSpeed' => 10,
            'WrapSpeed' => 10,
        ]);

        Ship::create([
            'UserID' => 1,
            'ShipTypeID' => $shipType->id,
            'SolarSystemX' => rand(0, 60),
            'SolarSystemY' => rand(0, 60),
            'GalaxyX' => rand(0, $this->boardSize),
            'GalaxyY' => rand(0, $this->boardSize),
        ]);
        Ship::create([
            'UserID' => 1,
            'ShipTypeID' => $shipType->id,
            'SolarSystemX' => rand(0, 60),
            'SolarSystemY' => rand(0, 60),
            'GalaxyX' => rand(0, $this->boardSize),
            'GalaxyY' => rand(0, $this->boardSize),
        ]);
    }

    private function createSolarSystems()
    {
        for ($x = 0; $x < $this->boardSize; $x++) {
            for ($y = 0; $y < $this->boardSize; $y++) {
                $solarSystem = SolarSystem::create([
                    'GalaxyID' => 1,
                    'x' => $x,
                    'y' => $y
                ]);
                $this->createPlanets($solarSystem->id);
            }
        }
    }

    private function createPlanets($solarSystemID)
    {
        $planetsInThisSS = rand(5, 8);
        $usedX = [];
        $usedY = [];
        for ($i = 0; $i <= $planetsInThisSS; $i++) {

            $x = rand(0, 60);
            $y = rand(0, 60);

            while (in_array($x, $usedX) && in_array($y, $usedY)) {
                $x = rand(0, 60);
                $y = rand(0, 60);
            }

            $usedX[] = $x;
            $usedY[] = $y;

            Planet::create([
                'SolarSystemID' => $solarSystemID,
                'UserID' => null,
                'x' => $x,
                'y' => $y,
            ]);
        }
    }

    private function createResourcesTypes()
    {

        foreach ($this->resourcesTypes as $resourceType) {
            $ry = ResourcesType::create([
                'name' => $resourceType
            ]);
            $this->resourcesTypesIDs[] = $ry->id;
        }
    }

    private function setResourcesPercentagesToEachPlanet()
    {
        $planets = Planet::all();

        foreach ($planets as $planet) {
            foreach ($this->resourcesTypesIDs as $resourcesTypesID) {
                PlanetsResource::create([
                    'PlanetID' => $planet->id,
                    'ResourceTypeID' => $resourcesTypesID,
                    'Percentage' => rand(20, 99)
                ]);
            }
        }
    }
}
