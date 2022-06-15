@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Add Education</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Education</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/education/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3">
                                    <label for="">Year</label>
                                    <input type="text" name="year" class="form-control">
                                </div>
                                @error('year')
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
                                    <label for="">Skill</label>
                                    <input type="text" name="skill" class="form-control">
                                </div>
                                @error('skill')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Add Education</button>
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
    <!-----------education insert---->
    @if (session('edu_success'))
        <script>
            Swal.fire(
            'Success!',
            '{{ session('edu_success') }}',
            'success'
            )
        </script>
    @endif
@endsection
