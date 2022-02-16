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

    protected function getMessages()
    {
        return $messages = [
            'name.required' => __('messages.offername'),
            'name.unique' => "le nom de l'offre est unique",
            'price.required' => "le prix de l'offre est requis",
            'price.numeric' => "le prix doit être numérique",
            'details.required' => "Le détail de l'offre est obligatoire",
        ];
    }

    protected function getRules()
    {
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

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        if($request->has('photo')){
            $file_name = $this->saveImage($request->photo, 'images/offers');
        }else{
            $file_name = '';
        }
        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'photo' => $file_name,
        ]);

        return redirect()->back()->with(['success' => 'Added successfully']);
    }

    public function saveImage($photo, $folder)
    {
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);
        return $file_name;
    }


    public function getAllOffers()
    {
        $offers = Offer::select('id', 'name', 'price', 'details', 'photo')->get();

        return view("offers.all")->with([
            'offers' => $offers
        ]);
    }

    public function editOffer($id)
    {
        //$offer = Offer::findOrFail($id);
        $offer = Offer::find($id);

        if (!$offer) {
            return redirect(route('offer.index'));
        }
        return view('offers.edit')->with([
            'offer' => $offer
        ]);
    }

    public function updateOffer(Request $request, $id)
    {
        $offer = Offer::find($id);

        if (!$offer) {
            return redirect(route('offer.index'));
        }
        // update all
//        $offer = Offer::update($request->all());
        if($request->has('photo')){
            if(file_exists(public_path('images/offers/').$offer->photo)){
                unlink(public_path('images/offers/') . $offer->photo);
            }
            $file_name = $this->saveImage($request->photo, 'images/offers');
        }else{
            $file_name = $offer->photo;
        }
        $offer->update([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'photo' => $file_name,
        ]);
        return redirect()->back()->with(['success' => 'Data updated successfully']);
    }

    public function deleteOffer($id)
    {
        $offer = Offer::find($id);

        if (!$offer) {
            return redirect()->back()->with(['error' => 'offer not found']);
        }
        $offer->delete();
        if(file_exists(public_path('images/offers/').$offer->photo)){
            unlink(public_path('images/offers/') . $offer->photo);
        }
        return redirect()->route('offer.index', $id)
            ->with(['success' => 'offer deleted successfully']);
    }


}
