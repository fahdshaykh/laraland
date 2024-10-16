<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Auth;
use Illuminate\Http\Request;

class RealtorListingController extends Controller
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
        // dd($request->boolean('deleted'));
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ... $request->only(['by', 'order'])
        ];

        // dd(Auth::user()->listings()->mostRecent()->filter($filters));

        return inertia(
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->filter($filters)
                    ->paginate(6)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Listing::class);

        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Listing::create([
        //     ... $request->all(),
        //     ... $request->validate([
        //         'beds' => 'required|integer|min:0|max:40'
        //     ])
        // ]);
        // $request->user()->listings()->create();

        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:40',
                'baths' => 'required|integer|min:0|max:40',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:0|max:20',
                'price' => 'required|integer|min:1000|max:1000000000',
            ])
        );

        return redirect()->route('realtor.listing.index')->with('success', 'Listing created successfully');
    }

    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update($request->validate([
                'beds' => 'required|integer|min:0|max:40',
                'baths' => 'required|integer|min:0|max:40',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:0|max:20',
                'price' => 'required|integer|min:1000|max:1000000000',
            ])
        );

        return redirect()->route('realtor.listing.index')->with('success', 'Listing was Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing was deleted successfully');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored successfully');
    }
}
