<?php

namespace App\Http\Controllers;

use App\Queries\FirstProjectQuery;

class FirstProject extends Controller
{
    public function injectionTest() {
        FirstProjectQuery::testFunction();
    }
}
