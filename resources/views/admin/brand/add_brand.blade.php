@extends('layouts.dashboard')

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Add Brand</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Brand</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/brand/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-2">
                                    <label>Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control">
                                </div>
                                @error('brand_image')
                                    <p class="mt-2 text-danger">{{ $message }}
                                    </p>
                                @enderror

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Add Brand</button>
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
