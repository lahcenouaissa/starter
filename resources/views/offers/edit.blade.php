

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title m-b-md">
            <h4>{{__('messages.offer_title_edit')}}</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="{{route("offer.index")}}" class="btn btn-outline-primary my-2">{{__('messages.Back_to_liste_offer')}}</a>
                <hr>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                <form method="POST" action="{{route('offer.update',$offer->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="offer_name" class="form-label">Offer Name</label>
                        <input type="text" value="{{$offer->name}}" name="name" class="form-control" id="offer_name" >
                        @error('name')
                        <div  class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="offer_price" class="form-label">Offer Price</label>
                        <input type="text" name="price" value="{{$offer->price}}" class="form-control" id="offer_price">
                        @error('price')
                        <div  class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="offer_details" class="form-label">Offer Details</label>
                        <input type="text" name="details" value="{{$offer->details}}" class="form-control" id="offer_details">
                        @error('details')
                        <div  class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="offer_photo" class="form-label">Offer photo</label>
                        <input type="file"   name="photo" class="form-control" id="offer_photo">
                        @error('photo')
                        <div  class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
