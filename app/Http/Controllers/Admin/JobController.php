<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobRequest;
use App\Models\Admin\Job;
use Illuminate\Http\Request;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        return view('admin.jobs.index', compact('jobs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\JobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeModal(JobRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $job = Job::create($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'job' => $job,
                'message' => "Job Created Successfully",
                'redirectTo' => url()->previous(),
            ], 200);
        } else {
            return redirect(parse_url(url()->previous())['path']);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\JobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $job = Job::create($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'job' => $job,
                'message' => "Job Created Successfully",
                'redirectTo' => route('admin.jobs.index'),
            ], 200);
        } else {
            return redirect()->route("admin.jobs.index");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\JobRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, Job $job)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $job = $job->update($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'job' => $job,
                'message' => "Job Updated Successfully",
                'redirectTo' => route("admin.jobs.index"),
            ], 200);
        } else {
            return redirect()->route("admin.jobs.index");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $result = $job->delete();
        return redirect()->route('admin.jobs.index');
    }
    /**
     * return all jobs via json
     *
     * @return \Illuminate\Http\Response
     */
    public function getJobs(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = trim($request->q);
            $data = Job::select("id", "job_title")
                ->where('job_title', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data, 200);
    }
    /**
     * return all jobs via json
     *
     * @return \Illuminate\Http\Response
     */
    public function jobById(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = trim($request->q);
            $data = Job::select("id", "job_title", "requirements")
                ->where('id', $search)
                ->get();
        }
        return response()->json($data, 200);
    }
}
