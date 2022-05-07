<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function index(Request $request) {
        $contacts = Contact::paginate(20);

        return view('index', [
            'contacts' => $contacts
        ]);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function delete(Request $request) {
        Contact::destroy($request->id);
        return redirect('/');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function read(Request $request) {
        Contact::where('id', $request->id)
            ->update(['read_flag' => true]);

        return redirect('/');
    }

}
