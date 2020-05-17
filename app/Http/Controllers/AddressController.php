<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\Semt;
use App\Models\Street;
use App\Models\Neighborhood;
use App\Models\Avenue;
use App\Models\District;
use App\Models\Village;

class AddressController extends Controller
{
    public function getCities($id)
    {
        $cities = City::where('country_id', $id)->pluck("name", "id");

        return json_encode($cities);
    }

    public function getSemts($id)
    {
        $semts = Semt::where('city_id', $id)->pluck("name", "id");

        return json_encode($semts);
    }


    public function getDistricts($id)
    {
        $districts = District::where('city_id', $id)->pluck("name", "id");

        return json_encode($districts);
    }

    public function getNeighborhoods($id)
    {
        $neighborhoods = Neighborhood::where('district_id', $id)->pluck("name", "id");

        return json_encode($neighborhoods);
    }

    public function getVillages($id)
    {
        $villages = Village::where('district_id', $id)->pluck("name", "id");

        return json_encode($villages);
    }
    public function getAvenues($id)
    {
        $avenues = Avenue::where('neighborhood_id', $id)->pluck("name", "id");

        return json_encode($avenues);
    }
    public function getStreets($id)
    {
        $streets = Street::where('avenue_id', $id)->pluck("name", "id");

        return json_encode($streets);
    }
}
