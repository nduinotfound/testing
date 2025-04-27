<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Barang yang dihapus</title>
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Data Barang Terhapus</h1>

        <a href="{{ route('barang.index') }}" class="btn btn-primary mb-3">Kembali ke Data Barang</a>

        @if (session('success'))
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
                        <td>{{ $loop->iteration + ($barangs->currentPage() - 1) * $barangs->perPage() }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->kategori }}</td>
                        <td>{{ $barang->jumlah }}</td>
                        <td>{{ $barang->kondisi }}</td>
                        <td>{{ $barang->lokasi_simpan }}</td>
                        <td>{{ $barang->tanggal_masuk }}</td>
                        <td>
                            <form action="{{ route('barang.restore', $barang->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm"
                                    onclick="return confirm('Yakin ingin merestore barang ini?')">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada barang terhapus</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $barangs->links() }}
        </div>
    </div>

</body>

</html>
