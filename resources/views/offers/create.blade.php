

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title m-b-md">
            <h4>Add new offer</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                <form method="POST" action="{{route('offer.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="offer_name" class="form-label">Offer Name</label>
                        <input type="text" name="name" class="form-control" id="offer_name" >
                        @error('name')
                        <div  class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="offer_price" class="form-label">Offer Price</label>
                        <input type="text" name="price" class="form-control" id="offer_price">
                        @error('price')
                        <div  class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="offer_details" class="form-label">Offer Details</label>
                        <input type="text" name="details" class="form-control" id="offer_details">
                        @error('details')
                        <div  class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save Offer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
