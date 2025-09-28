<div class="tt-page-header py-4">
    <div class="container">
        <div class="row g-3">
            <div class="col-auto flex-grow-1">
                <div class="tt-page-title">
                    <h1 class="h4 mb-lg-1">Dashboard</h1>
                    <ol class="breadcrumb align-items-center gap-4 text-muted">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Users</a></li> --}}
                        {{-- <li class="breadcrumb-item">Add User</li> --}}
                    </ol>
                </div>
            </div>
            <div class="col-auto">
               @if(!empty(auth()->user()->name ))
                <a href= '{{ route('logout') }}' class = "btn btn-primary">Logout</a>
               
               @else  <a href= '{{ route('login') }}' class = "btn btn-primary">Login</a>
               
               @endif 
            </div>
          

        </div>
    </div>
  
</div>