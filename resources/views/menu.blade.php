@extends('layouts.admin')

@section('content')
    <h1>Daftar Menu</h1>

    <!-- Tombol Tambah Menu -->
    <button type="button" class="btn btn-success mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#addMenuModal">
        Tambah Menu
    </button>

    <!-- Tabel Menu -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Aksi</th>   
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $index => $menu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><img src="{{ asset($menu->gambar) }}" alt="{{ $menu->nama }}" style="height: 100px; object-fit: cover;"></td>
                    <td>{{ $menu->nama }}</td>
                    <td>{{ $menu->kategori ? $menu->kategori->nama : 'Kategori tidak tersedia' }}</td>
                    <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                            data-bs-target="#editMenuModal-{{ $menu->id }}">
                            <i class="bi bi-pencil-square"></i> Ubah
                        </button>

                        <!-- Tombol Hapus dengan Modal Konfirmasi -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                            data-bs-target="#deleteMenuModal-{{ $menu->id }}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </td>
                </tr>

                <!-- Modal Tambah Menu -->
                <div class="modal fade" id="addMenuModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Menu</label>
                                        <input type="text" class="form-control" name="nama" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" name="gambar" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Kategori</label>
                                        <select name="kategori_id" class="form-control" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori ->id }}">{{ $kategori->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Menu -->
                <div class="modal fade" id="editMenuModal-{{ $menu->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Ubah Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Menu</label>
                                        <input type="text" class="form-control" name="nama" value="{{ $menu->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" value="{{ $menu->harga }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input type="file" class="form-control" name="gambar">
                                        <small>* Kosongkan jika tidak ingin mengganti gambar</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Kategori</label>
                                        <select name="kategori_id" class="form-control" required>
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}" 
                                                    {{ $menu->kategori_id == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    @if (session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pemberitahuan</h5>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                new bootstrap.Modal(document.getElementById('successModal')).show();
            @endif
        });
    </script>
@endsection