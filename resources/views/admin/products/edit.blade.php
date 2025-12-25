@extends('admin.layouts.admin')

@section('title', 'Edit Produk')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 fw-semibold">Edit Produk</h2>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $produk->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi Singkat --}}
                    <div class="mb-3">
                        <label for="short_description" class="form-label fw-semibold">Deskripsi Singkat</label>
                        <input type="text" name="short_description" id="short_description"
                            class="form-control @error('short_description') is-invalid @enderror"
                            value="{{ old('short_description', $produk->short_description) }}">
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 🔹 Deskripsi Lengkap --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Deskripsi Lengkap</label>

                        {{-- Editor Quill --}}
                        <div id="quill-editor" style="height: 250px;">
                            {!! old('description', $produk->description) !!}
                        </div>

                        {{-- Input hidden untuk menyimpan hasil HTML dari Quill --}}
                        <input type="hidden" name="description" id="description">

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    {{-- <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="number" name="price" id="price"
                            class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', intval($produk->price)) }}" step="1" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    {{-- Stok --}}
                    {{-- <div class="mb-3">
                        <label for="stock" class="form-label fw-semibold">Stok</label>
                        <input type="number" name="stock" id="stock"
                            class="form-control @error('stock') is-invalid @enderror"
                            value="{{ old('stock', $produk->stock) }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label for="categories" class="form-label fw-semibold">Kategori</label>
                        <select name="categories[]" id="categories"
                            class="form-select @error('categories') is-invalid @enderror" multiple required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', $produk->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Spesifikasi Produk --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Spesifikasi Produk</label>
                        <div id="specifications">
                            @php
                                $specs = json_decode($produk->specs, true) ?? [];

                                // pastikan selalu berbentuk array numerik key/value
                                $specs_array = [];
                                foreach ($specs as $k => $v) {
                                    if (is_array($v) && isset($v['key'], $v['value'])) {
                                        $specs_array[] = ['key' => $v['key'], 'value' => $v['value']];
                                    } else {
                                        // jika data lama berupa associative array key => value
                                        $specs_array[] = ['key' => $k, 'value' => $v];
                                    }
                                }
                            @endphp

                            @forelse ($specs_array as $i => $spec)
                                <div class="row mb-2 spec-item">
                                    <div class="col-md-5">
                                        <input type="text" name="specs[{{ $i }}][key]" class="form-control"
                                            value="{{ $spec['key'] }}" placeholder="Nama Spesifikasi">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="specs[{{ $i }}][value]" class="form-control"
                                            value="{{ $spec['value'] }}" placeholder="Nilai">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-outline-danger remove-spec">Hapus</button>
                                    </div>
                                </div>
                            @empty
                                <div class="row mb-2 spec-item">
                                    <div class="col-md-5">
                                        <input type="text" name="specs[0][key]" class="form-control"
                                            placeholder="Nama Spesifikasi">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="specs[0][value]" class="form-control"
                                            placeholder="Nilai">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-outline-danger remove-spec">Hapus</button>
                                    </div>
                                </div>
                            @endforelse
                        </div>


                        <button type="button" id="addSpec" class="btn btn-outline-primary btn-sm mt-2">+ Tambah
                            Spesifikasi</button>
                    </div>

                    {{-- Gambar Produk --}}
                    <div class="mb-4">
                        <label for="images" class="form-label fw-semibold">Gambar Produk</label>
                        <input type="file" name="images[]" id="images" class="d-none" multiple accept="image/*">
                        <button type="button" class="btn btn-outline-primary mb-2" id="select-images-btn">Pilih
                            Gambar</button>
                        <small class="text-muted d-block mb-2">Tandai satu gambar utama. Bisa hapus gambar lama maupun
                            baru.</small>

                        <div id="images-preview" class="d-flex flex-wrap gap-2">
                            {{-- Gambar lama --}}
                            @foreach ($produk->images as $img)
                                <div class="position-relative border rounded overflow-hidden image-item"
                                    style="width:120px;height:120px;" data-id="{{ $img->id }}">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="img-fluid w-100 h-100"
                                        style="object-fit:cover;">
                                    <input type="radio" name="primary_image" value="old-{{ $img->id }}"
                                        class="form-check-input position-absolute top-0 start-0 m-1"
                                        {{ $img->is_primary ? 'checked' : '' }}>
                                    <button type="button"
                                        class="btn-close position-absolute top-0 end-0 m-1 delete-old-image-btn"></button>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="published"
                                {{ old('status', $produk->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status', $produk->status) === 'draft' ? 'selected' : '' }}>
                                Draft</option>
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script --}}
    @push('scripts')
        <script>
            // Select2 untuk kategori
            $(document).ready(function() {
                $('#categories').select2({
                    placeholder: "Pilih satu atau beberapa kategori",
                    width: '100%',
                    allowClear: true
                });
            });

            // Tambah/Hapus Spesifikasi
            let specIndex = {{ count($specs) }};

            $('#addSpec').on('click', function() {
                let newSpec = `
        <div class="row mb-2 spec-item">
            <div class="col-md-5">
                <input type="text" name="specs[${specIndex}][key]" class="form-control" placeholder="Nama Spesifikasi">
            </div>
            <div class="col-md-5">
                <input type="text" name="specs[${specIndex}][value]" class="form-control" placeholder="Nilai">
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-outline-danger remove-spec">Hapus</button>
            </div>
        </div>`;
                $('#specifications').append(newSpec);
                specIndex++;
            });

            $(document).on('click', '.remove-spec', function() {
                $(this).closest('.spec-item').remove();
            });
        </script>
    @endpush


    @push('scripts')
        <script>
            const inputFile = document.getElementById('images');
            const selectBtn = document.getElementById('select-images-btn');
            const previewContainer = document.getElementById('images-preview');
            let newFilesArray = [];

            // Tombol pilih gambar baru
            selectBtn.addEventListener('click', () => inputFile.click());

            // Upload preview gambar baru
            inputFile.addEventListener('change', (e) => {
                Array.from(e.target.files).forEach(file => newFilesArray.push(file));
                renderPreviews();
            });

            function renderPreviews() {
                // Hapus preview gambar baru dulu
                previewContainer.querySelectorAll('.new-image').forEach(el => el.remove());

                newFilesArray.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = "position-relative border rounded overflow-hidden new-image";
                        div.style.width = "120px";
                        div.style.height = "120px";

                        div.innerHTML = `
                <img src="${e.target.result}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                <input type="radio" name="primary_image" value="new-${index}" class="form-check-input position-absolute top-0 start-0 m-1" ${index===0?'checked':''}>
                <button type="button" class="btn-close position-absolute top-0 end-0 m-1"></button>
            `;

                        previewContainer.appendChild(div);

                        const radio = div.querySelector('input[type="radio"]');
                        const img = div.querySelector('img');
                        const closeBtn = div.querySelector('.btn-close');

                        // pilih primary
                        radio.addEventListener('change', () => {
                            previewContainer.querySelectorAll('.position-relative').forEach(t => t.classList
                                .remove('border-primary'));
                            div.classList.add('border-primary');
                        });
                        img.addEventListener('click', () => {
                            radio.checked = true;
                            previewContainer.querySelectorAll('.position-relative').forEach(t => t.classList
                                .remove('border-primary'));
                            div.classList.add('border-primary');
                        });

                        // hapus gambar baru
                        closeBtn.addEventListener('click', () => {
                            newFilesArray.splice(index, 1);
                            renderPreviews();
                        });

                        if (radio.checked) div.classList.add('border-primary');
                    };
                    reader.readAsDataURL(file);
                });
            }

            // Hapus gambar lama via AJAX
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-old-image-btn')) {
                    let btn = e.target.closest('.delete-old-image-btn');
                    if (!confirm('Yakin ingin menghapus gambar ini?')) return;

                    let div = btn.closest('.image-item');
                    let url =
                        "{{ route('admin.produk.image.destroy', ['produk' => $produk->id, 'image' => '__id__']) }}";
                    url = url.replace('__id__', div.dataset.id);

                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) div.remove();
                            else alert(data.error || 'Gagal menghapus gambar.');
                        })
                        .catch(err => console.error(err));
                }
            });
        </script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Inisialisasi Quill
                const quill = new Quill('#quill-editor', {
                    theme: 'snow',
                    placeholder: 'Tulis deskripsi lengkap produk di sini...',
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['blockquote', 'code-block'],
                            [{
                                list: 'ordered'
                            }, {
                                list: 'bullet'
                            }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    }
                });

                // Set nilai awal jika ada
                const hiddenInput = document.querySelector('#description');
                hiddenInput.value = quill.root.innerHTML;

                // Update input hidden saat konten berubah
                quill.on('text-change', function() {
                    hiddenInput.value = quill.root.innerHTML;
                });
            });
        </script>
    @endpush

@endsection
