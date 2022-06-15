@extends('layouts.dashboard')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Add Portfolio</span>
</nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Portfolio</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('portfolio/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mt-3">
                                    <label for="">Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach ($all_category_info as $category)

                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                @error('title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control">
                                </div>
                                @error('sub_title')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Description</label>
                                    <textarea type="text" class="form-control" name="description" cols="30" rows="10"></textarea>
                                </div>
                                @error('description')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <label for="">Portfolio Image</label>
                                    <input type="file" name="Portfolio_image" class="form-control">
                                </div>
                                @error('Portfolio_image')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Add Portfolio</button>
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
