<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController {
    public function getHome() {
        return redirect()->action([CatalogController::class, 'getIndex']);
    }
}

