<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function createArticle(): View|RedirectResponse
    {
        return view('admin.createArticle');
    }

    public function storeArticle(CommentRequest $request): RedirectResponse
    {

    }
}
