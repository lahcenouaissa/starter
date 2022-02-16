

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title m-b-md">
            <h4>{{__('messages.offer_liste')}}</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{route("offer.create")}}" class="btn btn-outline-primary my-2">{{__('messages.Save Offer')}}</a>
                <hr>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Details</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($offers as $offer)
                        <tr>
                            <th scope="row">{{$offer->id}}</th>
                            <td>{{$offer->name}}</td>
                            <td>{{$offer->price}}</td>
                            <td>{{$offer->details}}</td>
                            <td><img src="{{asset('images/offers/'.$offer->photo)}}" width="75px" height="50px" class="img-thumbnail" alt=""></td>
                            <td>
                                <a href="{{route("offer.edit",$offer->id)}}" class="btn btn-outline-secondary">Edit</a>
                                <a href="{{route("offer.delete",$offer->id)}}" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
