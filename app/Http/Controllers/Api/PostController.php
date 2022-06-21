<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit', 20);
        $row = Post::where('status', 1)->orderByDesc('published_at')->paginate($limit);
        return response($row);
    }

    public function show($id)
    {
        $data = Post::where('status', 1)->where('id', $id)->first();
        return response($data);
    }
}
