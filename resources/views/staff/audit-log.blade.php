@extends('inventory.layout')
@section('title', 'Staff Log')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>Audit Log</h5>
                            <span>View Staff Activity</span>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('auditLog.index')}}">Audit log</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
           
        </div>
        <div class="row">
            <!-- start message area-->
            <div class="col-md-12">
                @include('include.message')
            </div> 
            <div class="col-md-12">
                {{$logs->links()}}
            </div> <!-- end message area-->
            <div class="col-md-12">

                {{-- <input type="hidden" name="_token" value="k4JC0rIKsVlV9AR9NCn4JfVS7hvobvmKTZm9pwR6"> --}}
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-0">
                            <div class="card-body">
    
                                <div class="card-body">
                                    <table id="advanced_table" class="table">
                                        <thead>
                                            <tr>
                                                <th class="wp-40">Date-Time</th>
                                                <th class="wp-30">Full Name</th>
                                                <th class="wp-20">Email</th>
                                                <th class="wp-20">Activity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($logs as $log)
                                            @php
                                             $user = App\Models\User::all()->find($log->user_id )
                                            @endphp
                                                <tr>
                                                    <td>{{date_format( $log->created_at, "F j, Y, g:i a") }}</td>
                                                    <td> {{$user->name}} </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if ($log->action=='login')
                                                            <span
                                                                class="badge badge-pill badge-success mb-1 text-black">Login</span>
                                                        @else
                                                            <span
                                                                class="badge badge-pill badge-warning mb-1 text-black">Logout</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <div class="card-options text-center">
                                                            <a class="btn btn-danger" href="{{route('auditLog.destroy',['auditLog' => $log->id])}}" onclick="confirmation(event)"><i class="m-2 ik ik-trash-2"></i></a>
                                                        </div>
                                                       
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>


    <script>
        function confirmation(ev) {
          ev.preventDefault();
          var urlToRedirect = ev.currentTarget.getAttribute('href');  
          console.log(urlToRedirect); 
          swal({
              title: "Are you sure to Delete this Record?",
              text: "You will not be able to revert this!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willCancel) => {
              if (willCancel) {
                  window.location.href = urlToRedirect;
              }  
          });
  
          
      }
  </script>



@endsection
