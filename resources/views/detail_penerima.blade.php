@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4">Detail Penerima Manfaat</h1>
            <p class="lead">Informasi detail mengenai penerima manfaat.</p>
        </div>

        <!-- Profile Section -->
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center justify-content-center">
                        <h3 class="card-title">Profil Penerima</h3>
                    </div>
                    <div class="text-center pt-5">

                        <h4>
                            <strong>Nomor KTP (NIK):</strong> {{ $data['firstDetail']->nik }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered table-hovered tg" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Informasi</th>
                                        <th>LAZ</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">

                                    <!-- Data rows will be inserted here by JavaScript -->

                                </tbody>
                            </table>
                        </div>

                        {{-- <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nomor KTP (NIK):</strong> {{ $data['firstDetail']->nik }}
                            </li>
                            <li class="list-group-item"><strong>Nama Lengkap:</strong>
                                {{ $data['firstDetail']->nama_lengkap }}</li>
                            <li class="list-group-item"><strong>Nomor KK:</strong> {{ $data['firstDetail']->kk }}
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
                        </ul> --}}
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Program Yang Diterima</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>KK</th>
                                    <th>Nama Lengkap</th>
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
                                        <td>{{ $detail->nik }}</td>
                                        <td>{{ $detail->kk }}</td>
                                        <td>{{ $detail->nama_lengkap }}</td>
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

    @section('content_scripts')
        <script>
            let data = @json($data['dataDetail']); // Your data from the backend

            // Create a variable to store the previous values of keys
            let previousValues = {};


            console.log(data);  // Output the modified data with empty duplicates

            const tableBody = document.getElementById('tableBody');

            // Get the keys from the first item in the data array (assuming all items have the same structure)
            const keys = Object.keys(data[0]);

            let previousValues2 = {};
            // Loop through each key (the column headers)
            keys.forEach((key) => {
                // Loop through each item in the data and group the values for this key
                if (key === 'Nominal_Bantuan') {
                    return; // This skips the rest of the code in the loop for 'rupiah' key
                }
                if (key === 'laz_nama') {
                    return; // This skips the rest of the code in the loop for 'rupiah' key
                }
                if (key === 'created_at') {
                    return; // This skips the rest of the code in the loop for 'rupiah' key
                }
                if (key === 'skala') {
                    return; // This skips the rest of the code in the loop for 'rupiah' key
                }
                data.forEach((item, index) => {

                    if (item[key] == null) {
                       
                        return;

                    } else {
                        // Iterate over each key in the current item
                        // for (let key in item) {
                        //     if (item[key] !== undefined && item[key] !== null) {
                        //         // If the value for this key has appeared before, make it empty
                        //         if (previousValues[key] === item[key]) {
                        //             item[key] = '';  // Make the value empty if it's a duplicate
                        //         }
                        //         // Otherwise, store this value for future comparison
                        //         previousValues[key] = item[key];
                        //     }
                        // }
                        const row = document.createElement('tr');
                        // Create the first cell for the key name, only for the first row
                        const cell1 = document.createElement('td');
                        if (index === 0) {
                            cell1.textContent = key;  // The name of the key (e.g., 'provinsi_nama')
                            // cell1.rowSpan=2;
                        } else {
                            cell1.textContent = '';  // Empty cell for subsequent rows
                        }

                        // Create the second cell for the value of the key
                        const cell2 = document.createElement('td');
                        cell2.textContent = item[key] || '';  // Get the value for this key (or empty string if undefined)

                        // Create the third cell for the second value (if available), else empty
                        const cell3 = document.createElement('td');
                        // You can leave this cell empty or set it as needed
                        cell3.textContent = item['laz_nama']; // Leave empty or set a default value

                        // Append the cells to the row
                        row.appendChild(cell1);
                        row.appendChild(cell2);
                        row.appendChild(cell3);

                        // Append the row to the table body
                        tableBody.appendChild(row);
                    }
                });
            });

            // Initialize the DataTable once the table is populated
            // $(document).ready(function () {
            //     $('#dataTable').DataTable();
            // });
        </script>
    @endsection
@endsection