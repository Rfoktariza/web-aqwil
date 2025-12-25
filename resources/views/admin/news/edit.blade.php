@extends('admin.layouts.admin')
@section('title', 'Edit Berita')

@section('content')
    <div class="container-fluid mt-4">
        <h4 class="fw-semibold mb-3">Edit Berita</h4>

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

        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data"
            class="card p-4 shadow-sm border-0">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" required value="{{ old('title', $news->title) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Ringkasan</label>
                <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $news->excerpt) }}</textarea>
            </div>

            {{-- 🔹 Pilih Kategori --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="categories[]" class="form-select select2" multiple required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', $selectedCategories)) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Pilih satu atau lebih kategori yang sesuai.</small>
            </div>


            <div class="mb-3">
                <label class="form-label">Konten</label>
                {{-- Quill editor tampil di sini --}}
                <div id="editor" style="height: 300px;">{!! old('content', $news->content) !!}</div>
                {{-- Textarea tersembunyi untuk menyimpan hasil Quill --}}
                <textarea name="content" id="content" class="form-control d-none" rows="6" required>{{ old('content', $news->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar</label><br>
                @if ($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" width="120" class="mb-2 rounded">
                @endif
                <input type="file" name="image" class="form-control">
            </div>

            <div class="text-end">
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'Tulis konten berita di sini...',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['link', 'blockquote', 'code-block', 'image'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['clean']
                    ]
                }
            });

            // Set nilai awal jika ada
            const hiddenInput = document.querySelector('#content');
            hiddenInput.value = quill.root.innerHTML;

            // Update input hidden saat konten berubah
            quill.on('text-change', function() {
                hiddenInput.value = quill.root.innerHTML;
            });
        });
    </script>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Pilih kategori berita",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>
    @endpush
@endsection
