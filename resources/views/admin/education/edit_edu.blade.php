@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">View Education</a>
    <span class="breadcrumb-item active">Edit Education</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Education</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('education/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3">
                                    <input type="hidden" name="edu_id" class="form-control" value="{{ $edu_id_info->id }}">
                                </div>

                                <div class="mt-3">
                                    <label for="">Year</label>
                                    <input type="text" name="year" class="form-control" value="{{ $edu_id_info->year }}">
                                </div>
                                @error('year')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Description</label>
                                    <input type="text" name="description" class="form-control" value="{{ $edu_id_info->description }}">
                                </div>
                                @error('description')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Skill</label>
                                    <input type="text" name="skill" class="form-control" value="{{ $edu_id_info->skill }}">
                                </div>
                                @error('skill')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update Education</button>
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
