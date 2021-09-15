<!-- Bootstrap js-->
 <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
 <!-- feather icon js-->
 <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
 <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
 <!-- scrollbar js-->
 <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
 <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
 <!-- Sidebar jquery-->
 <script src="{{ asset('assets/js/config.js') }}"></script>
 <!-- Plugins JS start-->
 <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
 <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
 <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
 <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
 <script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
 <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
 <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <!-- Plugins JS start-->
  
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jsgrid/jsgrid.min.js') }}"></script>
    <script src="{{ asset('assets/js/jsgrid/griddata.js') }}"></script>
    <script src="{{ asset('assets/js/jsgrid/jsgrid.js') }}"></script>
     --}}
    <script src="{{ asset('assets/js/form-wizard/form-wizard-three.js') }}"></script>
    <!-- Plugins JS Ends-->

 <!-- Plugins JS Ends-->
 <!-- Theme js-->
 <script src="{{ asset('assets/js/script.js') }}"></script>
 <script>
       const time = new Date().getHours();
                let greeting;
                if (time < 12) {
                  greeting = "Morning";
                } else if (time < 15) {
                  greeting = "Afternoon";
                } else {
                  greeting = "Evening";
                }
            document.getElementById("greeting").innerHTML = greeting;
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye / eye slash icon
            this.classList.toggle('bi-eye');
 </script>
 <!-- login js-->
 <!-- Plugin used-->