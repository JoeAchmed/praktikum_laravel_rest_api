<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalsController extends Controller
{
    // get list animals
    public function index() {
        echo "menampilkan data animals";
    }

    // post new animal
    public function create() {
        echo "menambahkan hewan baru";
    }

    // update animal by id
    public function update ($id) {
        echo "mengupdate data hewan id $id";
    }

    // delete animal by id
    public function destroy ($id) {
        echo "menghapus data hewan id $id";
    }
}
