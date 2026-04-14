@extends('layouts.app')

@section('content')

<div class="container-fluid px-4" style = "margin-top:90px;">

<div class="row justify-content-center">



<div class="card shadow-sm">


<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Daftar Jawaban Kuesioner</h3>

        <a href="{{ route('kues.export') }}" class="btn text-white" style="background-color:#6984A9;">
            Export Excel
        </a>

    </div>

    <form method="GET" action="{{ route('kues.jawaban') }}" class="mb-3">

        <div class="row">

            <div class="col-md-4">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama responden..."
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-2">
                <button class="btn text-white" style="background-color:#6984A9;">Cari</button>
            </div>

        </div>

    </form>

    <table class="table table-bordered table-striped">

        <thead class="table-warning">

            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Kepemilikan Usaha</th>
                <th>Kegiatan Utama</th>
                <th>Aksi</th>
            </tr>

        </thead>

        <tbody>

            @forelse($data as $item)

            <tr>

                <td>{{ $data->firstItem() + $loop->index }}</td>

                <td>{{ $item->nama }}</td>

                <td>{{ $item->npm }}</td>

                <td>
                    @if($item->punya_usaha == 'ya')
                    <span class="badge bg-success">Ya</span>
                    @else
                    <span class="badge bg-secondary">Tidak</span>
                    @endif
                </td>

                <td>{{ $item->kegiatan_utama }}</td>

                <td>

                    <a href="{{ route('kues.show',$item->id) }}" class="btn btn-warning btn-sm">
                        Detail
                    </a>

                    <a href="{{ route('kues.edit',$item->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form
                        action="{{ route('kues.delete',$item->id) }}"
                        method="POST"
                        style="display:inline-block"
                        class="form-delete d-inline">

                        @csrf @method('DELETE')

                        <button type="button" class="btn btn-danger btn-sm btn-delete">
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="text-center">
                    Belum ada data
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

    <div class="mt-3">
        {{ $data->links() }}
    </div>

</div>

</div>
</div>
</div>



@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".btn-delete").forEach(button => {

        button.addEventListener("click", function () {

            let form = this.closest("form");

            Swal.fire({
                title: "Yakin hapus data?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batal"
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});
</script>