<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class ShowroomController extends Controller
{
    public function index()
    {
        // Lấy danh sách các cửa hàng
        $stores = Store::all(); // Hoặc bạn có thể thêm các điều kiện khác nếu cần

        // Truyền biến $stores đến view
        return view('users.showroom.index', compact('stores'));
    }
}
