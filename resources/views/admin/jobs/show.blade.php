@extends('admin.layouts.master')

@push('head-tags')
    <title>شغل</title>
@endpush


@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary mg-top-1 head-tools__title">شغل</h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <a href="{{ route('admin.jobs.edit', ['job' => $job->id]) }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link">
                ویرایش آگهی
            </a>
        </div>
    </div>
    <article class="w-100 mg-top-1 overflow-x job-blog" id="ad-blog__whole-article">
        <h1 class="color-primary mg-bottom-1 job-blog__title">
            {{ $job->job_title }}
        </h1>

        <ul class="d-flex flex-wrap list-style-none text-center color-primary mg-bottom-1 job-blog__detail">
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>نیازمندی‌ها: </span>
                <span>{{ ConcatAndConvertStringToString($job->requirements, ',', ', ') }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>تاریخ ایجاد در پلتفرم:</span>
                <span>{{ georgianToJalaliDate($job->created_at) }}</span>
            </li>
        </ul>


    </article>
@endsection
