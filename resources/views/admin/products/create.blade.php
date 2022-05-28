@extends('admin.layouts.backend')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 col-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6 col-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
              <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
              <div class="card">
                  <!--<div class="card-header">Create New User</div>-->
                  <div class="card-body">
                      <a href="{{ url(url()->previous()) }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a><br />
                      <br />
                      @if ($errors->any())
                          <ul class="alert alert-danger">
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      @endif
                      <!-- {!! Form::open(['url' => 'admin/products/add', 'class' => 'form-horizontal row', 'enctype' => 'multipart/form-data']) !!}
                            @include ('admin.products.form', ['formMode' => 'create'])
                      {!! Form::close() !!} -->


                      <form action="{{route('products.store')}}" method="post" class="row" enctype="multipart/form-data">
                        @csrf
                         @include ('admin.products.form', ['formMode' => 'create'])  
                      </form>
                  </div>
              </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
