<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Data Inventaris Barang Kantor</h1>

    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>
    <a href="{{ route('barang.trashed') }}" class="btn btn-secondary mb-3">Lihat Barang Terhapus</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Lokasi Simpan</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $barang)
            <tr>
                <td>{{ $loop->iteration + ($barangs->currentPage()-1) * $barangs->perPage() }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->kode_barang }}</td>
                <td>{{ $barang->kategori }}</td>
                <td>{{ $barang->jumlah }}</td>
                <td>{{ $barang->kondisi }}</td>
                <td>{{ $barang->lokasi_simpan }}</td>
                <td>{{ $barang->tanggal_masuk }}</td>
                <td>
                    <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Data Barang Tidak Ada</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $barangs->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
