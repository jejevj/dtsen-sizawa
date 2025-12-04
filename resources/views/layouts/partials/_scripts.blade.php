<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.8.1/nouislider.min.js"
    integrity="sha512-g/feAizmeiVKSwvfW0Xk3ZHZqv5Zs8PEXEBKzL15pM0SevEvoX8eJ4yFWbqakvRj7vtw1Q97bLzEpG2IVWX0Mg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->

<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>


<!-- Login Modal -->
<div class="modal" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(session('need_login'))
    <script>
        window.onload = function () {
            showSuccessAlert('Akses Tidak Ada!', 'Silahkan Login Terlebih Dahulu', 'danger');
        };
    </script>
@endif


<script>
    $(document).ready(function () {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('login') }}'
                data: formData,
                success: function (response) {
                    // If login is successful, close the modal and navigate to the desired page
                    if (response.success) {
                        $('#loginModal').modal('hide');

                        // Show success alert for 3000ms (3 seconds)
                        showSuccessAlert('Selamat Datang!', 'Berhasil Masuk', 'primary');

                        // Redirect to the desired page after alert
                        setTimeout(function () {
                            window.location.href = response.redirect_to;  // Redirect to dashboard or intended route
                        }, 3000);  // Redirect after 3000ms (3 seconds)
                    }
                },
                error: function (xhr, status, error) {
                    // Show errors if login fails
                    alert('Login failed: ' + xhr.responseText);
                }
            });
        });

        // Function to show floating success alert
        function showSuccessAlert(title, message, color) {
            var alertHtml = `

        <div class="container alert-floating alert alert-dismissible bg-${color} d-flex flex-column flex-sm-row p-5 mb-10 col-3" id="successAlert">
            <!--begin::Icon-->
            <i class="ki-duotone ki-search-list fs-2hx text-light me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Title-->
                <h4 class="mb-2  text-white">${title}</h4>
                <!--end::Title-->

                <!--begin::Content-->
                <span>${message}</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto alert-close" onclick="$('#successAlert').alert('close');">
                <i class="ki-duotone ki-cross fs-1 text-light"><span class="path1"></span><span class="path2"></span></i>
            </button>
            <!--end::Close-->
        </div>
    `;

            // Append the alert to the body
            $('body').append(alertHtml);

            // Show the alert with animation
            $('#successAlert').addClass('show');

            // Hide the alert after 3000ms (3 seconds)
            setTimeout(function () {
                $('#successAlert').removeClass('show');
                $('#successAlert').remove();  // Remove the alert from the DOM
            }, 3000);
        }

    });



</script>
<style>

</style>