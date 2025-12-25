@extends('admin.layouts.admin')

@section('title', 'Edit Kategori Berita')

@section('content')
    <div class="container">
        <h3 class="mb-4">Edit Kategori Berita</h3>

        <form action="{{ route('admin.kategori-berita.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- 🔹 Name --}}
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>



            {{-- 🔹 Description --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $category->description) }}</textarea>
            </div>

            <a href="{{ route('admin.kategori-berita.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
