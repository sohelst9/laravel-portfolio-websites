@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Add Testimonail</a>
    <span class="breadcrumb-item active">View Testimonail</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="h3">View Testimonail</div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-primary mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Review</th>
                                            <th>Image</th>
                                            <th>Created_At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <div class="tbody">
                                        @foreach ($all_testimonail as $key=>$testimonail)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $testimonail->user_id }}</td>
                                            <td>{{ substr($testimonail->clent_name, 0, 8) }}</td>
                                            <td>{{ substr($testimonail->designation, 0, 10).'..' }}</td>
                                            <td>{{ substr($testimonail->client_review, 0,20).'..' }}</td>
                                            <td><img height="60px" width="60px" src="{{ asset('uploads/testimonail/'.$testimonail->client_image) }}"></td>
                                            <td>{{ $testimonail->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('edit.testi',$testimonail->id) }}" class="btn btn-primary">Edit</a>

                                                <a href="{{ route('delete.testi',$testimonail->id) }}" class="btn btn-danger">Delete</a>
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

<!-----------testimonail update---->
    @if (session('update'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('update') }}',
            'success'
            )
        </script>
    @endif

    <!-------Testionail delete-------->
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
