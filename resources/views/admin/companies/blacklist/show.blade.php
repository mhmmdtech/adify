@extends('admin.layouts.master')

@push('head-tags')
    <title>جزئیات شرکت در لیست سیاه</title>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary mg-top-1 head-tools__title">جزئیات شرکت در لیست سیاه</h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <a href="{{ route('admin.companies.blacklist.edit', ['company' => $company->id]) }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link">
                ویرایش جزئیات شرکت در لیست سیاه
            </a>
        </div>
    </div>
    <article class="w-100 mg-top-1 overflow-x job-blog" id="ad-blog__whole-article">
        <h1 class="color-primary mg-bottom-1 job-blog__title">
            جزئیات {{ $company->company->company_name }} در لیست سیاه
        </h1>
        <ul class="d-flex flex-wrap list-style-none text-center color-primary mg-bottom-1 job-blog__detail">
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>دفتر مرکزی:</span>
                <span>{{ $company->company->central_office }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>جمعیت محل کار:</span>
                <span>{{ $company->company->office_population }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>آدرس سایت :</span>
                <a href="{{ $company->company->company_url }}" class="sky-blue">
                    {{ $company->company->company_url }}
                </a>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>میزان حقوق:</span>
                <span>{{ $company->getviolationStatusLabelAttribute() }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>تاریخ ایجاد شرکت در پلتفرم:</span>
                <span>{{ georgianToJalaliDate($company->company->created_at) }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>تاریخ افزوده شدن به لیست سیاه:</span>
                <span>{{ georgianToJalaliDate($company->created_at) }}</span>
            </li>
        </ul>
        <section class="mg-bottom-1">
            <h3 class="mg-bottom-1 color-primary job-blog__subtitle">
                توضیحات
            </h3>
            <p style="display: inline" class="mg-bottom-1 color-primary job-blog__text">
                {{ $company->explanation }}
            </p>
        </section>
    </article>
@endsection
