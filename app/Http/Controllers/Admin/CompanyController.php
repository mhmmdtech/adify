<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyRequest;
use App\Models\Admin\Company;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')->get();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeModal(CompanyRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $company = Company::create($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'company' => $company,
                'message' => "Company Created Successfully",
                'redirectTo' => url()->previous(),
            ], 200);
        } else {
            return redirect(parse_url(url()->previous())['path']);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $company = Company::create($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'company' => $company,
                'message' => "Company Created Successfully",
                'redirectTo' => route("admin.companies.index"),
            ], 200);
        } else {
            return redirect()->route("admin.companies.index");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CompanyRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $company = $company->update($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'company' => $company,
                'message' => "Company Updated Successfully",
                'redirectTo' => route("admin.companies.index"),
            ], 200);
        } else {
            return redirect()->route("admin.companies.index");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $result = $company->delete();
        return redirect()->route('admin.companies.index');
    }
    /**
     * return all companies via json
     *
     * @return \Illuminate\Http\Response
     */
    public function getCompanies(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = trim($request->q);
            $data = Company::select("id", "company_name")
                ->where('company_name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data, 200);
    }
    /**
     * return all companies via json
     *
     * @return \Illuminate\Http\Response
     */
    public function companyById(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = trim($request->q);
            $data = Company::select("id", "company_name")
                ->where('id', $search)
                ->get();
        }
        return response()->json($data, 200);
    }
}
