@extends('admin.layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 fw-semibold">Tambah Produk</h2>

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
                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi Singkat --}}
                    <div class="mb-3">
                        <label for="short_description" class="form-label fw-semibold">Deskripsi Singkat</label>
                        <input type="text" name="short_description" id="short_description"
                            class="form-control @error('short_description') is-invalid @enderror"
                            value="{{ old('short_description') }}">
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi Lengkap --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Deskripsi Lengkap</label>

                        {{-- Elemen tempat Quill akan dirender --}}
                        <div id="quill-editor" style="height: 200px;">{!! old('description', $produk->description ?? '') !!}</div>

                        {{-- Hidden input untuk menyimpan hasil HTML dari Quill --}}
                        <input type="hidden" name="description" id="description">

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Harga --}}
                    {{-- <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="number" name="price" id="price"
                            class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                            step="0.01" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    {{-- Stok --}}
                    {{-- <div class="mb-3">
                        <label for="stock" class="form-label fw-semibold">Stok</label>
                        <input type="number" name="stock" id="stock"
                            class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}">
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
                                    {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <script>
                            console.log('jQuery:', typeof $);
                            console.log('Select2:', typeof $.fn.select2);
                        </script>

                        @error('categories')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Spesifikasi Produk --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Spesifikasi Produk</label>
                        <div id="specifications">
                            <div class="row mb-2 spec-item">
                                <div class="col-md-5">
                                    <input type="text" name="specs[0][key]" class="form-control"
                                        placeholder="Nama Spesifikasi (contoh: Dimensi)">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="specs[0][value]" class="form-control"
                                        placeholder="Nilai (contoh: 200x80x50 cm)">
                                </div>
                                <div class="col-md-2 text-end">
                                    <button type="button" class="btn btn-outline-danger remove-spec">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addSpec" class="btn btn-outline-primary btn-sm mt-2">+ Tambah
                            Spesifikasi</button>
                    </div>

                    {{-- Gambar Produk --}}

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Gambar Produk</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
                        <small class="text-muted d-block mb-2">Kamu bisa memilih beberapa gambar sekaligus. Tandai satu
                            gambar utama.</small>

                        <div id="images-preview" class="d-flex flex-wrap gap-2 mt-2"></div>
                    </div>


                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published
                            </option>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- SCRIPT --}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#categories').select2({
                    placeholder: "Pilih satu atau beberapa kategori",
                    width: '100%',
                    allowClear: true
                });
            });

            // Tambah/Hapus Spesifikasi
            let specIndex = 1;
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
            const previewContainer = document.getElementById('images-preview');

            inputFile.addEventListener('change', function() {
                previewContainer.innerHTML = '';
                Array.from(this.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = "position-relative border rounded overflow-hidden";
                        div.style.width = "120px";
                        div.style.height = "120px";

                        div.innerHTML = `
                <img src="${e.target.result}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                <input type="radio" name="primary_image_new" value="${index}" class="form-check-input position-absolute top-0 start-0 m-1" ${index===0?'checked':''}>
            `;

                        previewContainer.appendChild(div);

                        const radio = div.querySelector('input[type="radio"]');
                        const img = div.querySelector('img');

                        radio.addEventListener('change', () => {
                            previewContainer.querySelectorAll('.position-relative').forEach(t => t
                                .classList.remove('border-primary'));
                            div.classList.add('border-primary');
                        });
                        img.addEventListener('click', () => {
                            radio.checked = true;
                            previewContainer.querySelectorAll('.position-relative').forEach(t => t
                                .classList.remove('border-primary'));
                            div.classList.add('border-primary');
                        });

                        if (radio.checked) div.classList.add('border-primary');
                    };
                    reader.readAsDataURL(file);
                });
            });
        </script>

        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Inisialisasi Quill
                const quill = new Quill('#quill-editor', {
                    theme: 'snow',
                    placeholder: 'Tulis deskripsi produk secara lengkap...',
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, 3, false]
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{
                                list: 'ordered'
                            }, {
                                list: 'bullet'
                            }],
                            ['link', 'blockquote', 'code-block', 'image'],
                            ['clean']
                        ]
                    }
                });

                // Set value awal dari input hidden (jika edit)
                const hiddenInput = document.getElementById('description');
                hiddenInput.value = quill.root.innerHTML;

                // Update value hidden input setiap ada perubahan di Quill
                quill.on('text-change', function() {
                    hiddenInput.value = quill.root.innerHTML;
                });
            });
        </script>
    @endpush




@endsection
