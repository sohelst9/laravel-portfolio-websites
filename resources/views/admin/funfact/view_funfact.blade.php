@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Add Funfact</a>
    <span class="breadcrumb-item active">View Funfact</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="h3">View Funfact</div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-primary mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>icon_name</th>
                                            <th>Title</th>
                                            <th>Counter_num</th>
                                            <th>Created_At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <div class="tbody">
                                        @foreach ($all_funfact as $key=>$funfact)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $funfact->user_id }}</td>
                                            <td>{{ $funfact->icon }}</td>
                                            <td>{{ $funfact->title }}</td>
                                            <td>{{ $funfact->counter_num }}</td>
                                            <td>{{ $funfact->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('edit.funfact',$funfact->id) }}" class="btn btn-primary">Edit</a>

                                                <a href="{{ route('delete.funfact',$funfact->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sl-page-title -->

  </div><!-- sl-pagebody -->
@endsection

@section('footer_script')

<!-----------Funfact update---->
    @if (session('update'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('update') }}',
            'success'
            )
        </script>
    @endif

    <!-------Services delete-------->
    @if (session('delete'))
        <script>
            swal.fire(
                'Success!',
                '{{ session('delete') }}',
                'success'
            )
        </script>
    @endif
@endsection
