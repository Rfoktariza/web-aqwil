<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        $clients = Client::latest()->get();

        return view('admin.about.index', compact('about', 'clients'));
    }

    public function update(Request $request)
    {
        $about = AboutUs::first() ?? new AboutUs();

        $validated = $request->validate([
            'title' => 'nullable|string',
            'content_1' => 'nullable|string',
            'content_2' => 'nullable|string',
            'vision_title' => 'nullable|string',
            'vision_content' => 'nullable|string',
            'mission_title' => 'nullable|string',
            'mission_content' => 'nullable|string',
            'innovation_title' => 'nullable|string',
            'innovation_content' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'clinic_count' => 'nullable|integer|min:0',
            'hospital_count' => 'nullable|integer|min:0',
            'partner_count' => 'nullable|integer|min:0',
        ]);



        // Upload hero image
        if ($request->hasFile('hero_image')) {
            if ($about->hero_image && Storage::disk('public')->exists($about->hero_image)) {
                Storage::disk('public')->delete($about->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('about', 'public');
        }

        // Upload vision image
        if ($request->hasFile('vision_image')) {
            if ($about->vision_image && Storage::disk('public')->exists($about->vision_image)) {
                Storage::disk('public')->delete($about->vision_image);
            }
            $validated['vision_image'] = $request->file('vision_image')->store('about', 'public');
        }

        $about->fill($validated)->save();

        return redirect()->back()->with('success', 'About Us updated successfully.');
    }

    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        Client::create($validated);

        return redirect()->back()->with('success', 'Client berhasil ditambahkan.');
    }
    public function destroyClient(Client $client)
    {
        if ($client->logo && Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }
        $client->delete();

        return redirect()->back()->with('success', 'Client berhasil dihapus.');
    }


}
