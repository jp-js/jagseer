@extends('layouts.front-end')
   
@section('content')
    <div class="container">
        <form action="{{route('checkout')}}" method="post">
            @csrf
            <h2 class="text-center">Add Your Address</h2>
        <div class="row jumbotron w-50 m-auto">
            <div class="col-sm-12 form-group">
                <label for="name-f">Name</label>
                <input type="text" class="form-control" name="name" id="name-f" placeholder="Enter your first name." required>
            </div>
            <div class="col-sm-12 form-group">
                <label for="address-1">Address</label>
                <input type="address" class="form-control" name="address" id="address-1" placeholder="Locality/House/Street no." required>
            </div>
            <div class="col-sm-12 form-group">
                <label for="State">State</label>
                <input type="address" class="form-control" name="state" id="State" placeholder="Enter your state name." required>
            </div>
            <div class="col-sm-12 form-group">
                <label for="zip">Postal Code</label>
                <input type="zip" class="form-control" name="pincode" id="zip" placeholder="Postal-Code." required>
            </div>
          

            <div class="col-sm-12 form-group mb-0">
               <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
            
        </div>
        </form>
    </div>
    @endsection