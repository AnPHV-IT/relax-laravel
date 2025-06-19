<?php

namespace App\Http\Controllers\Admin;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Ramsey\Uuid\Uuid;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Discount;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class AdminController extends Controller
{

    public function categoriesEdit($id, Request $req)
    {
        $category = Category::where(["id" => $id])->first();

        if (!$category) {
            return abort(404);
        }

        $category->name = $req->get("name");

        $category->save();


        return redirect()->to("/admin/categories");
    }

    public function categoriesEditView($id)
    {
        $category = Category::where(["id" => $id])->first();

        return view("admin.categories.edit", compact("category"));
    }
    public function categoriesDestroy($id)
    {
        $category = Category::where(["id" => $id])->first();

        if (!$category) {
            return abort(404);
        }

        $category->delete();


        return redirect()->to('/admin/categories');
    }

    public function categoriesCreateAdmin(Request $req)
    {
        $data = $req->except("_token");

        Category::create($data);

        return redirect()->to("/admin/categories");
    }

    public function categoriesCreate()
    {
        return view('admin.categories.create');
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    // Hàm xử lý logic cho trang dashboard
    public function dashboard()
    {

        // Lấy tổng doanh thu từ bảng products theo tháng
        $revenueData = Product::select(
            DB::raw('SUM(price) as revenue'),   // Tính tổng của cột price
            DB::raw('MONTH(created_at) as month')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Chuẩn bị dữ liệu để truyền vào view
        $revenue = $revenueData->pluck('revenue');  // Lấy tổng doanh thu theo từng tháng
        $months = $revenueData->pluck('month')->map(function ($month) {
            return 'Tháng ' . $month;
        });

        // Truyền dữ liệu qua view
        return view('admin.dashboard.index', compact('revenue', 'months'));
    }
    public function IndexContact()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index',  compact("contacts")); // Chỉ, định view liên hệ
    }

    // Hàm xử lý logic cho trang quản lý sản phẩm
    public function productsIndex()
    {
        $products = Product::with(['colors'])->get();

        return view('admin.products.index', compact('products'));
    }

    public function productsCreate()
    {

        $categories = Category::all();
        return view('admin.products.create', compact("categories"));
    }

    public function productsStore(Request $request)
    {

        $public_id = Uuid::uuid4()->toString();
        $colors_public_id = [];
        DB::beginTransaction();
        try {
            $data = $request->except('__token', 'categories', 'colors');

            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                'public_id' => $public_id,
                "folder" => "productImages"
            ]);
            $uploadedFileUrl = $uploadedFile->getSecurePath();
            $data["image"] = $uploadedFileUrl;
            $data["public_id"] =  $public_id;
            $product = Product::create($data);
            $productId = $product->id;

            $categories = $request->get("categories");
            $colors = $request->get("colors");

            foreach ($categories as $category) {
                Category::create([
                    'name' => $category,
                    'productId' => $productId,
                ]);
            }

            foreach ($colors as $index => $color) {
                $public_id_color = Uuid::uuid4()->toString();
                $uploadedFile = Cloudinary::upload($request->file("colors.{$index}.image")->getRealPath(), [
                    'public_id' => $public_id_color,
                    "folder" => "productColorImages"
                ]);

                array_push($colors_public_id, $public_id_color);

                $uploadedFileColorUrl = $uploadedFile->getSecurePath();

                Color::create([
                    'name' => $color['name'],
                    'imageUrl' => $uploadedFileColorUrl,
                    'public_id' => $public_id_color,
                    'productId' => $productId,
                ]);
            }

            DB::commit();

            return redirect()->to('/admin/products');
        } catch (Exception $err) {
            DB::rollback();
            Log::error($err->getMessage());
            Cloudinary::destroy("productImages/{$public_id}");
            foreach ($colors_public_id as $public_id_color) {
                Cloudinary::destroy("productColorImages/{$public_id_color}");
            }

            return redirect()->back()->withInput();
        }
    }

    public function productsEdit($id)
    {
        $product = Product::with(['colors'])->findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', "categories"));
    }

    public function productsUpdate(Request $request, $id)
    {

        // return response()->json($request->all());
        $product = Product::findOrFail($id);
        $public_id = null;
        $colors_public_id = [];
        DB::beginTransaction();

        try {
            $data = $request->except('__token', 'categories', 'colors');

            if ($request->file('image')) {

                Cloudinary::destroy("productImages/{$product->public_id}");

                $public_id = Uuid::uuid4()->toString();

                $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
                    'public_id' => $public_id,
                    "folder" => "productImages"
                ]);
                $data["image"] = $uploadedFile->getSecurePath();
                $data["public_id"] = $public_id;
            }

            $product->update($data);

            $colors = $request->get("colors");
            foreach ($colors as $index => $color) {
                if (empty($color['id'])) {
                    Log::info("not id");
                    $public_id_color = Uuid::uuid4()->toString();
                    $uploadedFile = Cloudinary::upload($request->file("colors.{$index}.image")->getRealPath(), [
                        'public_id' => $public_id_color,
                        "folder" => "productColorImages"
                    ]);

                    array_push($colors_public_id, $public_id_color);

                    Color::create([
                        'name' => $color['name'],
                        'imageUrl' => $uploadedFile->getSecurePath(),
                        'public_id' => $public_id_color,
                        'productId' => $product->id,
                    ]);
                } else {
                    $existingColor = Color::where(["id" => $color['id']])->first();
                    if ($existingColor) {
                        if ($request->hasFile("colors.{$color['id']}.image")) {
                            Log::info("existing imae color");

                            Cloudinary::destroy("productColorImages/{$existingColor->public_id}");

                            $public_id_color = Uuid::uuid4()->toString();

                            $uploadedFile = Cloudinary::upload($request->file("colors.{$color['id']}.image")->getRealPath(), [
                                'public_id' => $public_id_color,
                                "folder" => "productColorImages"
                            ]);
                            array_push($colors_public_id, $public_id_color);


                            $existingColor->update([
                                'name' => $color['name'],
                                'imageUrl' => $uploadedFile->getSecurePath(),
                                'public_id' => $public_id_color,
                            ]);
                        } else {
                            $existingColor->update(['name' => $color['name']]);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->to('/admin/products');
        } catch (Exception $err) {
            DB::rollback();
            Log::error("Error updated Product: {$err->getMessage()}");

            if ($public_id !== null) {
                Cloudinary::destroy("productImages/{$public_id}");
            }

            foreach ($colors_public_id as $public_id_color) {
                Cloudinary::destroy("productColorImages/{$public_id_color}");
            }

            return redirect()->back()->withInput();
        }
    }

    public function productsColorDelete($productId, $colorId)
    {
        try {
            $color = Color::where(['productId' => $productId, 'id' => $colorId])->first();
            if (!$color) {
                return abort(404);
            }

            $color->delete();

            return redirect()->to("/admin/products/{$productId}/edit");
        } catch (Exception $err) {
            Log:
            error("Error product color delete {$err->getMessage()}");
        }
    }

    public function productsDestroy($productId)
    {
        try {
            $product = Product::where(["id" => $productId])->first();
            $colors = Color::where(["productId" => $productId])->get();

            if (!$product) return abort(404);

            if ($product->public_id) {
                Cloudinary::destroy("productImages/{$product->public_id}");
            }

            foreach ($colors as $color) {
                if ($color->public_id) {
                    Cloudinary::destroy("productColorImages/{$color->public_id}");
                }
            }

            $product->delete();

            return redirect()->to('/admin/products');
        } catch (Exception $err) {
            Log:
            error("Error product destroy: {$err->getMessage()}");
        }
    }

    // Hàm xử lý logic cho trang quản lý đơn hàng
    public function ordersIndex()
    {
        $usersWithOrders = UserModel::has('orders')->with('orders')->get();

        return view('admin.orders.index', compact('usersWithOrders'));
    }

    public function OrderConfirm($orderId, Request $req)
    {
        try {
            $user = $req->attributes->get('user');

            if (!$user instanceof UserModel) return redirect()->to("/login");

            if ($user->role !== "admin") return redirect()->to("/");

            $order = Order::where(["id" => $orderId])->firstOrFail();

            $order->status = "CONFIRMED";

            $order->save();

            return redirect()->to('/admin/orders');
        } catch (Exception $err) {
            Log:
            error("Error Order Confirmation: {$err->getMessage()}");
        }
    }

    public function OrderCancel($orderId, Request $req)
    {
        try {
            $user = $req->attributes->get('user');

            if (!$user instanceof UserModel) return redirect()->to("/login");
            if ($user->role !== "admin") return redirect()->to("/");

            $order = Order::where(["id" => $orderId])->firstOrFail();

            $order->status = "CANCELED";

            $order->save();

            return redirect()->to('/admin/orders');
        } catch (Exception $err) {
            Log:
            error("Error Order Confirmation: {$err->getMessage()}");
        }
    }

    public function ordersShow($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function usersIndex()
    {
        // Lấy danh sách người dùng từ database
        $users = UserModel::all();

        return view('admin.users.index', compact('users'));
    }

    public function usersShow($id)
    {
        // Tìm người dùng theo ID
        $user = UserModel::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    public function usersDestroy($id)
    {
        // Xóa người dùng theo ID
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Người dùng đã được xóa.');
    }

    // Hàm xử lý logic cho trang quản lý mã giảm giá
    public function discountsIndex()
    {
        // Lấy danh sách mã giảm giá từ database
        $discounts = Discount::all();

        return view('admin.discounts.index', compact('discounts'));
    }

    public function discountsCreate()
    {
        return view('admin.discounts.create');
    }

    public function discountsStore(Request $request)
    {
        // Xử lý lưu mã giảm giá mới vào database
        $validatedData = $request->validate([
            'code' => 'required|string|max:255',
            'discount_percentage' => 'required|numeric',
            // Thêm các trường khác cần thiết
        ]);

        Discount::create($validatedData);

        return redirect()->route('admin.discounts.index')->with('success', 'Mã giảm giá đã được thêm thành công!');
    }

    // Hàm xử lý logic cho trang cài đặt hệ thống
    public function settingsIndex()
    {
        // Có thể thêm logic để lấy các thông tin cấu hình hệ thống
        return view('admin.settings.index');
    }
}
