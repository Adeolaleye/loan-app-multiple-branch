<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif
  

    @if($errors->any())
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
    @endforeach
    
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
        toastr.info("{{ session('info') }}");
    @endif
  
    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
        toastr.warning("{{ session('warning') }}");
    @endif
  </script>
   