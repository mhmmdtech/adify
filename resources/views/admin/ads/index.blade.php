@extends('admin.layouts.master')

@push('head-tags')
    <title>لیست آگهی‌ها </title>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary text-capitalize mg-top-1 head-tools__title">
            لیست آگهی‌ها
        </h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <a href="{{ route('admin.ads.create') }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover text-capitalize head-tools__link">ایجاد
                آگهی جدید</a>
        </div>
    </div>
    <section class="w-100 mg-top-1 overflow-x job-ads">
        <table class="table-layout-fixed w-100 border-collapse color-primary ads-table" id="ads__table">
            <thead>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    #
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    نام شرکت
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    عنوان شغلی
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    میزان حقوق
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    نوع همکاری
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    محل کار
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    وضعیت انتشار
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    درجه ارشدیت
                </th>
                <th scope="col" class="text-center border-color-primary pd-half ads-table__cell">
                    تاریخ ایجاد در پلتفرم
                </th>
                <th scope="col" class="text-center border-color-primary ads-table__cell">
                    عملیات
                </th>
            </thead>
            <tbody>
                @foreach ($ads as $ad)
                    <tr>
                        <td scope="row" class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $loop->iteration }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $ad->company->company_name }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $ad->job->job_title }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $ad->salary() }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $ad->workType() }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $ad->company->central_office }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $ad->publishStatus() }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ $ad->seniority() }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            {{ georgianToJalaliDate($ad->created_at) }}
                        </td>
                        <td class="text-center border-color-primary pd-half ads-table__cell">
                            <a href="{{ route('admin.ads.show', ['ad' => $ad->id]) }}"
                                class="d-inline-block pd-half mg-half text-decoration-none color-primary border-0 outline-0 bg-primary shadow shadow--hover">نمایش</a>
                            <a href="{{ route('admin.ads.edit', ['ad' => $ad->id]) }}"
                                class="d-inline-block pd-half mg-half text-decoration-none color-primary border-0 outline-0 bg-primary shadow shadow--hover">ویرایش</a>
                            <form style="display: inline;" method="post"
                                action="{{ route('admin.ads.destroy', ['ad' => $ad->id]) }}">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit"
                                    class="pd-half mg-half color-primary border-0 outline-0 bg-primary shadow shadow--hover cursor-pointer bg-transparent">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
