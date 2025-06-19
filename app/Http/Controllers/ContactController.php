<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('users.contact.index',  compact("contacts")); // Chỉ, định view liên hệ
    }
    public function submit(Request $request)
    {
        // Validate form input
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string',
                'company' => 'required|string|max:15',
                'email' => 'required|email',
                'message' => 'required|string',
            ]);

            $data = $request->except('_token');

            Contact::create($data);

            // Chuyển hướng sau khi gửi form thành công
            return redirect()->to("/")->with('success', 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm nhất!');
        } catch (\Exception $e) {
            Log::error("{$e->getMessage()}");
        }
    }
}
