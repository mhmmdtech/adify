@extends('admin.layouts.master')

@push('head-tags')
    <title> داشبورد </title>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary text-capitalize mg-top-1 head-tools__title">
            داشبورد
        </h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <button type="button"
                class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover text-capitalize head-tools__link"
                data-theme-toggler="dark">
                تم تیره
            </button>
            <button type="button"
                class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover text-capitalize head-tools__link"
                data-theme-toggler="light">
                تم روشن
            </button>
        </div>
    </div>
    <section class="w-100 mg-top-1 overflow-x job-ads">
        <div class="card-column pd-half">
            <a href="{{ route('admin.ads.index') }}"
                class="d-flex align-items-center justify-content-center text-center text-decoration-none border-0 pd-1 color-primary bg-primary shadow shadow--hover goal-card">
                <h3 class="goal-card__title">آگهی‌ها</h3>
            </a>
            <a href="{{ route('admin.jobs.index') }}"
                class="d-flex align-items-center justify-content-center text-center text-decoration-none border-0 pd-1 color-primary bg-primary shadow shadow--hover goal-card">
                <h3 class="goal-card__title">مشاغل</h3>
            </a>
            <a href="{{ route('admin.companies.index') }}"
                class="d-flex align-items-center justify-content-center text-center text-decoration-none border-0 pd-1 color-primary bg-primary shadow shadow--hover goal-card">
                <h3 class="goal-card__title">شرکت‌ها</h3>
            </a>
            <a href="{{ route('admin.requirements.index') }}"
                class="d-flex align-items-center justify-content-center text-center text-decoration-none border-0 pd-1 color-primary bg-primary shadow shadow--hover goal-card">
                <h3 class="goal-card__title">نیازمندی‌ها</h3>
            </a>
        </div>
    </section>
@endsection
