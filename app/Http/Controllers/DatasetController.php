<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Dataset;
class DatasetController extends Controller
{
    public function index($id = null)
    {
        $dataset = new Dataset();

        if (!is_null($id)) {
            $response = $dataset::findOrFail($id);
        } else {
            $records_per_page = 5;

            $data = $dataset::all();
                            //->orderBy('id', 'desc')->paginate($records_per_page);

            $response = [
                /*'pagination' => [
                    'total' => $data->total(),
                    'per_page' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'from' => $data->firstItem(),
                    'to' => $data->lastItem()
                ],*/
                'data' => $data
            ];
        }
        //return $response;

        //$response = json($response);
        return response()->json($response);
    }

    /**
     * Upload new file and store it
     * @param  Request $request Request with form data: filename and file info
     * @return boolean          True if success, otherwise - false
     */
    public function store(Request $request)
    {

        $dataset = new Dataset();
        $dataset->name = $request->subject;
        $dataset->number = $request->mark;
        $dataset->save();
        return redirect('/');
    }
}
