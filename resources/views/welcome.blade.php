@extends('layouts.main')

@section('page_title')
    @include('dashboard_header')
@endsection


@section('content')

<section class="mb-4">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header border-0 bg-transparent pb-0">
                        <div class="row g-3">
                            
                        </div>
                    </div>
                  
                            <h2 class="mb-4 text-center">Select a Country</h2>

                            <select id="countries" class="form-select" style="width: 100%"></select>

                  
                    <div class="card-body table-responsive usersListWrapper">
                            <h1 class="text-center">Welcome to DashBoard  {{auth()->user()->name }}</h1>
                             <h1 class="text-center">User name is :   {{auth()->user()->func }}</h1> 
                             {{-- <h1>{{ $user->settings['play'] }}</h1> --}}
                             {{-- <h1>{{ $user->name }}</h1> --}}

                    @forEach($data as $user)
                        <h2>{{ $user->name }}</h2>
                            @if($user->posts->count())
                            <ol>
                                @forEach($user->posts as $post)
                                <li>
                                    <b>{{ $post->title }}</b>
                                    <b>{{ $post->body }}</b>
                                </li>
                                @endforeach
                            </ol>
                            @else
                                <p>No Result Found</p>
                            @endif
                @endforeach
                             <textarea name="textarea" id="textarea" cols="30" rows="10">

                             </textarea>
                      </div>
                      <button onclick="deleteItem()" style="padding: 10px 20px; font-size: 16px;"> Delete</button>
                    <div class="card-footer border-0 pt-0 bg-transparent">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')

<script>
    
     $('#textarea').summernote({
        height:200,
        width:600,

     });

    function deleteItem() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this item?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Deleted successfully!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }

        let callParams = {};
        callParams.url = 'https://restcountries.com/v3.1/all';
        callParams.type = 'GET';
        callParams.dataType = 'JSON';
        ajaxCall(callParams, function (result){
            $('#countries').select2({
                minimumResultsForSearch: 3,
            });
            result.forEach(function(country) {
                const name = country.name?.common || 'Unknown';
                const flag = country.flags?.png || '';
                $('#countries').append(`
                        <option style="margin:15px;">
                            <img src="${flag}" alt="Flag" width="30" /> ${name}
                        </option>
                    `);
            });
        }, function (err, type, httpStatus){

        });
</script>
@endpush