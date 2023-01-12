@extends('admin.layouts.master')

@push('head-tags')
    <title>ویرایش شغل </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('style-tags')
    <link href="{{ asset('admin-assets/style/select2.css') }}" rel="stylesheet" />
@endpush

@push('script-tags')
    <script defer src="{{ asset('admin-assets/js/vendors/jquery-3.6.1.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/vendors/select2.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/vendors/select2.lang.fa.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/vendors/easyhttp3.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/utils/FormValidation.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/pages/editJob.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/utils/JobifyModal.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/components/modal.js') }}"></script>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary text-capitalize mg-top-1 head-tools__title">
            ویرایش شغل
        </h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <a href="{{ route('admin.jobs.index') }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover text-capitalize head-tools__link">رفتن
                به صفحه مشاغل
            </a>
        </div>
    </div>
    <section class="w-100 mg-top-1">
        <form id="edit-job-form"
            class="w-100 d-flex flex-wrap flex-row justify-content-between mg-top-1 mg-bottom-1 job-form" novalidate
            method="post" enctype="multipart/form-data" action="{{ route('admin.jobs.update', ['job' => $job->id]) }}"
            data-secondary-action="{{ route('api.admin.jobs.update', ['job' => $job->id]) }}">
            @csrf
            {{ method_field('put') }}
            <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label" for="job_title">
                    عنوان شغلی
                </label>
                <input type="text" name="job_title" id="job_title" placeholder="جاوااسکریپت"
                    class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__input"
                    data-error-name="عنوان شغلی" value="{{ old('job_title', $job->job_title) }}" />
                <div class="mg-top-half mg-left-half error job-form__error @error('job_title') show @enderror"
                    data-input-error>
                    @error('job_title')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                    for="requirements">نیازمندی‌های این آگهی
                </label>
                <span
                    class="d-flex align-items-center justify-content-between pd-left-half outline-0 border-0 shadow shadow--hover color-primary bg-primary job-form__input-area">
                    <input type="hidden" name="requirements" id="requirements"
                        value="{{ old('requirements', ConcatAndConvertStringToString($job->requirements, ',', ', ')) }}"
                        data-error-name="نیازمندی‌های این آگهی" />

                    <select
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__selectbox"
                        name="requirements__tags" id="requirements__tags">
                    </select>
                    <svg class="fill-primary cursor-pointer" data-modal-action="open|add_requirement_modal">
                        <use xlink:href="{{ asset('admin-assets/assets/icons/sprites.svg#add') }}"></use>
                    </svg>
                </span>
                <div class="mg-top-half mg-left-half error job-form__error @error('requirements') show @enderror"
                    data-input-error>
                    @error('requirements')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group">
                <button type="submit"
                    class="w-100 cursor-pointer border-0 outline-0 pd-top-1 pd-bottom-1 pd-left-1 pd-right-1 color-primary bg-primary shadow shadow--hover job-form__submit">
                    ثبت درخواست
                </button>
            </div>
        </form>
    </section>
@endsection

@section('modal')
    <div class="d-flex justify-content-center align-items-center w-100 pos-fixed z-100 bg-backdrop modal__backdrop"
        id="add_requirement_modal" data-modal-action="close|add_requirement_modal" data-modal>
        <div class="mg-1 pd-1 shadow shadow--hover bg-primary modal__wrapper" data-modal-wrapper>
            <header class="text-center color-primary modal__header">
                <h2>نیازمندی جدید اضافه کنید</h2>
            </header>
            <form id="create-requirement-form-in-modal"
                class="w-100 d-flex flex-wrap flex-row justify-content-between mg-top-1 mg-bottom-1 job-form" novalidate
                method="post" enctype="multipart/form-data" action="{{ route('admin.requirements.store-modal') }}"
                data-secondary-action="{{ route('api.admin.requirements.store-modal') }}">
                @csrf
                <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                    <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                        for="requirement_title">عنوان نیازمندی
                    </label>
                    <input type="text" name="requirement_title" id="requirement_title" placeholder="عنوان نیازمندی"
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__input"
                        data-error-name="عنوان نیازمندی" value="{{ old('requirement_title') }}" />
                    <div class="mg-top-half mg-left-half error job-form__error @error('requirement_title') show @enderror"
                        data-input-error>
                        @error('requirement_title')
                            <span>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group">
                    <button type="submit"
                        class="w-100 cursor-pointer border-0 outline-0 pd-top-1 pd-bottom-1 pd-left-1 pd-right-1 color-primary bg-primary shadow shadow--hover job-form__submit">
                        ثبت درخواست
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
