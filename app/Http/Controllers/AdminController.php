<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function index() {
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
        try {
            DB::beginTransaction();
            Contact::destroy($request->id);
            DB::commit();
        } catch(Exception $ex) {
            Log::debug($ex->getMessage());
            DB::rollback();
        }
        return redirect('/');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function read(Request $request) {
        try {
            DB::beginTransaction();
            Contact::where('id', $request->id)
                ->update(['read_flag' => true]);
            DB::commit();
        } catch(Exception $ex) {
            Log::debug($ex->getMessage());
            DB::rollback();
        }

        return redirect('/');
    }
}