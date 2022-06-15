@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Add About</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="containder">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add About</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/about/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3">
                                    <label for="">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control">
                                </div>
                                @error('sub_title')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                @error('title')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Description</label>
                                    <input type="text" name="description" class="form-control">
                                </div>
                                @error('description')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">About Image</label>
                                    <input type="file" name="about_image" class="form-control">
                                </div>
                                @error('about_image')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button class="btn btn-primary" type="submit">Add Abouts</button>
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
    @if (session('about_success'))
        <script>
            swal.fire(
                'Success!',
                '{{ session('about_success') }}',
                'success'
            )
        </script>
    @endif
@endsection
