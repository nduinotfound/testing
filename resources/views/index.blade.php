<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-custom {
            margin-right: 10px;
        }

        .btn-custom:hover {
            opacity: 0.9;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Data Inventaris Barang Kantor</h1>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
            <a href="{{ route('barang.trashed') }}" class="btn btn-secondary">Lihat Barang Terhapus</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
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
                                <a href="{{ route('barang.edit', $barang->id) }}"
                                    class="btn btn-warning btn-sm btn-custom" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Edit Barang">Edit</a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                                    class="d-inline" id="delete-form-{{ $barang->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-custom"
                                        onclick="confirmDelete({{ $barang->id }})" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Hapus Barang">Hapus</button>
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
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $barangs->links('pagination::bootstrap-5') }}
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>
    <script>
        // Enable Bootstrap Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // SweetAlert2 for delete confirmation
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

</body>

</html>
