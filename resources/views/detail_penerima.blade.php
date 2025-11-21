@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4">Detail Penerima Manfaat</h1>
            <p class="lead">Informasi detail mengenai penerima manfaat.</p>
        </div>

        <!-- Profile Section -->
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profil Penerima</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nama Lengkap:</strong>
                                {{ $data['firstDetail']->nama_lengkap }}</li>
                            <li class="list-group-item"><strong>Nomor KTP (NIK):</strong> {{ $data['firstDetail']->nik }}
                            </li>
                            <li class="list-group-item"><strong>Agama:</strong> {{ $data['firstDetail']->agama }}</li>
                            <li class="list-group-item"><strong>Status Kawin:</strong>
                                {{ $data['firstDetail']->kawin_status == 'kw' ? 'Kawin' : 'Belum Kawin' }}</li>
                            <li class="list-group-item"><strong>Tanggal Lahir:</strong>
                                {{ \Carbon\Carbon::parse($data['firstDetail']->lahir_tanggal)->format('d M Y') }}</li>
                            <li class="list-group-item"><strong>Jenis Kelamin:</strong>
                                {{ $data['firstDetail']->jenis_kelamin == 'M' ? 'Laki-laki' : 'Perempuan' }}</li>
                            <li class="list-group-item"><strong>Alamat Domisili:</strong>
                                {{ $data['firstDetail']->alamat_domisili }}</li>
                            <li class="list-group-item"><strong>Program:</strong> {{ $data['firstDetail']->program_nama }}
                            </li>
                            <li class="list-group-item"><strong>Lembaga:</strong> {{ $data['firstDetail']->laz_nama }}</li>
                            <li class="list-group-item"><strong>Tanggungan:</strong> {{ $data['firstDetail']->tanggungan }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Program Yang Diterima</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Program</th>
                                    <th>LAZ</th>
                                    <th>Tanggal</th>
                                    <th>Tipe </th>
                                    <th>Domisili</th>
                                    <th>Rupiah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['detailPenerima'] as $detail)
                                    <tr>
                                        <td>{{ $detail->program_kode }}</td>
                                        <td>{{ $detail->program_nama }}</td>
                                        <td>{{ $detail->laz_nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($detail->tanggal_terima)->format('d M Y') }}</td>
                                        {{-- <td>{{ $detail->tipe_penerimaan }}</td> --}}
                                        <td>
                                            {{ $detail->tipe_penerimaan == 'pml' ? 'Bantuan Langsung' : 'Bantuan Tidak Langsung' }}
                                            </li>
                                        </td>
                                        <td>{{ $detail->alamat_domisili }}</td>
                                        <td>{{ number_format($detail->rupiah, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection