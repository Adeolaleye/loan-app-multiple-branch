@if(session()->get('message'))
<div class="alert alert-success dark alert-dismissible fade show" role="alert">
      <i data-feather="thumbs-up"></i>
      <strong class="m-l-30">Great!</strong> {{ session()->get('message')}}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->get('error'))
<div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
      <i data-feather="thumbs-down"></i>
      <strong class="m-l-30">Whoops!</strong> {!! session()->get('error') !!}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->get('warning'))
<div class="alert alert-warning dark alert-dismissible fade show" role="alert">
      <i data-feather="bell"></i>
      <strong>Hey!</strong> {!! session()->get('warning') !!}
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session()->get('welcomeback'))
<div class="alert alert-success dark alert-dismissible fade show" role="alert">
      <i data-feather="thumbs-up"></i>
      <strong class="m-l-30">Great!</strong> {{ session()->get('welcomeback')  }} &#128515
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-warning dark alert-dismissible fade show" role="alert">
      <i data-feather="bell" class="m-r-30"></i>
      @foreach($errors->all() as $error)
            {{ $error }}<br>
      @endforeach
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
