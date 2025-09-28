@extends('layouts.main')

@section('page_title')
     @include('auth.header')
@endsection

@section('content')
<h1 class="text-center">Login User</h1>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('loginPost') }}" method="POST" class="loginForm">
                @csrf
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                </div>

                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3 loginBtn">Submit</button>

                <div class="d-flex justify-content-center align-items-center gap-2 mt-3">
                  <p class="mb-0">Don't have an account?</p>
                  <a href="{{ route('registration') }}" class="btn btn-primary">Register</a>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).on('click','.loginBtn',function(e){
     e.preventDefault();
     console.log('login');
       
        var email = $('#email').val();
        var password = $('#password').val();
        // console.log(email+password);
        let callParams = {};
        callParams.type = "POST";
        callParams.url = "{{ route('loginPost') }}";
        callParams.data = new FormData($('.loginForm')[0]);
        callParams.processData = false ;
        callParams.contentType = false ;
        console.log(callParams);
        ajaxCall(callParams,function(result){
          console.log(result);
      //   console.log(result.data.length);
         
         if(result.data == 'success'){
          //console.log("ok");
          toast(result.message);
        //   window.location.href = "{{ route('dashboard.index') }}";
          window.location.href = "{{ route('home.index') }}";
         }
         else {
          console.log("not ok ");
          toast(result.message,'error');
         }
    
        });

    });
</script>
@endpush
