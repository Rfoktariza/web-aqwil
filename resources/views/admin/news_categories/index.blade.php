@extends('admin.layouts.admin')

@section('title', 'Daftar Kategori Berita')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3 class="fw-semibold mb-1">Daftar Kategori Berita</h3>


            <a href="{{ route('admin.kategori-berita.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Kategori Berita
            </a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>
                            <a href="{{ route('admin.kategori-berita.edit', $cat->id) }}" class="btn btn-sm btn-warning"> <i
                                    class="bi bi-pencil"></i></a>

                            <form action="{{ route('admin.kategori-berita.destroy', $cat->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus kategori?')" class="btn btn-sm btn-danger"> <i
                                        class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
