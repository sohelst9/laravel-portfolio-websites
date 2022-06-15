@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Add Portfolio</a>
    <span class="breadcrumb-item active">View Portfolio</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="h3">View Portfolio</div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-primary mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>Category_name</th>
                                            <th>Title</th>
                                            <th>Sub_title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Created_At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <div class="tbody">
                                        @foreach ($all_portfolio as $key=>$portfolio)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $portfolio->user_id }}</td>
                                            <td>
                                                @php
                                                    if(App\Models\Category::where('id',$portfolio->category_id)->exists()){
                                                        echo $portfolio->category->category;
                                                    }
                                                    else{
                                                        echo "N/A";
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{ substr($portfolio->title, 0, 8) }}</td>
                                            <td>{{ substr($portfolio->sub_title, 0, 10).'..' }}</td>
                                            <td>{{ substr($portfolio->description, 0,10).'..' }}</td>
                                            <td><img height="60px" width="60px" src="{{ asset('uploads/portfolio/'.$portfolio->image) }}"></td>
                                            <td>{{ $portfolio->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('edit.portfolio',$portfolio->id) }}" class="btn btn-primary">Edit</a>

                                                <a href="{{ route('delete.portfolio',$portfolio->id) }}" class="btn btn-danger">Delete</a>
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

<!-----------portfolio update---->
    @if (session('success'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('success') }}',
            'success'
            )
        </script>
    @endif

    <!-------portfolio delete-------->
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
