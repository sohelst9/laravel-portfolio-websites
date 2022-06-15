@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">View banner</a>
    <span class="breadcrumb-item active">Edit Banner</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Banner</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/banner/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="">
                                    <input type="hidden" name="banner_id" class="form-control" value="{{ $banner_id_info->id }}">
                                </div>

                                <div class="mt-3">
                                    <label for="">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control" value="{{ $banner_id_info->sub_title }}">
                                </div>
                                @error('sub_title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $banner_id_info->title }}">
                                </div>
                                @error('title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Description</label>
                                    <input type="text" name="description" class="form-control" value="{{ $banner_id_info->description }}">
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
                                    <button type="submit" class="btn btn-primary">Update Banner</button>
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
