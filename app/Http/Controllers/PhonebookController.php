<?php

namespace App\Http\Controllers;

use App\Phonebook;
use App\Http\Requests\PhonebookRequest;
use Illuminate\Http\Request;


class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phonebook');
    }

    public function getContacts()
    {
        return Phonebook::orderBy('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhonebookRequest $request)
    {
        $phonebook = new Phonebook();
        $phonebook->name = $request->name;
        $phonebook->email = $request->email;
        $phonebook->phone = $request->phone;
        $phonebook->status = $request->status;

        $phonebook->save();
        return $phonebook;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(PhonebookRequest $request, Phonebook $phonebook)
    {
        $pb = Phonebook::find($phonebook->id);
        $pb->name = $request->name ?? $phonebook->name;
        $pb->email = $request->email ?? $phonebook->email;
        $pb->phone = $request->phone ?? $phonebook->phone;
        $pb->status = $request->status ?? $phonebook->status;

        $pb->update();
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phonebook $phonebook)
    {
        return Phonebook::find($phonebook->id)->delete();
    }
}
