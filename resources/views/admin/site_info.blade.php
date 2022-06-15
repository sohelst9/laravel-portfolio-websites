@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Site Information</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Site Information</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/site_info/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="">
                                    <input type="hidden" name="site_id" class="form-control" value="{{ $site_info->id }}">
                                </div>

                                <div class="mt-3">
                                    <label for="">Site title</label>
                                    <input type="text" name="site_title" class="form-control" value="{{ $site_info->site_title }}">
                                </div>
                                @error('site_title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Site Sub Title</label>
                                    <textarea name="site_subtitle" type="text" cols="30" rows="10" class="form-control">{{ $site_info->sub_title }}</textarea>
                                </div>
                                @error('site_subtitle')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Copyright Text</label>
                                    <input type="text" name="copyright" class="form-control" value="{{ $site_info->copyright }}">
                                </div>
                                @error('copyright')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                 <div class="mt-3">
                                    <label for="">Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                                @error('logo')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update Information</button>
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
    <!-----------Site info update---->
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
