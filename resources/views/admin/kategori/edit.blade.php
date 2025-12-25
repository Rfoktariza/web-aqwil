@extends('admin.layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 fw-semibold">Edit Kategori</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Kategori --}}
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Kategori</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $kategori->name) }}" required>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi Kategori --}}
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control"
                    placeholder="Masukkan deskripsi kategori">{{ old('description', $kategori->description) }}</textarea>
                @error('description')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
