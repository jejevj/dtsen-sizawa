@extends('layouts.app')

@section('content')
    <div class="card-body p-lg-17">
        <!--begin::About-->
        <div class="mb-18">
            <!--begin::Wrapper-->
            <div class="mb-10">
                <!--begin::Top-->
                <div class="text-center mb-15">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-gray-900 mb-5">Selamat Datang di Dashboard Pemberdayaan Zakat</h3>
                    <!--end::Title-->

                    <!--begin::Text-->
                    <div class="fs-5 text-muted fw-semibold">
                        Dashboard Zakat Berbasis DTSEN ini hadir untuk memastikan penyaluran zakat benar-benar tepat
                        sasaran. Sistem ini menghubungkan data mustahik dengan Data Terpadu Sosial Ekonomi Nasional (DTSEN)
                        sehingga penerima zakat dapat diverifikasi berdasarkan NIK, alamat, dan kondisi sosial ekonomi
                        keluarga. Dengan cara ini, zakat tidak lagi disalurkan hanya berdasarkan usulan atau perkiraan,
                        tetapi berdasarkan data yang valid dan terukur.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Top-->

                <!--begin::Overlay-->
                <div class="overlay">
                    <!--begin::Image-->
                    <img class="w-100 card-rounded" src="assets/media/images-bg-home.jpg" alt="">
                    <!--end::Image-->

                    <!--begin::Links-->
                    {{-- <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                        <a href="/metronic8/demo35/pages/pricing.html" class="btn btn-primary">Pricing</a>

                        <a href="/metronic8/demo35/pages/careers/apply.html" class="btn btn-light-primary ms-3">Join Us</a>
                    </div> --}}
                    <!--end::Links-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Description-->
            <div class="fs-5 fw-semibold text-gray-600">
                <!--begin::Text-->
                <p class="mb-8">
                    Melalui pengelompokan desil kesejahteraan 1–6, dashboard memberikan gambaran siapa yang paling
                    membutuhkan bantuan, di mana mereka tinggal, dan bantuan apa yang sudah mereka terima sebelumnya.
                    Mustahik desil 1–3 diarahkan untuk bantuan kebutuhan dasar seperti pangan, kesehatan, dan pendidikan,
                    sementara desil 3–6 difokuskan pada program pemberdayaan ekonomi agar mereka dapat meningkatkan
                    pendapatan dan kemandirian.

                </p>
                <!--end::Text-->

                <!--begin::Text-->
                <p class="mb-8">
                    Dashboard ini juga membantu lembaga zakat menghindari bantuan ganda atau tumpang tindih dengan program
                    pemerintah seperti PKH, BPNT, BLT, dan P3KE. Setiap penyaluran dapat dipantau secara real-time — dari
                    penetapan penerima, proses penyaluran, sampai hasil yang dicapai penerima. Hal ini memperkuat
                    akuntabilitas, transparansi, dan kepercayaan publik terhadap pengelolaan zakat.
                </p>
                <!--end::Text-->

                <!--begin::Text-->
                <p class="mb-8">
                    Dengan berjalannya sistem ini, zakat tidak hanya menjadi bantuan jangka pendek, tetapi menjadi instrumen
                    peningkatan kesejahteraan masyarakat. Data membantu memastikan bahwa setiap rupiah zakat sampai kepada
                    orang yang tepat, menghasilkan perubahan yang terukur, dan mendorong keluarga mustahik untuk naik kelas
                    ekonomi hingga siap menjadi muzaki di masa depan. Dashboard ini menjadi fondasi penting bagi tata kelola
                    zakat yang modern, profesional, dan berdampak.
                </p>
                <!--end::Text-->
            </div>
            <!--end::Description-->
        </div>
        <!--end::About-->

        <!--begin::Statistics-->
        <div class="card bg-light mb-18">
            <!--begin::Body-->
            <div class="card-body py-15">
                <!--begin::Top-->
                <div class="text-center mb-12">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-gray-900 mb-5">Partisipasi</h3>
                    <!--end::Title-->

                </div>
                <!--end::Top-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-center">
                    <!--begin::Items-->
                    <div class="d-flex flex-center flex-wrap mb-10 mx-auto gap-5 w-xl-900px">

                        <!--begin::Item-->
                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                            <!--begin::Content-->
                            <div class="text-center">
                                <!--begin::Symbol-->
                                <i class="ki-outline ki-element-11 fs-2tx text-primary"></i> <!--end::Symbol-->

                                <!--begin::Text-->
                                <div class="mt-1">
                                    <!--begin::Animation-->
                                    <div class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                        <div class="min-w-70px counted" data-kt-countup="true" data-kt-countup-value="700"
                                            data-kt-initialized="1">700</div>
                                        +
                                    </div>
                                    <!--end::Animation-->

                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">LAZ NASIONAL</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                            <!--begin::Content-->
                            <div class="text-center">
                                <!--begin::Symbol-->
                                <i class="ki-outline ki-chart-pie-4 fs-2tx text-success"></i> <!--end::Symbol-->

                                <!--begin::Text-->
                                <div class="mt-1">
                                    <!--begin::Animation-->
                                    <div class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                        <div class="min-w-50px counted" data-kt-countup="true" data-kt-countup-value="80"
                                            data-kt-initialized="1">80</div>

                                        K+
                                    </div>
                                    <!--end::Animation-->

                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">LAZ PROVINSI</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                            <!--begin::Content-->
                            <div class="text-center">
                                <!--begin::Symbol-->
                                <i class="ki-outline ki-basket fs-2tx text-info"></i> <!--end::Symbol-->

                                <!--begin::Text-->
                                <div class="mt-1">
                                    <!--begin::Animation-->
                                    <div class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                        <div class="min-w-50px counted" data-kt-countup="true" data-kt-countup-value="35"
                                            data-kt-initialized="1">35</div>

                                        M+
                                    </div>
                                    <!--end::Animation-->

                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">LAZ Kab/Kota</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="octagon d-flex flex-center h-200px w-200px bg-body mx-lg-10">
                            <!--begin::Content-->
                            <div class="text-center">
                                <!--begin::Symbol-->
                                <i class="ki-outline ki-chart-pie-4 fs-2tx text-success"></i> <!--end::Symbol-->

                                <!--begin::Text-->
                                <div class="mt-1">
                                    <!--begin::Animation-->
                                    <div class="fs-lg-2hx fs-2x fw-bold text-gray-800 d-flex align-items-center">
                                        <div class="min-w-50px counted" data-kt-countup="true" data-kt-countup-value="80"
                                            data-kt-initialized="1">80</div>

                                        K+
                                    </div>
                                    <!--end::Animation-->

                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">Total Penyaluran</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Statistics-->


        <!--begin::Section-->
        <div class="mb-16">
            <!--begin::Top-->
            <div class="text-center mb-12">
                <!--begin::Title-->
                <h3 class="fs-2hx text-gray-900 mb-5">Sebaran Data Penyaluran Bantuan</h3>

                <!--begin::Text-->
                {{-- <div class="fs-5 text-muted fw-semibold">
                    Our goal is to provide a complete and robust theme solution <br>to boost all of our customer’s project
                    deployments
                </div> --}}
                <!--end::Text-->
                <!--end::Title-->
                <div class="card card-bordered mt-3">
                    <div class="card-header">
                        <form action="" class="mt-4">
                            <select class="form-select" data-control="select2"
                                data-placeholder="Jumlah Total Penerimaan Tahun Lalu" id="skala" name="skala">
                                <option></option>
                                <option value="1">Jumlah Total Penerimaan Tahun Lalu</option>
                                <option value="2">Jumlah Total Penyaluran Tahun Lalu</option>
                                <option value="3">Jumlah Penerima Manfaat</option>
                            </select>
                        </form>
                        <div class="card-toolbar">
                            
                    <button id="backBtn" class="btn btn-sm btn-info"
                        style="display: none;">Kembali Ke Peta
                        Indonesia</button>

                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div id="chartdiv" style="width: 100%; height: 500px;"></div> --}}
                        <div id="map" style="height: 600px; width: 100%;"></div>

                    </div>
                </div>
            </div>
            <!--end::Top-->

        </div>
        <!--end::Section-->
        {{-- <div class="mb-15">
            <!--begin::Title-->
            <h4 class="fs-2x text-gray-800 w-bolder mb-6 text-center">
                Frequesntly Asked Questions
            </h4>
            <!--end::Title-->

            <!--begin::Text-->
            <p class="fw-semibold fs-4 text-gray-600 mb-2 text-center">
                First, a disclaimer – the entire process of writing a blog post often takes more than a couple of hours,
                even if you can type eighty words as per minute and your writing skills are sharp.
            </p>
            <!--end::Text-->
            <!--begin::Accordion-->
            <div class="accordion accordion-icon-collapse" id="kt_accordion_3">
                <!--begin::Item-->
                <div class="mb-5">
                    <!--begin::Header-->
                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                        data-bs-target="#kt_accordion_3_item_1">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i>
                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">The best way to quick start business</h3>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div id="kt_accordion_3_item_1" class="fs-6 collapse show ps-10" data-bs-parent="#kt_accordion_3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil repellat alias aliquid modi facilis
                        incidunt cum itaque perspiciatis harum dolorum maxime sunt nulla suscipit voluptates corporis, iste
                        exercitationem! Incidunt, quasi?
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="mb-5">
                    <!--begin::Header-->
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse"
                        data-bs-target="#kt_accordion_3_item_2">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i>
                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">How To Create Channel ?</h3>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div id="kt_accordion_3_item_2" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Totam dolores minima officia ullam quam
                        modi, impedit, ut dolorem, fugiat doloribus ad laboriosam expedita fuga debitis sapiente hic
                        adipisci reiciendis nesciunt!
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Item-->

                <!--begin::Item-->
                <div class="mb-5">
                    <!--begin::Header-->
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse"
                        data-bs-target="#kt_accordion_3_item_3">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i>
                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">What are the support terms & conditions ?</h3>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div id="kt_accordion_3_item_3" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus velit quia repellat ex quod
                        minima, enim repudiandae impedit ratione veritatis iste hic, sint distinctio est eius quas harum
                        consectetur autem!
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Item-->
            </div>
            <!--end::Accordion-->
        </div> --}}
    </div>

    @section('content_scripts')


        <script>
            var map = L.map('map', {
                zoomControl: true,
                attributionControl: false
            }).setView([-2.5, 118], 5);


            var basePath = "assets/geojson/";
            var provinces = [
                "Aceh", "Bali", "Bangka Belitung", "Banten", "Bengkulu", "Gorontalo",
                "DKI Jakarta", "Jambi", "Jawa Barat", "Jawa Tengah", "Jawa Timur",
                "Kalimantan Barat", "Kalimantan Selatan", "Kalimantan Tengah", "Kalimantan Timur", "Kalimantan Utara",
                "Kepulauan Riau", "Lampung", "Maluku", "Maluku Utara", "Nusa Tenggara Barat", "Nusa Tenggara Timur",
                "Papua", "Papua Barat", "Riau", "Sulawesi Barat", "Sulawesi Selatan", "Sulawesi Tengah",
                "Sulawesi Tenggara", "Sulawesi Utara", "Sumatera Barat", "Sumatera Selatan", "Sumatera Utara", "Yogyakarta"
            ];

            var mainLayer = L.layerGroup();  // Indonesia provinces
            var provinceLayer;               // Detailed province

            function style(feature) {
                return {
                    fillColor: "#9fc98d",
                    weight: 1,
                    color: "#4f6d4a",
                    fillOpacity: 0.75
                };
            }

            function highlight(e) {
                var layer = e.target;
                layer.setStyle({
                    weight: 2,
                    color: "#2f4a2e",
                    fillOpacity: 0.9
                });
                layer.bringToFront();
            }

            function resetHighlight(e) {
                e.target.setStyle(style(e.target.feature));
            }

            // Load Indonesia provinces
            function formatRp(n) {
                // Indonesian currency – no decimals, thousands separated by '.'
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(n);
            }

            /*  ----------  main routine  ---------- */
            function loadIndonesia() {
                // 1️⃣  Map PHP array → JavaScript lookup array
                var provData = @json($data['penerimaan_provinsi']);

                // 2️⃣  Clear any old province layers
                mainLayer.clearLayers();

                provinces.forEach(function (province) {
                    // Find the province’s aggregate record
                    var provInfo = provData.find(function (d) {
                        return d.provinsi_nama === province;
                    });

                    // Guard: if nothing found, skip (or show “Tidak Ada Data”)
                    var tooltipText = 'Tidak Ada Data';
                    if (provInfo) {
                        if (provInfo.total_nominal_numeric !== 0) {
                            tooltipText = formatRp(provInfo.total_nominal_numeric);
                        } else {
                            tooltipText = provInfo.total_nominal_text;   // usually “Tidak Ada Data”
                        }
                    }

                    // 3️⃣  Load the geojson for the province
                    $.getJSON(basePath + province + "/Provinsi/" + province + ".geojson", function (geojson) {
                        var geo = L.geoJson(geojson, {
                            style: style,
                            onEachFeature: function (feature, layer) {
                                // Bind a tooltip that contains the province name & the formatted total
                                layer.bindTooltip(
                                    province + "<br>Total Penerimaan: " + tooltipText,
                                    { sticky: true }
                                );

                                // Event handlers
                                layer.on({
                                    mouseover: highlight,
                                    mouseout: resetHighlight,
                                    click: function () {
                                        // 1️⃣ Zoom to province bounds
                                        map.fitBounds(layer.getBounds());

                                        // 2️⃣ After zoom, show city details
                                        setTimeout(function () {
                                            showProvinceDetail(province);
                                        }, 300);   // 300 ms delay – zoom finished
                                    }
                                });
                            }
                        });

                        geo.addTo(mainLayer);   // Add this province’s layer to the main group
                    });
                });

                // 4️⃣  Add the group to the map (if it isn’t already)
                mainLayer.addTo(map);
            }

            // Load detailed province map
            function showProvinceDetail(province) {
                map.removeLayer(mainLayer);

                provinceLayer = L.layerGroup();
                $.getJSON(basePath + province + "/Kabupaten-Kota (Provinsi " + province + ")/Kabupaten-Kota (Provinsi " + province + ").geojson", function (data) {
                    var cityLayer = L.geoJson(data, {
                        style: style,
                        onEachFeature: function (feature, layer) {
                            layer.bindTooltip("Kabupaten/Kota: " + feature.properties.NAME_2 + "<br>Total Penerima Bantuan<br>Total Penerima Manfaat", { sticky: true });
                            layer.on({
                                mouseover: highlight,
                                mouseout: resetHighlight
                            });
                        }
                    }).addTo(provinceLayer);

                    // Zoom to the cities layer bounds
                    map.fitBounds(cityLayer.getBounds());
                });
                provinceLayer.addTo(map);

                // Show back button
                document.getElementById('backBtn').style.display = 'block';
            }

            // Back button
            document.getElementById('backBtn').addEventListener('click', function () {
                if (provinceLayer) map.removeLayer(provinceLayer);
                map.addLayer(mainLayer);
                map.setView([-2.5, 118], 5);
                this.style.display = 'none';
            });

            // Initialize
            loadIndonesia();
        </script>

    @endsection
@endsection