@extends('admin.layouts.admin')

@section('title', 'Edit Testimoni')

@section('content')
    <div class="container-fluid mt-4">

        {{-- 🔹 Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-semibold mb-0">Edit Testimoni</h3>
            <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        {{-- 🔹 Form Edit Testimoni --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.testimoni.update', $testimoni->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $testimoni->name) }}" placeholder="Masukkan nama pelanggan">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="mb-3">
                        <label for="job_title" class="form-label fw-semibold">Pekerjaan</label>
                        <input type="text" name="job_title" id="job_title"
                            class="form-control @error('job_title') is-invalid @enderror"
                            value="{{ old('job_title', $testimoni->job_title) }}"
                            placeholder="Masukkan pekerjaan pelanggan">
                        @error('job_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pesan --}}
                    <div class="mb-3">
                        <label for="message" class="form-label fw-semibold">Pesan</label>
                        <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror"
                            placeholder="Tulis testimoni pelanggan...">{{ old('message', $testimoni->message) }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Foto --}}
                    <div class="mb-4">
                        <label for="photo" class="form-label fw-semibold">Foto (opsional)</label>
                        @if ($testimoni->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $testimoni->photo) }}" alt="Foto Testimoni"
                                    class="rounded shadow-sm" width="100">
                            </div>
                        @endif
                        <input type="file" name="photo" id="photo"
                            class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
