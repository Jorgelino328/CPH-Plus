<?php
namespace App\Http\Controllers;

use App\Models\ExpirationTime;

class ExpirationTimeController extends Controller
{
    public function index()
    {
        $expirationTimes = ExpirationTime::orderBy('seconds')->get()
            ->prepend(collect([
                'label' => 'Never',
                'seconds' => null
            ]));

        return response()->json($expirationTimes);
    }
}
