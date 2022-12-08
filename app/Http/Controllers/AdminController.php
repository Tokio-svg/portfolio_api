<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Exception;

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

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function setup(Request $request) {
        if ($request->key !== env('APP_KEY')) {
            return view('auth.login', [ 'message' => 'Invalid Key' ]);
        }

        try {
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed', [
                '--force' => true
            ]);

            return view('auth.login', [ 'message' => 'Setup OK' ]);
        } catch(Exception $ex) {
            Log::debug($ex->getMessage());
            return view('auth.login', [ 'message' => 'Setup Error' ]);
        }
    }

}
