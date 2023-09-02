<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller {
    public function index() {
        return view('welcome');
    }

    public function create() {
        return view('events.create');
    }

    public function products() {
        $busca = request('search');
        return view('products', ['busca' => $busca]);
    }

    public function teste($id = null) {
        return view('product', ['id' => $id]);
    }
}
