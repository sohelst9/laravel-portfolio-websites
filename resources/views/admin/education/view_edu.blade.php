@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Add Education</a>
    <span class="breadcrumb-item active">View Education</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="h3">View Education</div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-primary mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Id</th>
                                            <th>Year</th>
                                            <th>Description</th>
                                            <th>Skill</th>
                                            <th>Created_At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <div class="tbody">
                                        @foreach ($all_education as $key=>$education)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $education->user_id }}</td>
                                            <td>{{ $education->year }}</td>
                                            <td>{{ substr($education->description,0,10).'..' }}</td>
                                            <td>{{ $education->skill }}</td>
                                            <td>{{ $education->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($education->status == 1)
                                                <a class="btn btn-primary" href="{{ route('change.status',$education->id) }}">Active</a>

                                                @else
                                                <a class="btn btn-danger" href="{{ route('change.status',$education->id) }}">Deactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.edu',$education->id) }}" class="btn btn-primary">Edit</a>

                                                <a href="{{ route('delete.edu',$education->id) }}" class="btn btn-danger">Delete</a>
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

<!-----------education update---->
    @if (session('edu_update'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('edu_update') }}',
            'success'
            )
        </script>
    @endif

    <!-------education delete-------->
    @if (session('delete_edu'))
        <script>
            swal.fire(
                'Success!',
                '{{ session('delete_edu') }}',
                'success'
            )
        </script>
    @endif
@endsection
