@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Add Category</a>
    <span class="breadcrumb-item active">View Category</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="h3">View Category</div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-primary mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>Category</th>
                                            <th>Created_At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <div class="tbody">
                                        @foreach ($all_category as $key=>$category)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $category->user_id }}</td>
                                            <td>{{ $category->category }}</td>
                                            <td>{{ $category->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('edit.category',$category->id) }}" class="btn btn-primary">Edit</a>

                                                <a href="{{ route('delete.category',$category->id) }}" class="btn btn-danger">Delete</a>
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

<!-----------Category update---->
    @if (session('success'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('success') }}',
            'success'
            )
        </script>
    @endif

    <!-------Category delete-------->
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
