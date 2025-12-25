@extends('admin.layouts.admin')
@section('title', 'Webpage Setting')

@section('content')
    <div class="container mt-4">
        <h4 class="fw-semibold mb-4">Pengaturan Website</h4>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0 rounded-3" style="background: #fff;">
            <div class="card-body p-4">
                <form action="{{ route('admin.webpage.setting.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- 🔹 HERO SECTION --}}
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-primary">
                            <i class="bi bi-image-alt me-2"></i>Hero Section
                        </h5>

                        <div class="mb-3">
                            <label class="form-label">Hero Title</label>
                            <input type="text" name="hero_title" class="form-control shadow-sm"
                                placeholder="Masukkan judul hero" value="{{ old('hero_title', $setting->hero_title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="hero_subtitle" class="form-label">Hero Subtitle</label>
                            <textarea name="hero_subtitle" id="hero_subtitle" rows="4" class="form-control shadow-sm"
                                placeholder="Masukkan subjudul hero di sini">{{ old('hero_subtitle', $setting->hero_subtitle) }}</textarea>
                            @error('hero_subtitle')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <hr>

                    {{-- 🔹 FAQ SECTION --}}
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-success">
                            <i class="bi bi-question-circle me-2"></i>FAQ Section
                        </h5>

                        <div id="faqContainer">
                            @foreach ($faqs as $index => $faq)
                                <div class="faq-item border rounded-3 p-3 mb-3 bg-light position-relative">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-faq"
                                        aria-label="Close"></button>

                                    <div class="mb-3">
                                        <label class="form-label">Pertanyaan</label>
                                        <input type="text" name="faq[{{ $index }}][question]"
                                            class="form-control shadow-sm" placeholder="Masukkan pertanyaan"
                                            value="{{ old("faq.$index.question", $faq->question) }}">
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Jawaban</label>
                                        <textarea name="faq[{{ $index }}][answer]" rows="3" class="form-control shadow-sm"
                                            placeholder="Masukkan jawaban">{{ old("faq.$index.answer", $faq->answer) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" id="addFaq" class="btn btn-outline-success mt-2">
                            <i class="bi bi-plus-circle me-1"></i>Tambah FAQ
                        </button>
                    </div>

                    <hr>

                    {{-- 🔹 KONTAK & FOOTER --}}
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-primary">
                            <i class="bi bi-telephone-forward me-2"></i>Kontak & Footer
                        </h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">WhatsApp Number</label>
                                <input type="text" name="whatsapp_number" class="form-control shadow-sm"
                                    placeholder="Contoh: 6281234567890"
                                    value="{{ old('whatsapp_number', $setting->whatsapp_number) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Footer Email</label>
                                <input type="email" name="footer_email" class="form-control shadow-sm"
                                    placeholder="example@email.com"
                                    value="{{ old('footer_email', $setting->footer_email) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Footer Phone</label>
                                <input type="text" name="footer_phone" class="form-control shadow-sm"
                                    placeholder="Nomor telepon perusahaan"
                                    value="{{ old('footer_phone', $setting->footer_phone) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Company Address</label>
                                <textarea name="company_address" class="form-control shadow-sm" rows="2" placeholder="Alamat lengkap perusahaan">{{ old('company_address', $setting->company_address) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- 🔹 SOSIAL MEDIA --}}
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-primary">
                            <i class="bi bi-share me-2"></i>Sosial Media
                        </h5>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Facebook</label>
                                <input type="url" name="link_facebook" class="form-control shadow-sm"
                                    placeholder="https://facebook.com/yourcompany"
                                    value="{{ old('link_facebook', $setting->link_facebook) }}">
                                <small class="text-muted">Kosongkan jika tidak ada</small>
                            </div>



                            <div class="col-md-4 mb-3">
                                <label class="form-label">Instagram</label>
                                <input type="url" name="link_linkedin" class="form-control shadow-sm"
                                    placeholder="https://linkedin.com/company/yourcompany"
                                    value="{{ old('link_linkedin', $setting->link_linkedin) }}">
                                <small class="text-muted">Kosongkan jika tidak ada</small>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- 🔹 FOOTER TEXT --}}
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-primary">
                            <i class="bi bi-text-left me-2"></i>Footer Text
                        </h5>
                        <textarea name="footer_text" class="form-control shadow-sm" rows="2" placeholder="Masukkan teks footer">{{ old('footer_text', $setting->footer_text) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-semibold mb-3 text-primary">
                            <i class="bi bi-file-earmark-pdf-fill me-2"></i>Katalog (PDF)
                        </h5>
                        @if (!empty($setting->catalog_pdf))
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $setting->catalog_pdf) }}" target="_blank"
                                    class="text-decoration-none">
                                    <i class="bi bi-eye me-1"></i>Lihat PDF Katalog Saat Ini
                                </a>
                            </div>
                        @endif
                        <input type="file" name="catalog_pdf" class="form-control shadow-sm" accept=".pdf">
                        <small class="text-muted">Format: PDF, maksimal 5 MB.</small>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="fw-bold text-primary mb-0">Google Maps</h5>
                        </div>
                        <div class="card-body">
                            <label class="form-label fw-semibold">Google Maps Embed (iframe)</label>
                            <textarea name="maps_embed" rows="4" class="form-control" placeholder="Paste iframe Google Maps di sini...">{{ old('maps_embed', $setting->maps_embed ?? '') }}</textarea>
                            <small class="text-muted">Kamu bisa salin iframe dari Google Maps → Bagikan → Sematkan
                                peta.</small>
                        </div>
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        body {
            background: #f4f6f9;
        }

        .card {
            border-radius: 12px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        label {
            font-weight: 600;
            color: #333;
        }

        h5.text-primary {
            display: flex;
            align-items: center;
            gap: 6px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('faqContainer');
            const addBtn = document.getElementById('addFaq');

            let index = {{ count($faqs) }};

            addBtn.addEventListener('click', function() {
                const faqItem = document.createElement('div');
                faqItem.classList.add('faq-item', 'border', 'rounded-3', 'p-3', 'mb-3', 'bg-light',
                    'position-relative');

                faqItem.innerHTML = `
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-faq" aria-label="Close"></button>
                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" name="faq[${index}][question]" class="form-control shadow-sm" placeholder="Masukkan pertanyaan">
                </div>
                <div class="mb-2">
                    <label class="form-label">Jawaban</label>
                    <textarea name="faq[${index}][answer]" rows="3" class="form-control shadow-sm" placeholder="Masukkan jawaban"></textarea>
                </div>
            `;
                container.appendChild(faqItem);
                index++;
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-faq')) {
                    e.target.closest('.faq-item').remove();
                }
            });
        });
    </script>
@endsection
