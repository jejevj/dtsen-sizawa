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
                    <div class="card-header">
                        <h3 class="card-title">Profil Penerima</h3>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" id="cetakPDF" class="btn btn-icon-secondary btn-danger">
                                    <i class="ki-duotone ki-document fs-1"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    PDF
                                </button>
                            </div>
                            <!--end::Menu-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3" id="cetakArea">
                <div class="card">
                    <div class="card-header justify-content-center">
                        <div class="text-center mt-5">
                            <h3>
                                <strong>Nomor KTP (NIK):</strong> {{ $data['firstDetail']->nik }}
                            </h3>
                        </div>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mt-3 pt-3">
                    <div class="card-header">
                        <h3 class="card-title">Detail Program Yang Diterima</h3>
                    </div>
                    <div class="card-body">
                        <table id="kt_datatable_row_grouping"
                            class="table table-striped table-row-bordered gy-5 gs-7 border rounded w-100">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>LAZ</th>
                                    <th>Nama Program</th>
                                    <th>Tanggal</th>
                                    <th>Tipe</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['detailPenerima'] as $detail)
                                    <tr>
                                        <td>{{ $detail->nik }}</td>
                                        <td>{{ $detail->nama_lengkap }}</td>
                                        <td>{{ $detail->laz_nama }}</td>
                                        <td>{{ $detail->program_nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($detail->tanggal_terima)->locale('id')->isoFormat('DD MMMM YYYY') }}
                                        </td>
                                        <td>
                                            {{ $detail->tipe_penerimaan == 'pml' ? 'Bantuan Langsung' : 'Bantuan Tidak Langsung' }}
                                            </li>
                                        </td>
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
            let data = @json($data['dataDetail']);      // <-- your JSON payload
            const tableBody = document.getElementById('tableBody');
            const keys = Object.keys(data[0]);     // all columns in the payload

            // ------------- 2️⃣  Key → display name map -------------
            const keyMap = {
                'jenis_kelamin': 'Jenis Kelamin',
                'nama_lengkap': 'Nama Lengkap',
                'nik': 'NIK',
                'lahir_tanggal': 'Tanggal Lahir',
                'agama': 'Agama',
                'alamat_domisili': 'Alamat Domisili',
                'ktp_alamat': 'Alamat KTP',
                'provinsi_nama': 'Provinsi Domisili',
                'kabkota_nama': 'Kabupaten / Kota Domisili',
                'kecamatan_nama': 'Kecamatan Domisili',
                'kelurahan_nama': 'Kelurahan Domisili',
                'ktp_provinsi_nama': 'Provinsi KTP',
                'ktp_kabkota_nama': 'Kabupaten / Kota KTP',
                'ktp_kecamatan_nama': 'Kecamatan KTP',
                'ktp_kelurahan_nama': 'Kelurahan KTP'
            };

            // ------------- 3️⃣  Build the table -------------
            keys.forEach(key => {
                // Skip columns that you don’t want to display
                if (['Nominal_Bantuan', 'laz_nama', 'created_at', 'skala', 'rupiah', 'program_nama'].includes(key)) {
                    return;
                }

                let headerInserted = false;   // flag so the header is written only once

                data.forEach((item, idx) => {
                    // 1. Skip null values
                    if (item[key] == null) return;
                    // 2. Skip duplicate consecutive values
                    if (idx > 0 && item[key] === data[idx - 1][key]) return;

                    const row = document.createElement('tr');

                    // ---- 3a. Header cell (first row of this key) ----
                    const cell1 = document.createElement('td');
                    cell1.textContent = headerInserted ? '' : (keyMap[key] || key);
                    cell1.classList.add('fw-bold'); // <‑‑ add bold style
                    headerInserted = true;

                    // ---- 3b. Value cell ----
                    const cell2 = document.createElement('td');
                    cell2.textContent = item[key] ?? '';

                    // ---- 3c. LAZ name cell (kept as is) ----
                    const cell3 = document.createElement('td');
                    cell3.textContent = item['laz_nama'] ?? '';

                    // Assemble the row
                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    row.appendChild(cell3);

                    // Append the row to the table body
                    tableBody.appendChild(row);
                });
            });



            // ------------------------------------------------------------
            const nominalColumn = 6;          // ← numeric column
            const groupColumn = 2;          // ← grouping column
            // ------------------------------------------------------------
            /* 1️⃣  Helper – strip non‑digits, then convert to Number */
            function toNumber(str) {
                // Remove everything except digits
                const num = Number(str.replace(/[^\d]/g, '')); // "5,000,000" → 5000000
                return isNaN(num) ? 0 : num;                  // guard against NaN
            }
            function formatRp(n) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(n);
            }
            // ------------------------------------------------------------
            var table = $("#kt_datatable_row_grouping").DataTable({
                "columnDefs": [{ "visible": false, "targets": groupColumn }],
                "order": [[groupColumn, "asc"]],
                "displayLength": 100,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({ page: "current" }).nodes();
                    var last = null;

                    /* ---- 4a. Sum per group on the current page ---- */
                    var sums = {};   // { groupName : totalNominal }
                    api.rows({ page: "current" }).data().each(function (row, i) {
                        var group = row[groupColumn];
                        var nominal = toNumber(row[nominalColumn]);   // <-- fixed here

                        sums[group] = (sums[group] || 0) + nominal;
                    });

                    /* ---- 4b. Insert group header rows ---- */
                    api.column(groupColumn, { page: "current" }).data().each(function (group, i) {
                        if (last !== group) {
                            // No formatting – just show the raw number
                            $(rows).eq(i).before(
                                `<tr class="group fs-5 fw-bolder">
                                                                                                                                <td colspan="4">${group}</td>
                                                                                                                                <td colspan="2" class="text-end">${formatRp(sums[group])}</td>
                                                                                                                             </tr>`
                            );
                            last = group;
                        }
                    });

                    /* ---- 3. Remove any previously added Total row ---- */
                    $('.total-row').remove();

                    /* ---- 4. Compute the grand total (across all rows) ---- */
                    var overallSum = api.column(nominalColumn, { page: "all" })
                        .data()
                        .reduce(function (a, b) {
                            return a + toNumber(b);
                        }, 0);

                    /* ---- 5. Append the Total row at the very end ---- */
                    var totalRow = `<tr class="group fs-5 fw-bolder total-row">
                                                                                                                                <td colspan="4">Grand Total</td>
                                                                                                                                <td colspan="2" class="text-end">${formatRp(overallSum)}</td>
                                                                                                                            </tr>`;
                    $('#kt_datatable_row_grouping tbody').append(totalRow);
                }
            });

            // Order by the grouping
            $("#kt_datatable_row_grouping tbody").on("click", "tr.group", function () {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === groupColumn && currentOrder[1] === "asc") {
                    table.order([groupColumn, "desc"]).draw();
                } else {
                    table.order([groupColumn, "asc"]).draw();
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const btnCetak = document.getElementById('cetakPDF');
                const areaToPrint = document.getElementById('cetakArea');

                if (!btnCetak || !areaToPrint) return; // safety

                btnCetak.addEventListener('click', function () {
                    const opt = {
                        margin: 1,
                        filename: 'cetakArea.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2, useCORS: true },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };

                    // html2pdf will capture the element, render it to a canvas, then
                    // convert the canvas into a PDF that is automatically downloaded.
                    html2pdf().set(opt).from(areaToPrint).save();
                });
            });
        </script>
    @endsection
@endsection