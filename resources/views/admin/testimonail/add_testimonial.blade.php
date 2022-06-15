@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Add Testimonail</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="containder">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Testimonail</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/testimonail/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3">
                                    <label for="">Client Name</label>
                                    <input type="text" name="client_name" class="form-control">
                                </div>
                                @error('client_name')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Client Designation</label>
                                    <input type="text" name="designation" class="form-control">
                                </div>
                                @error('designation')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Client Review</label>
                                    <textarea type="text" name="client_review" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                @error('client_review')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Client Image</label>
                                    <input type="file" name="client_image" class="form-control">
                                </div>
                                @error('client_image')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button class="btn btn-primary" type="submit">Add Testimonail</button>
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
    @if (session('success'))
        <script>
            swal.fire(
                'Success!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif
@endsection
