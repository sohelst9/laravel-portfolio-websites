@extends('layouts.dashboard')
@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Dashboard</a>
    <span class="breadcrumb-item active">Add Funfact</span>
  </nav>

  <div class="sl-pagebody">
    <div class="sl-page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Funfact</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/funfact/insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mt-3">
                                    <div class="mt-2">
                                        <div class="row" style="overflow-y: scroll;max-height: 200px">
                                       @foreach ($all_font as $font)
                                       <div class="col-lg-1 col-md-1">
                                           <i style="cursor: pointer;border:1px solid #eee;padding: 5px;margin: 5px 0px;" class="fa {{ $font }} icons"><span style="display: none">{{ $font }}</span></i>
                                       </div>
                                       @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label for="">Icon</label>
                                    <input id="icon_input" type="text" name="icon" class="form-control">
                                </div>
                                @error('icon')
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
                                    <label for="">Counter Number</label>
                                    <input type="number" name="counter_num" class="form-control">
                                </div>
                                @error('counter_num')
                                    <p class="mt-2 text-danger">{{ $message }}</p>
                                @enderror

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Add Funfact</button>
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
  <!---------icon show script------->
  <script>
    $('.icons').click(function(){
        var icon_class = $(this).text();
         $('#icon_input').attr('value',icon_class);
        })
  </script>


    <!-----------Funfact insert---->
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
