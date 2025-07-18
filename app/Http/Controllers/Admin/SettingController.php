<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Setting/Index', [
            'settings' => Setting::all()->pluck('value', 'key'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('school_logo');

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('school_logo')) {
            $path = $request->file('school_logo')->store('logos', 'public');
            Setting::updateOrCreate(['key' => 'school_logo'], ['value' => $path]);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    public function landing()
    {
        return Inertia::render('Admin/Setting/LandingPage', [
            'settings' => Setting::all()->pluck('value', 'key'),
        ]);
    }

    public function updateLanding(Request $request)
    {
        $data = $request->except(['hero_image', 'about_us_image', 'gallery_images']);

        foreach ($data as $key => $value) {
            // Handle JSON fields
            if (in_array($key, ['features', 'statistics'])) {
                $value = json_decode($value, true);
            }
            Setting::updateOrCreate(['key' => $key], ['value' => is_array($value) ? json_encode($value) : $value]);
        }

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('landing', 'public');
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => $path]);
        }

        if ($request->hasFile('about_us_image')) {
            $path = $request->file('about_us_image')->store('landing', 'public');
            Setting::updateOrCreate(['key' => 'about_us_image'], ['value' => $path]);
        }
        
        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('landing/gallery', 'public');
                $galleryPaths[] = $path;
            }
            Setting::updateOrCreate(['key' => 'gallery_images'], ['value' => json_encode($galleryPaths)]);
        }

        return redirect()->back()->with('success', 'Pengaturan halaman landing berhasil disimpan.');
    }
}
