<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);

        //accept selected offer
        $offer->update(['accepted_at' => now()]);

        //sold at column in listing update
        $listing->sold_at = now();
        $listing->save();

        //reject all others
        $listing->offers()->except($offer)
        ->update(['rejected_at' => now()]);

        return redirect()->back()
        ->with(
            'success', "Offer #{$offer->id} Accepted, Others are rejejcted"
        );
    }
}
