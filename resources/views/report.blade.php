@extends('layouts.app')

@section('content')
    <div class="container py-5 mt-10">
        <div class="text-center">
            <h1 class="">Ringkasan Laporan Pemberdayaan Zakat</h1>
            <p class="lead">Bantuan yang tercatat yaitu penerima manfaat berbasis NIK</p>
        </div>
        .<div class="row ">
            {{-- Start Filter --}}
            <div class="col-md-5 col-lg-5 ">
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
            <div class="col-md-7 col-lg-7 ">
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
                        .<div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-6 mt-2">
                                <div class="card card-flush card-bordered">
                                    <div class="card-header">
                                        <h3 class="card-title mt-5">Total</h3>
                                        <span class="mb-5">Penerima Manfaat</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-6 mt-2">
                                <div class="card card-flush card-bordered">
                                    <div class="card-header">
                                        <h3 class="card-title mt-5">Total</h3>
                                        <span class="mb-5">Besaran Penyaluran</span>
                                    </div>
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
                                    Tab 1
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                    Tab 2
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
        </script>
    @endsection
@endsection