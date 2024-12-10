<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function createArticle(): View {
        return view('admin.createArticle');
    }
}
