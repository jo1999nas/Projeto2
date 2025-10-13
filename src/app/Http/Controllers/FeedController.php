<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::with('account.user')->latest()->paginate(10);
        // return view('index', ['posts' => $posts]);
        return $posts;
    }
}