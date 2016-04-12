<?php

namespace App\Http\Controllers;

use App\Site;
use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateSiteRequest;
use App\Http\Requests\EditSiteRequest;

class SitesController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');

        $this->middleware('must_own_site', ['only' => 'edit']);

        $this->middleware('can_create_site', ['only' => 'create']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        // if the user already has a site, redirect to the edit form
        if($user->site){
            return redirect()->route('sites.edit', ['sites' => $user->site->id]);
        }

        return view('sites.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSiteRequest $request)
    {

        $user = Auth::user();

        $data = $request->all();

        $data['user_id'] = $user->id;

        Site::create($data);

        // Give the user the role of Site (id: 1)
        $user->roles()->attach(1);

        alert()->success('Μην ξεχνάτε ότι μπορείτε να επεξεργάζεστε τα στοιχεία της υποψηφιότητάς σας όποτε επιθυμείτε.', 'Επιτυχής Υποβολή Υποψηφιότητας!')
                ->persistent('Το κατάλαβα');

        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $site = Site::find($id);

        return view('sites.forms.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSiteRequest $request, $id)
    {
        $site = Site::findOrFail($id);
        
        $input = $request->all();

        $site->fill($input)->save();

        alert()->success('Τα στοιχεία σας ενημερώθηκαν επιτυχώς!', 'Επιτυχία');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
