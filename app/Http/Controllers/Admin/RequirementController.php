<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequirementRequest;
use App\Models\Admin\Requirement;
use Illuminate\Http\Request;


class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirements = Requirement::orderBy('created_at', 'desc')->get();
        return view('admin.requirements.index', compact('requirements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.requirements.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\RequirementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeModal(RequirementRequest $request)
    {

        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $requirement = Requirement::create($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'requirement' => $requirement,
                'message' => "Requirement Created Successfully",
                'redirectTo' => url()->previous(),
            ], 200);
        } else {
            return redirect(parse_url(url()->previous())['path']);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\RequirementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequirementRequest $request)
    {

        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $requirement = Requirement::create($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'requirement' => $requirement,
                'message' => "Requirement Created Successfully",
                'redirectTo' => route("admin.requirements.index"),
            ], 200);
        } else {
            return redirect()->route("admin.requirements.index");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        return view('admin.requirements.show', compact('requirement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Requirement $requirement)
    {
        return view('admin.requirements.edit', compact('requirement'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\RequirementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequirementRequest $request, Requirement $requirement)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $requirement = $requirement->update($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'requirement' => $requirement,
                'message' => "Requirement Updated Successfully",
                'redirectTo' => route("admin.requirements.index"),
            ], 200);
        } else {
            return redirect()->route("admin.requirements.index");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement)
    {
        $result = $requirement->delete();
        return redirect()->route('admin.requirements.index');
    }
    /**
     * return all jobs via json
     *
     * @return \Illuminate\Http\Response
     */
    public function getRequirements(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = trim($request->q);
            $data = Requirement::select("id", "requirement_title")
                ->where('requirement_title', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data, 200);
    }
}
