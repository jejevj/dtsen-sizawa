@if ($errors->any())
    <script>
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    </script>
@endif
