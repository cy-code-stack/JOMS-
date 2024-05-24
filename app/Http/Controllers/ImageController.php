<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
{

    dd($request->image);
    // if ($request->hasFile('image')) {
    //     $image = $request->file('image');
    //     $filename = time() . '_' . $image->getClientOriginalName();
    //     $image->move(public_path('img'), $filename);

    //     return response()->json(['success' => true]);
    // }

    // return response()->json(['success' => false]);
}
}
