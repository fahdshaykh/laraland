<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia('Realtor/ListingImage/create', ['listing' => $listing]);
    }

    public function store(Request $request, Listing $listing)
    {
        if($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'mimes:png,jpg,jpeg|max:5000'
            ], [
                'images.*.mimes' => 'The file should be in one the formage: jpg or png'
            ]);
            foreach($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path
                ]));
            }
        }

        return redirect()->back()->with('success', 'Image uploaded!');
    }

    public function destroy(Listing $listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image was deletetd.');
    }
}
