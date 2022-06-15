@extends('layouts.dashboard')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Add Banner</span>
</nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Banner</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('banner/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3">
                                    <label for="">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control">
                                </div>
                                @error('sub_title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                @error('title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Description</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                                @error('description')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Banner Image</label>
                                    <input type="file" name="banner_image" class="form-control">
                                </div>
                                @error('banner_image')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Add Banner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sl-page-title -->

  </div><!-- sl-pagebody -->

@endsection

@section('footer_script')

<!------------insert Success-------------->
@if (session('insert_success'))
    <script>
        Swal.fire(
        'Success!',
        '{{ session('insert_success') }}',
        'success'
    )
    </script>
@endif

@endsection
