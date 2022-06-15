@extends('layouts.dashboard')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">View Testimonail</a>
    <span class="breadcrumb-item active">Edit Testimonail</span>
</nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Testimonail</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('testimonail/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <input type="hidden" name="testi_id" value="{{ $testi_id_info->id }}">
                                </div>

                                <div class="mt-3">
                                    <label for="">Client Name</label>
                                    <input type="text" name="client_name" class="form-control" value="{{ $testi_id_info->clent_name }}">
                                </div>
                                @error('client_name')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Designation</label>
                                    <input type="text" name="designation" class="form-control" value="{{ $testi_id_info->designation }}">
                                </div>
                                @error('designation')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Client Review</label>
                                    <textarea type="text" class="form-control" name="client_review" cols="30" rows="10">{{ $testi_id_info->client_review }}</textarea>
                                </div>
                                @error('client_review')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Client Image</label>
                                    <input type="file" name="client_image" class="form-control">
                                </div>
                                @error('client_image')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update Testimonail</button>
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
