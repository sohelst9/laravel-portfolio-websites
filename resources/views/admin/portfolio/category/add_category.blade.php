@extends('layouts.dashboard')

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Add Category</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/category/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3">
                                    <label for="">Category</label>
                                    <input type="text" name="category" class="form-control">
                                </div>
                                @error('category')
                                <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Add Category</button>
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
    <!-----------category insert---->
    @if (session('success'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('success') }}',
            'success'
            )
        </script>
    @endif
@endsection
