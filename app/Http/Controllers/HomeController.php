<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('page_get_info');
    }
    public function sendContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:10', 'min:10', 'regex:/^[0-9]*$/'],
            'address'=>['required', 'string', 'max:255'],
            'introduce_yourself'=>['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->first()]);
        }
        $data = $request->all();
        ContactInfo::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address'=> $data['address'],
            'introduce_yourself'=>$data['introduce_yourself']
        ]);
        return response()->json(['success' => true]);
    }
}
