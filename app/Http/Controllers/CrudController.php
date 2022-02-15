<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{

    public function getOffers()
    {
        return Offer::get();
    }

    public function create()
    {
        return view('offers.create');
    }

    protected function getMessages(){
        return $messages =  [
            'name.required'=>"le nom de l'offre est requis",
            'name.unique'=>"le nom de l'offre est unique",
            'price.required'=>"le prix de l'offre est requis",
            'price.numeric'=>"le prix doit être numérique",
            'details.required'=>"Le détail de l'offre est obligatoire",
        ];
    }
    protected function getRules(){
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }

    public function store(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();

        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
        ]);

        return redirect()->back()->with(['success'=>'Added successfully']);
    }

}
