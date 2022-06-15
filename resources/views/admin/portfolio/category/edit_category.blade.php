@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">View Category</a>
    <span class="breadcrumb-item active">Edit Category</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('category/update') }}" method="POST">
                                @csrf
                                <div>
                                    <input type="hidden" name="category_id" value="{{ $category_id_info->id }}">
                                </div>
                                <div class="mt-3">
                                    <label for="">Category</label>
                                    <input type="text" name="category" class="form-control" value="{{ $category_id_info->category }}">
                                </div>
                                @error('category')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update Category</button>
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
