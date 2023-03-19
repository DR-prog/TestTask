<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotebookResourse;
use Illuminate\Http\Request;
use App\Models\Notebook;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NotebookController extends Controller
{
    public function getNotebook()
    {
        $notebooks = Notebook::all();
        $page = $notebooks['page'] ?? 1;
        $per_page = $notebooks['per_page'] ?? 1;
        $notebooks = DB::table('notebooks')->paginate($per_page, ['*'], 'page', $page);
        return NotebookResourse::collection($notebooks);
    }

    public function getById($id)
    {
        $notebook = Notebook::find($id);
        if (is_null($notebook)) {
            return response()->json(['error' => true, 'message' => 'not found'], 404);
        }
        return response()->json(Notebook::find($id), 200);
    }

    public function create(Request $request)
    {
        $rules = [
            'fio' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $notebook = Notebook::create($request->all());
        return new NotebookResourse($notebook, 201);
    }

    public function edit(Request $request, $id)
    {

        $notebook = Notebook::find($id);
        if (is_null($notebook)) {
            return response()->json(['error' => true, 'message' => 'not found'], 404);
        }
        $notebook->update($request->all());
        return new NotebookResourse($notebook, 200);
    }

    public function deleteNotebook(Request $request, $id)
    {
        $notebook = Notebook::find($id);
        if (is_null($notebook)) {
            return response()->json(['error' => true, 'message' => 'not found'], 404);
        }
        $notebook->delete();
        return response()->json('', 204);
    }
}
