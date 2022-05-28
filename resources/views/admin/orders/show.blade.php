@extends('admin.layouts.backend')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-6">
                    <h1>View Details</h1>
                </div>
                <div class="col-sm-6 col-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url(url()->previous()) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br/><br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <th>Orders ID</th>
                                    <td> {{ $order->id }} </td>
                                </tr>
                                <tr>
                                    <th>User Email</th>
                                    <td> {{ $order->users->email }} </td>
                                </tr>
                              @foreach($order->order_items as $items)
                              <tr>
                                    <th>Product Qty</th>
                                    <td>{{ $items->product->qty }}</td>
                                </tr>
                              <tr>
                                    <th>Product Price</th>
                                    <td>{{ $items->product->price }}</td>
                                </tr>
                              <tr>
                                    <th>Product Name</th>
                                    <td>{{ $items->product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Image</th>
                                    <td><img src="{{ $items->product->image }}" width="100px" height="100px"></td>
                                </tr>
                              @endforeach
                                <!-- <tr>
                                    <th>Product Image</th>
                                    <td><img src="{{ $order->image }}" width="100px" height="100px"></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>  
    <!-- /.content -->
</div>
@endsection
