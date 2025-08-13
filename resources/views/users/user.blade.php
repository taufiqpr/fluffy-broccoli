@extends('layouts.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('user.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</a>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Nama Siswa/Siswi</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $d)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->tanggal_lahir)->format('d-m-Y') }}</td>
                                    <td>{{ $d->jenis_kelamin }}</td>
                                    <td>{{ $d->agama }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>{{ $d->no_hp }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', ['id' => $d->id]) }}" class="btn btn-warning">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('user.delete', ['id' => $d->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection