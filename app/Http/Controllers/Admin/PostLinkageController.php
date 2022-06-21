<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLinkageController extends Controller
{
    public function show($id)
    {
        $data['post']   = Post::findOrFail($id);
        $data['author'] = $data['post']->getAuthor($id);
        $data['widget'] = DashboardController::Wiget();

        return view('admin.posts.linkages.index', [
            'data' => $data,
        ]);
    }
}
