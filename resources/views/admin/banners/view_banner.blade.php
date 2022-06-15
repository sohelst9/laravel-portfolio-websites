@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Add banner</a>
    <span class="breadcrumb-item active">View Banner</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="h3">View Banners</div>
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
                                        @foreach ($all_banner as $key=>$banner)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $banner->user_id }}</td>
                                            <td>{{ substr($banner->sub_title, 0, 8) }}</td>
                                            <td>{{ substr($banner->title, 0, 10).'..' }}</td>
                                            <td>{{ substr($banner->description, 0,10).'..' }}</td>
                                            <td><img height="60px" width="60px" src="{{ asset('uploads/banners/'.$banner->banner_image) }}"></td>
                                            <td>{{ $banner->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($banner->status == 1)
                                                <a class="btn btn-primary" href="{{ route('change.status',$banner->id) }}">Active</a>

                                                @else
                                                <a class="btn btn-danger" href="{{ route('change.status',$banner->id) }}">Deactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.banner',$banner->id) }}" class="btn btn-primary">Edit</a>

                                                <a href="{{ route('banner.delete',$banner->id) }}" class="btn btn-danger">Delete</a>
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

<!-----------banner update---->
    @if (session('update_success'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('update_success') }}',
            'success'
            )
        </script>
    @endif

    <!-------banner delete-------->
    @if (session('delete_success'))
        <script>
            swal.fire(
                'Success!',
                '{{ session('delete_success') }}',
                'success'
            )
        </script>
    @endif
@endsection
