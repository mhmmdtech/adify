@extends('admin.layouts.master')

@push('head-tags')
    <title>لیست سیاه شرکت‌ها</title>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary text-capitalize mg-top-1 head-tools__title">
            لیست سیاه شرکت‌ها
        </h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <a href="{{ route('admin.companies.blacklist.create') }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover text-capitalize head-tools__link">ایجاد
                شرکت جدید</a>
        </div>
    </div>
    <section class="w-100 mg-top-1 overflow-x job-ads">
        <table class="table-layout-fixed w-100 border-collapse color-primary ads-table" id="blacklist-companies__table">
            <thead>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    #
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    نام شرکت
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    محل کار
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    احراز تخلف
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    تاریخ ایجاد در پلتفرم
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    تاریخ افزوده شدن به لیست سیاه
                </th>
                <th scope="col" class="text-center border-color-primary ads-table__cell">
                    عملیات
                </th>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td scope="row" class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $company->company->company_name }}
                        </td>

                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $company->company->central_office }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $company->getviolationStatusLabelAttribute() }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ georgianToJalaliDate($company->company->created_at) }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ georgianToJalaliDate($company->created_at) }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            <a href="{{ route('admin.companies.blacklist.show', ['company' => $company->id]) }}"
                                class="d-inline-block pd-half mg-half text-decoration-none color-primary border-0 outline-0 bg-primary shadow shadow--hover">نمایش</a>
                            <a href="{{ route('admin.companies.blacklist.edit', ['company' => $company->id]) }}"
                                class="d-inline-block pd-half mg-half text-decoration-none color-primary border-0 outline-0 bg-primary shadow shadow--hover">ویرایش</a>
                            <form style="display: inline;" method="post"
                                action="{{ route('admin.companies.blacklist.destroy', ['company' => $company->id]) }}">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit"
                                    class="pd-half mg-half color-primary border-0 outline-0 bg-primary shadow shadow--hover cursor-pointer bg-transparent">
                                    حذف
                                </button>
                            </form>
                            <form style="display: inline;" method="post"
                                action="{{ route('admin.companies.blacklist.changeViolationStatus', ['company' => $company->id]) }}">
                                @csrf
                                {{ method_field('put') }}
                                <button type="submit"
                                    class="pd-half mg-half color-primary border-0 outline-0 bg-primary shadow shadow--hover cursor-pointer bg-transparent">
                                    تغییر وضعیت
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
