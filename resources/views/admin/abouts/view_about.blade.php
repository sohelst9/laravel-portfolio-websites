@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Add About</a>
    <span class="breadcrumb-item active">View About</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="h3">View About</div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-primary mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>Sub_title</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Created_At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <div class="tbody">
                                        @foreach ($all_about as $key=>$about)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $about->user_id }}</td>
                                            <td>{{ substr($about->sub_title,0,8) }}</td>
                                            <td>{{ substr($about->title,0,10) }}</td>
                                            <td>{{ substr($about->description,0,10).'...' }}</td>
                                            <td><img height="60px" width="60px" src="{{ asset('uploads/abouts/'.$about->about_image) }}"></td>
                                            <td>{{ $about->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($about->status == 1)
                                                <a class="btn btn-primary" href="{{ route('change.status',$about->id) }}">Active</a>
                                                @else
                                                <a class="btn btn-primary" href="{{ route('change.status',$about->id) }}">Deactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.about',$about->id) }}" class="btn btn-primary">Edit</a>

                                                <a href="{{ route('delete.about',$about->id) }}" class="btn btn-danger">Delete</a>
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

<!-----------about update------->
    @if (session('about_update'))
        <script>
            swal.fire(
                'Success!',
                '{{ session('about_update') }}',
                'success'
            )
        </script>
    @endif

    <!----------about delete-------->
    @if (session('about_delete'))
        <script>
            swal.fire(
                'Success!',
                '{{ session('about_delete') }}',
                'success'
            )
        </script>
    @endif
@endsection
