{{-- <!-- <script src="{{ asset('dash_mag/js/bootstrap.bundle.min.js') }}"></script> -->
<!-- <script src="{{ asset('dash_mag/js/bootstrap.min.js') }}"></script> -->
<!-- <script src="{{ asset('dash_mag/jquery-3.6.3.min.js') }}"></script> -->
<!-- <script src="{{ asset('dash_mag/js/all.min.js') }}"></script> --> --}}
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@yield('script')
<script>
    if (document.getElementById("startDate") && document.getElementById("endDate")) {
        document.getElementById("startDate").addEventListener("click", function() {
            this.showPicker();
        });
        document.getElementById("endDate").addEventListener("click", function() {
            this.showPicker();
        });
    }
</script>
</body>

</html>
