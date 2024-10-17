<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        // $query = Listing::MostRecent()->filter($filters);

        
        // if($filters['priceFrom'] ?? false) {
        //     $query->where('price', '>=', $filters['priceFrom']);
        // }

        // if($filters['priceTo'] ?? false) {
        //     $query->where('price', '<=', $filters['priceFrom']);
        // }

        // if($filters['beds'] ?? false) {
        //     $query->where('beds', $filters['beds']);
        // }

        // if($filters['baths'] ?? false) {
        //     $query->where('baths', $filters['baths']);
        // }

        // if($filters['areaFrom'] ?? false) {
        //     $query->where('area', '>=', $filters['areaFrom']);
        // }

        // if($filters['areaTo'] ?? false) {
        //     $query->where('area', '>=', $filters['areaTo']);
        // }

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::MostRecent()
                    ->filter($filters)
                    ->paginate(10)
                    ->withQueryString()
            ]
        );
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     // $this->authorize('create', Listing::class);

    //     return inertia('Listing/Create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     // Listing::create([
    //     //     ... $request->all(),
    //     //     ... $request->validate([
    //     //         'beds' => 'required|integer|min:0|max:40'
    //     //     ])
    //     // ]);
    //     // $request->user()->listings()->create();

    //     $request->user()->listings()->create(
    //         $request->validate([
    //             'beds' => 'required|integer|min:0|max:40',
    //             'baths' => 'required|integer|min:0|max:40',
    //             'area' => 'required|integer|min:15|max:1500',
    //             'city' => 'required',
    //             'code' => 'required',
    //             'street' => 'required',
    //             'street_nr' => 'required|integer|min:0|max:20',
    //             'price' => 'required|integer|min:1000|max:1000000000',
    //         ])
    //     );

    //     return redirect()->route('listing.index')->with('success', 'Listing created successfully');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort('403');
        // }
        // $this->authorize('view', $listing);

        $listing->load(['images']);
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Listing $listing)
    // {
    //     return inertia(
    //         'Listing/Edit',
    //         [
    //             'listing' => $listing
    //         ]
    //     );
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Listing $listing)
    // {
    //     $listing->update($request->validate([
    //             'beds' => 'required|integer|min:0|max:40',
    //             'baths' => 'required|integer|min:0|max:40',
    //             'area' => 'required|integer|min:15|max:1500',
    //             'city' => 'required',
    //             'code' => 'required',
    //             'street' => 'required',
    //             'street_nr' => 'required|integer|min:0|max:20',
    //             'price' => 'required|integer|min:1000|max:1000000000',
    //         ])
    //     );

    //     return redirect()->route('listing.index')->with('success', 'Listing was Updated!');
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Listing $listing)
    // {
    //     $listing->delete();

    //     return redirect()->back()->with('success', 'Listing was deleted successfully');
    // }
}
