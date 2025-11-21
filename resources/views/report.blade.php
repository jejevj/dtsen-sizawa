@extends('layouts.app')

@section('content')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 100%;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid var(--highcharts-neutral-color-10, #e6e6e6);
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: var(--highcharts-neutral-color-60, #666);
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tbody tr:nth-child(even) {
            background: var(--highcharts-neutral-color-3, #f7f7f7);
        }

        .highcharts-description {
            margin: 0.3rem 10px;
        }
    </style>
    <div class="py-5 mt-10">
        <div class="text-center">
            <h1 class="">Ringkasan Laporan Pemberdayaan Zakat</h1>
            <p class="lead">Bantuan yang tercatat yaitu penerima manfaat berbasis NIK</p>
        </div>
        .<div class="row ">
            {{-- Start Filter --}}
            <div class="col-md-4 col-lg-4 ">
                <form action="">
                    <!--begin::Chart widget 15-->
                    <div class="card card-shadow-sm ">
                        <!--begin::Header-->
                        <div class="card-header">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Filter</span>
                                <span class="text-gray-500 pt-2 fw-semibold fs-6">Pilih Opsi Dibawah</span>
                            </h3>

                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-sm btn-primary">Terapkan</a>
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Item-->
                            <div class="mb-5">
                                <!--begin::Accordion-->
                                <!--begin::Section-->
                                <div class="m-0">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_8_1">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                            <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">LAZ Pemberi</h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_8_1" class="show collapse fs-6 ms-1">
                                        <div id="kt_ob_skala1" class="fs-6 ms-1 mb-3">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Skala --" id="skala" name="skala">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div id="kt_job_skala2" class="fs-6 ms-1 mb-6">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Nama Laz --" id="nama_laz" name="nama_laz">
                                                <option></option>
                                                <option value="1">Laz 1</option>
                                                <option value="2">Laz 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->

                                {{-- KTP --}}
                                <!--begin::Section-->
                                <div class="m-0 mt-3">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_job_8_2">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                            <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Wilayah KTP Penerima Manfaat
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_job_8_2" class="collapse fs-6 ms-1">
                                        <div id="kt_job_ktp1" class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Provinsi --" id="provinsi_ktp" name="provinsi_ktp">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div id="kt_job_ktp2" class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Kabupaten/Kota --" id="kabupaten_ktp"
                                                name="kabupaten_ktp">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div id="kt_job_ktp3" class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Kecamatan --" id="kecamatan_ktp" name="kecamatan_ktp">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div id="kt_job_ktp4" class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Kelurahan/Desa --" id="kelurahan_ktp"
                                                name="kelurahan_ktp">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div class="fs-6 ms-1 mb-6">
                                            <input type="text" name="alamat_ktp" id="alamat_ktp" class="form-control"
                                                placeholder="Alamat" />
                                        </div>

                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                {{-- KTP --}}

                                {{-- DOMISILI --}}
                                <!--begin::Section-->
                                <div class="m-0 mt-3">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_domisili_8_2">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                            <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Wilayah Domisili Penerima
                                            Manfaat
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_domisili_8_2" class="collapse fs-6 ms-1">
                                        <div id="kt_job_ktp1" class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Provinsi --" id="provinsi_domisili"
                                                name="provinsi_domisili">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div id="kt_job_ktp2" class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Kabupaten/Kota --" id="kabupaten_domisili"
                                                name="kabupaten_domisili">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div id="kt_job_ktp3" class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Kecamatan --" id="kecamatan_domisili"
                                                name="kecamatan_domisili">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div id="kt_job_ktp4" class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Kelurahan/Desa --" id="kelurahan_domisili"
                                                name="kelurahan_domisili">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div class="fs-6 ms-1 mb-6">
                                            <input type="text" name="alamat_domisili" id="alamat_domisili"
                                                class="form-control" placeholder="Alamat" />
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                {{-- DOMISILI --}}

                                {{-- DATA DIRI --}}
                                <!--begin::Section-->
                                <div class="m-0 mt-3">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_datadiri_8_2">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                            <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Data Diri Penerima Manfaat
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_datadiri_8_2" class="collapse fs-6 ms-1">
                                        <div id="kt_job_ktp1" class="fs-6 ms-1 mb-5">
                                            <input type="text" class="form-control" name="kk" id="kk"
                                                aria-describedby="helpId" placeholder="KK" />
                                        </div>
                                        <div id="kt_job_ktp2" class="fs-6 ms-1 mb-5">
                                            <input type="text" class="form-control" name="nik" id="nik"
                                                aria-describedby="helpId" placeholder="NIK" />
                                        </div>
                                        <div id="kt_job_ktp3" class="fs-6 ms-1 mb-5">
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                aria-describedby="helpId" placeholder="Nama" />
                                        </div>
                                        <div id="kt_job_ktp4" class="fs-6 ms-1 mb-5">
                                            <span>Tanggal Lahir:</span>
                                            <div class="row justify-content-center align-items-center g-2">
                                                <div class="col-5">

                                                    <input class="form-control" type="date" name="tgl_lahir_start"
                                                        id="kt_datepicker_1" />
                                                </div>
                                                <div class="col-2 text-center">s.d</div>
                                                <div class="col-5">

                                                    <input class="form-control" type="date" name="tgl_lahir_end"
                                                        id="kt_datepicker_2" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Dokumen KTP --" name="dokumen_ktp" id="dokumen_ktp">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Agama --" name="agama" id="agama">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div class="fs-6 ms-1 mb-6">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Jenis Kelamin --" name="jenis_kelamin"
                                                id="jenis_kelamin">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed"></div>
                                    <!--end::Separator-->
                                </div>
                                <!--end::Section-->
                                {{-- DATA DIRI --}}

                                {{-- Program --}}
                                <!--begin::Section-->
                                <div class="m-0 mt-3">
                                    <!--begin::Heading-->
                                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0"
                                        data-bs-toggle="collapse" data-bs-target="#kt_datadiri_8_9">
                                        <!--begin::Icon-->
                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <i class="ki-outline ki-minus-square toggle-on text-primary fs-1"></i>
                                            <i class="ki-outline ki-plus-square toggle-off fs-1"></i>
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">Program
                                        </h4>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div id="kt_datadiri_8_9" class="collapse fs-6 ms-1">
                                        <div class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Kategori Program --" name="kategori_program"
                                                id="kategori_program">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>
                                        <div id="kt_job_ktp1" class="fs-6 ms-1 mb-5">
                                            <input type="text" class="form-control" name="nama_program" id="nama_program"
                                                aria-describedby="helpId" placeholder="Nama Program" />
                                        </div>
                                        <div class="fs-6 ms-1 mb-5">
                                            <select class="form-select" data-control="select2"
                                                data-placeholder="-- Tipe Program --" name="tipe_program" id="tipe_program">
                                                <option></option>
                                                <option value="1">Option 1</option>
                                                <option value="2">Option 2</option>
                                            </select>
                                        </div>

                                        <div id="kt_job_ktp3" class="fs-6 ms-1 mb-5">

                                            <span class="mb-2">Jumlah Penyaluran:</span>
                                            <div id="kt_slider_basic" class="mt-2"></div>
                                            <div class="">
                                                .<div class="row ">
                                                    <div class="col">
                                                        <div class="fw-semibold ">Min: <span
                                                                id="kt_slider_basic_min"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="fw-semibold ">Max: <span
                                                                id="kt_slider_basic_max"></span></div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div id="kt_job_ktp4" class="fs-6 ms-1">
                                            <span class="mb-4">Waktu Diberikan:</span>
                                            <div class="row justify-content-center align-items-center g-2">
                                                <div class="col-5">

                                                    <input class="form-control" type="date" name="waktu_start"
                                                        id="kt_datepicker_1" />
                                                </div>
                                                <div class="col-2 text-center">s.d</div>
                                                <div class="col-5">

                                                    <input class="form-control" type="date" name="waktu_end"
                                                        id="kt_datepicker_2" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->
                                {{-- Program --}}
                            </div>
                            <!--end::Item-->
                            {{-- tes --}}
                            <a href="#" class="btn btn-icon-secondary btn-primary">
                                <i class="ki-duotone ki-filter-tick fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                                Terapkan Filter
                            </a>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 15-->
                </form>
            </div>
            {{-- End Filter --}}
            <div class="col-md-8 col-lg-8 ">
                <div class="card card-shadow-sm ">
                    <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">Hasil Laporan</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        {{-- General Summary --}}
                        <div class="row">
                            @if(isset($error_message))
                                <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                    <i class="ki-duotone ki-information fs-2hx text-light me-4 mb-5 mb-sm-0"><span
                                            class="path1"></span><span class="path2"></span><span class="path3"></span></i>

                                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                        <h4 class="mb-2 text-light">Terjadi Kesalahan</h4>

                                        <span>{{ $error_message }}</span>

                                    </div>

                                    <button type="button"
                                        class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                        data-bs-dismiss="alert">
                                        <i class="ki-duotone ki-cross fs-1 text-light"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </button>

                                </div>
                            @endif

                            <div class="col-md-4 col-lg-4 col-sm-6 mt-2">
                                <div class="card card-flush card-bordered">
                                    <div class="card-header">
                                        <h3 class="card-title mt-5">Total:
                                            {{ number_format($data['penerima_manfaat']) }}
                                        </h3>
                                        <span class="mb-5">Penerima Manfaat</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 col-lg-5 col-sm-6 mt-2">
                                <div class="card card-flush card-bordered">
                                    <div class="card-header">
                                        <h3 class="card-title mt-5">Total: {{ number_format($data['penyaluran']) }}</h3>
                                        <span class="mb-5">Besaran Penyaluran</span>
                                    </div>
                                </div>
                            </div>
                            {{-- General Summary --}}

                            .<div class="row g-2 mt-4">
                                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Grafik</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Tabulasi</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                        <div class="row justify-content-center align-items-center g-2">
                                            {{-- Chart PM Gender --}}
                                            <div class="col-md-6 col-lg-6 col-sm-12 mt-3">
                                                <div class="card ">
                                                    <div class="class p-1">
                                                        <div id="pie_chart_pm_gender" style="width:auto; height: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Chart Penyaluran Gender --}}
                                            <div class="col-md-6 col-lg-6 col-sm-12 mt-3">
                                                <div class="card ">
                                                    <div class="class p-1">
                                                        <div id="pie_chart_pm_gender2" style="width:auto; height: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Chart Penyaluran Gender --}}
                                            {{-- Chart Penyaluran Program --}}
                                            <div class="col-md-6 col-lg-6 col-sm-12 mt-3">
                                                <div class="card ">
                                                    <div class="class p-1">
                                                        <div id="pie_chart_program" style="width:auto; height: auto;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12 mt-3">
                                                <div class="card ">
                                                    <div class="class p-1">
                                                        <div id="pie_chart_bidang" style="width:auto; height: auto;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Chart Penyaluran Program --}}
                                            <div class="col">

                                                <div class="card">
                                                    <div class="kt-card-content highcharts-figure">
                                                        <div id="line_penyaluran" style="400px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="kt_datatable_zero_configuration"
                                                class="table table-row-bordered gy-5">
                                                <thead>
                                                    <tr class="fw-semibold fs-6 text-muted">
                                                        <th>NIK</th>
                                                        <th>Nama PM</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Domisili</th>
                                                        <th>Alamat KTP</th>
                                                        <th>Nominal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- // I WANT TO DO SERVER SIDE HERE --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            </div>

        </div>
        @section('content_scripts')
            <script>
                var slider = document.querySelector("#kt_slider_basic");
                var valueMin = document.querySelector("#kt_slider_basic_min");
                var valueMax = document.querySelector("#kt_slider_basic_max");
                // I Will put this into the bodyRequest. if you AI agent please ignore tese javascript line for the noUiSlider

                noUiSlider.create(slider, {
                    start: [100000, 2500000],
                    connect: true,
                    range: {
                        "min": 1000,
                        "max": 10000000
                    },

                    format: wNumb({
                        decimals: 2,
                        thousand: '.',
                        suffix: ' (IDR)'
                    })
                });


                slider.noUiSlider.on("update", function (values, handle) {
                    if (handle) {
                        valueMax.innerHTML = values[handle];
                    } else {
                        valueMin.innerHTML = values[handle];
                    }
                });

                Highcharts.chart('pie_chart_pm_gender', {
                    chart: {
                        type: 'pie',
                        zooming: {
                            type: 'xy'
                        },
                        panning: {
                            enabled: true,
                            type: 'xy'
                        },
                        panKey: 'shift'
                    },
                    title: {
                        text: 'Jumlah Penerima Manfaat Berdasarkan Gender'
                    },
                    tooltip: {
                        pointFormat: 'Jumlah: <b>{point.y}</b>'
                    },
                    subtitle: {
                        text: 'Source: SIMZAT'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: [{
                                enabled: true,
                                distance: 10
                            }, {
                                enabled: true,
                                distance: -20,
                                format: '{point.percentage:.1f}%',  // Automatically display percentage
                                style: {
                                    fontSize: '1.2em',
                                    textOutline: 'none',
                                    opacity: 0.7
                                },
                                filter: {
                                    operator: '>',
                                    property: 'percentage',
                                    value: 10  // Only show percentages greater than 10%
                                }
                            }]
                        }
                    },
                    series: [
                        {
                            name: 'Percentage',
                            colorByPoint: true,
                            data: [
                                {
                                    name: 'Laki-laki',
                                    y: {{ $data['male_count'] }},
                                },
                                {
                                    name: 'Perempuan',
                                    sliced: true,
                                    selected: true,
                                    y: {{ $data['female_count'] }},
                                }
                            ]
                        }
                    ]
                });


                Highcharts.chart('pie_chart_pm_gender2', {
                    chart: {
                        type: 'pie',
                        zooming: {
                            type: 'xy'
                        },
                        panning: {
                            enabled: true,
                            type: 'xy'
                        },
                        panKey: 'shift'
                    },
                    title: {
                        text: 'Jumlah Penyaluran Berdasarkan Gender'
                    },
                    tooltip: {
                        pointFormat: 'Jumlah: <b>Rp. {point.y}</b>'
                    },
                    subtitle: {
                        text: 'Source: SIMZAT'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: [{
                                enabled: true,
                                distance: 20
                            }, {
                                enabled: true,
                                distance: -40,
                                format: '{point.percentage:.1f}%',  // Automatically display percentage
                                style: {
                                    fontSize: '1.2em',
                                    textOutline: 'none',
                                    opacity: 0.7,
                                },
                                filter: {
                                    operator: '>',
                                    property: 'percentage',
                                    value: 10  // Only show percentages greater than 10%
                                }
                            }]
                        }
                    },
                    series: [
                        {
                            name: 'Percentage',
                            colorByPoint: true,
                            data: [
                                {
                                    name: 'Laki-laki',
                                    y: {{ $data['male_total_penyaluran'] }},
                                    color: '#2ed573'
                                },
                                {
                                    name: 'Perempuan',
                                    sliced: true,
                                    selected: true,
                                    y: {{ $data['female_total_penyaluran'] }},
                                    color: '#ff4757'
                                }
                            ]
                        }
                    ]
                });

                Highcharts.chart('pie_chart_program', {

                    size: '80%',
                    chart: {
                        type: 'pie',
                        zooming: {
                            type: 'xy'
                        },
                        panning: {
                            enabled: true,
                            type: 'xy'
                        },
                        panKey: 'shift'
                    },
                    title: {
                        text: 'Jumlah Penyaluran Berdasarkan Tipe Program'
                    },
                    tooltip: {
                        pointFormat: 'Jumlah: <b>Rp. {point.y}</b>'
                    },
                    subtitle: {
                        text: 'Source: SIMZAT'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: [{
                                enabled: true,
                                distance: 20
                            }, {
                                enabled: true,
                                distance: -40,
                                format: '{point.percentage:.1f}%',  // Automatically display percentage
                                style: {
                                    fontSize: '1.2em',
                                    textOutline: 'none',
                                    opacity: 0.7,
                                },
                                filter: {
                                    operator: '>',
                                    property: 'percentage',
                                    value: 10  // Only show percentages greater than 10%
                                }
                            }]
                        }
                    },
                    series: [
                        {
                            name: 'Percentage',
                            colorByPoint: true,
                            data: [
                                {
                                    name: 'Langsung',
                                    y: {{ $data['langsung_total'] }},

                                    color: '#e15f41'
                                },
                                {
                                    name: 'Tidak Langsung',
                                    sliced: true,
                                    selected: true,
                                    y: {{ $data['tidak_langsung_total'] }},

                                    color: '#546de5'
                                }
                            ]
                        }
                    ]
                });


                // Pass the PHP data to JavaScript
                var bidangData = @json($data['bidangData']);  // Assuming this is the variable from the controller

                // Prepare the data dynamically for Highcharts
                var chartData = bidangData.map(function (item) {
                    return {
                        name: item.bidang_label,  // Bidang label
                        y: Math.floor(item.total_penyaluran),
                        color: Highcharts.getOptions().colors[bidangData.indexOf(item) % Highcharts.getOptions().colors.length]  // Assign dynamic colors
                    };
                });


                Highcharts.chart('pie_chart_bidang', {

                    size: '80%',
                    chart: {
                        type: 'pie',
                        zooming: {
                            type: 'xy'
                        },
                        panning: {
                            enabled: true,
                            type: 'xy'
                        },
                        panKey: 'shift'
                    },
                    title: {
                        text: 'Jumlah Penyaluran Berdasarkan Bidang Program'
                    },
                    tooltip: {
                        pointFormat: 'Jumlah: <b>Rp. {point.y}</b>'
                    },
                    subtitle: {
                        text: 'Source: SIMZAT'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: [{
                                enabled: true,
                                distance: 20
                            }, {
                                enabled: true,
                                distance: -40,
                                format: '{point.percentage:.1f}%',  // Automatically display percentage
                                style: {
                                    fontSize: '1.2em',
                                    textOutline: 'none',
                                    opacity: 0.7,
                                },
                                filter: {
                                    operator: '>',
                                    property: 'percentage',
                                    value: 10  // Only show percentages greater than 10%
                                }
                            }]
                        }
                    },
                    series: [
                        {
                            name: 'Percentage',
                            colorByPoint: true,
                            data: chartData
                        }
                    ]
                });

                // Pass the PHP data to JavaScript
                var timeSeriesData = @json($data['timeSeriesData']);  // This will pass the PHP data to JavaScript

                // Prepare the data dynamically for Highcharts
                var bantuanLangsungData = [];
                var bantuanTidakLangsungData = [];
                var years = [];

                // Process the data to separate Bantuan Langsung and Bantuan Tidak Langsung by year
                timeSeriesData.forEach(function (item) {
                    years.push(item.tahun);

                    // Ensure the data is a number (parse it if necessary)
                    var totalRupiah = parseFloat(item.Bantuan_Langsung); // Converts the value to a number
                    var totalRupiah2 = parseFloat(item.Bantuan_Tidak_Langsung); // Converts the value to a number


                    bantuanLangsungData.push(totalRupiah);
                    bantuanTidakLangsungData.push(totalRupiah2);

                    console.log('Year:', item.tahun, 'Type:', item.tipe_penerimaan, 'Total:', totalRupiah);
                });

                // Highcharts configuration for the line chart
                Highcharts.chart('line_penyaluran', {
                    title: {
                        text: 'Penyaluran dengan Tipe Penyaluran',
                        align: 'left'
                    },

                    subtitle: {
                        text: 'Source: SIMZAT',
                        align: 'left'
                    },
                    exporting: {
                        showTable: true
                    },
                    yAxis: {
                        title: {
                            text: 'Rupiah'
                        }
                    },

                    xAxis: {
                        categories: years, // Using years array for the x-axis categories
                        accessibility: {
                            rangeDescription: 'Range: ' + years[0] + ' to ' + years[years.length - 1]
                        }
                    },

                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },

                    plotOptions: {
                        series: {
                            label: {
                                connectorAllowed: false
                            },
                            pointStart: years[0]  // The starting year for the series
                        }
                    },

                    series: [{
                        name: 'Bantuan Langsung',
                        color: '#6F1E51',
                        data: bantuanLangsungData
                    }, {
                        name: 'Bantuan Tidak Langsung',
                        color: '#A3CB38',
                        data: bantuanTidakLangsungData
                    }],

                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    }

                });

                var table = $('#kt_datatable_zero_configuration').DataTable({
                    processing: true,
                    serverSide: false,
                    data: [],
                    columns: [
                        { data: 'nik', name: 'nik' },
                        { data: 'nama_pm', name: 'nama_pm' },
                        {
                            data: 'jenis_kelamin', name: 'jenis_kelamin', render: function (data, type, row) {
                                return data === 'M' ? 'Laki-laki' : (data === 'F' ? 'Perempuan' : data);
                            }
                        },
                        { data: 'domisili', name: 'domisili' },
                        { data: 'alamat_ktp', name: 'alamat_ktp' },
                        {
                            data: 'nominal',
                            name: 'nominal',
                            render: function (data, type, row) {
                                if (data === null || data === undefined) {
                                    return 'Rp. 0';
                                }
                                let n = Number(data);
                                if (isNaN(n)) {
                                    return data;
                                }
                                return 'Rp. ' + n.toLocaleString('id-ID');
                            }
                        }
                    ]
                });

                fetch('{{ url("/proxy") }}')
                    .then(response => response.json())  // Parse the JSON response
                    .then(data => {
                        console.log('Full response:', data);  // Log the full response to check its structure

                        if (data && data.data) {
                            console.log('Data:', data.data); // Log the 'data' key specifically to check its contents

                            // Ensure that the 'data' key exists and then populate DataTable
                            table.clear().rows.add(data.data).draw();
                        } else {
                            console.error('No data found in the response');
                            alert('No data found in the response');
                        }
                    })


            </script>
        @endsection
@endsection