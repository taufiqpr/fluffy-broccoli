@extends('layouts.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Menambahkan Siswa/Siwsi</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">User Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update', ['id' => $data->id] )}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-bold">Nama</label>
                                <input type="text" name="nama" value="{{ old('nama', $data->nama) }}" id="nama" class="form-control fw-normal" placeholder="Nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}" id="tanggal_lahir" class="form-control fw-normal" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control fw-normal" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'L' ? 'selected' : ''}}>Laki-Laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'P' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="form-label fw-bold">Agama</label>
                                <input type="text" name="agama" value="{{ old('agama', $data->agama) }}" id="agama" class="form-control fw-normal" placeholder="Agama" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-bold">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control fw-normal" placeholder="Alamat" rows="3" required>{{ old('alamat', $data->alamat) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label fw-bold">Nomor HP</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}" id="no_hp" class="form-control fw-normal" placeholder="Nomor HP" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" name="email" value="{{ old('email', $data->email) }}" id="email" class="form-control fw-normal" placeholder="Email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection