@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Address</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Address Info</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/address/update') }}" method="POST">
                                @csrf

                                <div class="">
                                    <input type="hidden" name="address_id" class="form-control" value="{{ $address->id }}">
                                </div>

                                <div class="mt-3">
                                    <label for="">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control" value="{{ $address->sub_title }}">
                                </div>
                                @error('sub_title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $address->title }}">
                                </div>
                                @error('title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Description</label>
                                    <textarea name="description" type="text" cols="30" rows="10" class="form-control">{{ $address->desc }}</textarea>
                                </div>
                                @error('description')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Office Location</label>
                                    <input type="text" name="office_loc" class="form-control" value="{{ $address->office_loc }}">
                                </div>
                                @error('office_loc')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ $address->address }}">
                                </div>
                                @error('address')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $address->phone }}">
                                </div>
                                @error('phone')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">E-mail</label>
                                    <input type="text" name="email" class="form-control" value="{{ $address->email }}">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update Address-info</button>
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
    <!-----------Address update---->
    @if (session('update'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('update') }}',
            'success'
            )
        </script>
    @endif
@endsection
