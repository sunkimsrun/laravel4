<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show the form
    public function create()
    {
        return view('post.create'); // resources/views/post/create.blade.php
    }

    // Handle form submission
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            // Normally, you would save to the database here

            return redirect('/post/create')->with('success', 'User submitted successfully!');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
