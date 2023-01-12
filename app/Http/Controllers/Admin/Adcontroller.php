<?php
// https://auth0.com/blog/build-and-secure-laravel-api/
// https://daily-dev-tips.com/posts/laravel-basic-api-routes/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdRequest;
use App\Models\Admin\Ad;
use App\Models\Admin\CompanyBlacklist;
use Illuminate\Validation\Validator;

class Adcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::orderBy('created_at', 'desc')->get();
        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\AdRequest  $request
     * @param  \Illuminate\Validation\Validator  $validator
     */
    public function store(AdRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $inputs['publish_status'] = 2;

        $ad = Ad::create($inputs);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'ad' => $ad,
                'message' => "Ad Created Successfully",
                'redirectTo' => route("admin.ads.index"),
            ], 200);
        } elseif (!$request->ajax()) {
            return redirect()->route("admin.ads.index");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        return view('admin.ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\AdRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, Ad $ad)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $inputs['publish_status'] = 2;
        $ad = $ad->update($inputs);
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'ad' => $ad,
                'message' => "Ad Updated Successfully",
                'redirectTo' => route("admin.ads.index"),
            ], 200);
        } else {
            return redirect()->route("admin.ads.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $result = $ad->delete();
        return redirect()->route('admin.ads.index');
    }
}
