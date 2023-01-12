<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyBlacklistRequest;
use App\Models\Admin\CompanyBlacklist;

class CompanyBlacklistController extends Controller
{
    /**
     * Display a listing of the blacklisted companies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = CompanyBlacklist::orderBy('created_at', 'desc')->get();
        return view('admin.companies.blacklist.index', compact('companies'));
    }
    /**
     * Show the form for creating a new bad company.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.blacklist.create');
    }
    /**
     * Store a newly created bad company in storage.
     *
     * @param  \App\Http\Requests\Admin\JobAds\JobAdsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyBlacklistRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $inputs['violation_status'] = 1;
        $company = CompanyBlacklist::create($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'company' => $company,
                'message' => "New Company Added To Blacklist",
                'redirectTo' => route("admin.companies.blacklist.index"),
            ], 200);
        } else {
            return redirect()->route("admin.companies.blacklist.index");
        }
    }

    /**
     * Display the specified bad company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyBlacklist $company)
    {
        return view('admin.companies.blacklist.show', compact('company'));
    }
    /**
     * Show the form for editing the specified bad company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyBlacklist $company)
    {
        return view('admin.companies.blacklist.edit', compact('company'));
    }
    /**
     * Update the specified bad company in storage.
     *
     * @param  \App\Http\Requests\Admin\JobAds\JobAdsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyBlacklistRequest $request, CompanyBlacklist $company)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $inputs['violation_status'] = 1;
        $company = $company->update($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'company' => $company,
                'message' => "New Company Added To Blacklist",
                'redirectTo' => route("admin.companies.blacklist.index"),
            ], 200);
        } else {
            return redirect()->route("admin.companies.blacklist.index");
        }
    }
    /**
     * Remove the specified bad company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyBlacklist $company)
    {
        $result = $company->delete();
        return redirect()->route('admin.companies.blacklist.index');
    }
    /**
     * Change the violation status for a bad company
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeViolationStatus(CompanyBlacklist $company)
    {
        switch ($company->violation_status) {
            case 1:
                $company->violation_status = 2;
                break;
            case 2:
                $company->violation_status = 3;
                break;
            case 3:
                $company->violation_status = 1;
                break;
            default:
                $company->violation_status = 1;
        }
        $company->save();
        return back();
    }
}
