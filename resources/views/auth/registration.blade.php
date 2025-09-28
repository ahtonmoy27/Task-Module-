@extends('layouts.main');

@section('page_title')
    @include('auth.header')
@endsection
@section('content')
    <h1 class="text-center">Registration User Form </h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('registrationPost') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>

                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Enter Password">
                    </div>

                    <div class="d-flex justify-content-between gap-2">
                        <button type="submit" class="btn btn-primary w-50 registrationBtn">Submit</button>
                        <button type="reset" class="btn btn-secondary w-50">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).on('submit', 'form', function(e) {
            e.preventDefault();
            console.log('registration form 22 ');

            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            //console.log(name+email+password);
            var callParams = {};
            callParams.type = "POST";
            callParams.url = "{{ route('registrationPost') }}";
            callParams.data = {
                name: name,
                email: email,
                password: password,
            }
            callParams.dataType = "JSON";
            // console.log(callParams);
            ajaxCall(callParams, function(result) {
                // console.log(result);
                console.log(result.data);
                // console.log(result.message);
                if (result.data) {
                    console.log("ok");
                    toast(result.message);
                    //   window.location.href = "{{ route('dashboard.index') }}";
          window.location.href = "{{ route('login') }}";
         }
            });

        });
    </script>
@endpush
