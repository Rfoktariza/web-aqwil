<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebpageSetting;
use App\Models\Faq;
use Illuminate\Support\Facades\Storage;


class WebpageSettingController extends Controller
{
    public function index()
    {
        // Ambil data pengaturan pertama
        $setting = WebpageSetting::firstOrCreate([]);

        // Ambil semua FAQ
        $faqs = Faq::orderBy('id', 'asc')->get();

        return view('admin.webpage_setting.index', compact('setting', 'faqs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'footer_text' => 'nullable|string',
            'catalog_pdf' => 'nullable|mimes:pdf|max:5120', // Maks 5MB
            'maps_embed' => 'nullable|string',

        ]);

        // Ambil atau buat setting pertama
        $setting = WebpageSetting::firstOrCreate([]);
        $setting->fill($request->except(['faq', 'catalog_pdf']));

        // 🔹 Upload PDF jika ada
        if ($request->hasFile('catalog_pdf')) {
            // Hapus PDF lama jika ada
            if ($setting->catalog_pdf && Storage::disk('public')->exists($setting->catalog_pdf)) {
                Storage::disk('public')->delete($setting->catalog_pdf);
            }

            // Simpan PDF baru
            $path = $request->file('catalog_pdf')->store('catalogs', 'public');
            $setting->catalog_pdf = $path;
        }

        $setting->save();

        // 🔹 Update FAQ
        if ($request->has('faq')) {
            Faq::truncate();
            foreach ($request->faq as $faqData) {
                if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                    Faq::create([
                        'question' => $faqData['question'],
                        'answer' => $faqData['answer'],
                    ]);
                }
            }
        }

        return back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }

}
