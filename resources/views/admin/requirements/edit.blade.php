@extends('admin.layouts.master')

@push('head-tags')
    <title>ویرایش آگهی شغلی</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('script-tags')
    <script defer src="{{ asset('admin-assets/js/vendors/easyhttp3.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/utils/FormValidation.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/pages/editRequirement.js') }}"></script>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary text-capitalize mg-top-1 head-tools__title">
            ویرایش آگهی شغلی
        </h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <a href="{{ route('admin.requirements.index') }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover text-capitalize head-tools__link">رفتن
                به صفحه نیازمندی‌ها
            </a>
        </div>
    </div>
    <section class="w-100 mg-top-1">
        <form id="edit-requirement-form"
            class="w-100 d-flex flex-wrap flex-row justify-content-between mg-top-1 mg-bottom-1 job-form" novalidate
            method="post" enctype="multipart/form-data"
            action="{{ route('admin.requirements.update', ['requirement' => $requirement->id]) }}"
            data-secondary-action="{{ route('api.admin.requirements.update', ['requirement' => $requirement->id]) }}">
            @csrf
            {{ method_field('put') }}
            <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                    for="requirement_title">
                    عنوان نیازمندی
                </label>
                <input type="text" name="requirement_title" id="requirement_title" placeholder="جاوااسکریپت"
                    class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__input"
                    data-error-name="عنوان نیازمندی"
                    value="{{ old('requirement_title', $requirement->requirement_title) }}" />
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
    </section>
@endsection
