<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Giả sử bạn đã tạo model Post

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // Lấy danh sách bài viết
        return view('users.blog.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id); // Tìm bài viết theo ID
        return view('users.blog.show', compact('post')); // Trả về view với bài viết
    }



    // Hàm để lưu bài viết mới
}
