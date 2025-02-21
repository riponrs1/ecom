<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }
    public function brands(){
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('admin.brands',compact('brands'));
    }
    public function add_brand(){
        return view('admin.add_brand');
    }
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:brands,slug',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // Max 2MB
        ]);

        // Store image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brands', 'public');
        } else {
            $imagePath = null;
        }

        // Save brand details to the database
        Brand::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->slug), // Convert to URL-friendly format
            'image' => $imagePath,
        ]);

        return redirect('brands')->with('success', 'Brand created successfully!');
    }
}
