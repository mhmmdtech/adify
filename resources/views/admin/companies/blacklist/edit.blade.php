@extends('admin.layouts.master')

@push('head-tags')
    <title>ویرایش شرکت در لیست سیاه</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('style-tags')
    <link href="{{ asset('admin-assets/style/select2.css') }}" rel="stylesheet" />
@endpush

@push('script-tags')
    <script defer src="{{ asset('admin-assets/js/vendors/jquery-3.6.1.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/vendors/select2.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/vendors/select2.lang.fa.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/vendors/autosize.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/vendors/easyhttp3.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/utils/FormValidation.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/pages/editCompanyBlacklist.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/utils/JobifyModal.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/components/modal.js') }}"></script>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary text-capitalize mg-top-1 head-tools__title">
            ویرایش شرکت در لیست سیاه
        </h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <a href="{{ route('admin.companies.blacklist.index') }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover text-capitalize head-tools__link">رفتن
                به صفحه لیست سیاه شرکت‌ها
            </a>
        </div>
    </div>
    <section class="w-100 mg-top-1">
        <form id="edit-company-blacklist-form"
            class="w-100 d-flex flex-wrap flex-row justify-content-between mg-top-1 mg-bottom-1 job-form" novalidate
            method="post" enctype="multipart/form-data"
            action="{{ route('admin.companies.blacklist.update', ['company' => $company->id]) }}"
            data-secondary-action="{{ route('api.admin.companies.blacklist.update', ['company' => $company->id]) }}">
            @csrf
            {{ method_field('put') }}
            <div class="w-100 pos-relative d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                    for="company_id">نام شرکت</label>
                <span
                    class="d-flex align-items-center justify-content-between pd-left-half outline-0 border-0 shadow shadow--hover color-primary bg-primary job-form__input-area">
                    <input type="hidden" name="company" id="company" value="{{ $company->company_id }}" />
                    <select
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__selectbox"
                        name="company_id" id="company_id" data-error-name="نام شرکت">
                    </select>
                    <svg class="fill-primary cursor-pointer" data-modal-action="open|add_company_modal">
                        <use xlink:href="{{ asset('admin-assets/assets/icons/sprites.svg#add') }}"></use>
                    </svg>
                </span>
                <div class="mg-top-half mg-left-half error job-form__error @error('company_id') show @enderror"
                    data-input-error>
                    @error('company_id')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror

                </div>
            </div>
            <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                    for="explanation">توضیحات</label>
                <textarea name="explanation" id="explanation" cols="30" rows="10"
                    placeholder="توضیحاتی درباره تخلفات این شرکت بدهید"
                    class="w-100 outline-0 border-0 resize-none pd-half shadow shadow--hover color-primary bg-primary growing-height-textarea-js job-form__input"
                    data-error-name="توضیحات">{{ old('explanation', $company->explanation) }}</textarea>
                <div class="mg-top-half mg-left-half error job-form__error @error('explanation') show @enderror"
                    data-input-error>
                    @error('explanation')
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
        id="add_company_modal" data-modal-action="close|add_company_modal" data-modal>
        <div class="mg-1 pd-1 shadow shadow--hover bg-primary modal__wrapper" data-modal-wrapper>
            <header class="text-center color-primary modal__header">
                <h2>شرکت جدیدی اضافه کنید</h2>
            </header>
            <form id="create-company-form-in-modal"
                class="w-100 d-flex flex-wrap flex-row justify-content-between mg-top-1 mg-bottom-1 job-form" novalidate
                method="post" enctype="multipart/form-data" action="{{ route('admin.companies.store-modal') }}"
                data-secondary-action="{{ route('api.admin.companies.store-modal') }}">
                @csrf
                <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                    <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                        for="company_name">نام شرکت
                    </label>
                    <input type="text" name="company_name" id="company_name" placeholder="دیجی‌کالا"
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__input"
                        data-error-name="نام شرکت" value="{{ old('company_name') }}" />
                    <div class="mg-top-half mg-left-half error job-form__error @error('company_name') show @enderror"
                        data-input-error>
                        @error('company_name')
                            <span>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                    <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                        for="office_population">جمعیت سازمان
                    </label>
                    <span
                        class="d-flex align-items-center justify-content-between pd-left-half outline-0 border-0 shadow shadow--hover color-primary bg-primary job-form__input-area">
                        <select
                            class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__selectbox"
                            name="office_population" id="office_population" data-error-name="جمعیت سازمان">
                            <option value=""></option>
                            <option value="1" @if (old('office_population') == 1) selected @endif>مشخص نیست</option>
                            <option value="2" @if (old('office_population') == 2) selected @endif>کمتر از ۱۰ نفر
                            </option>
                            <option value="3" @if (old('office_population') == 3) selected @endif>بین ۱۰ تا ۱۰۰ نفر
                            </option>
                            <option value="4" @if (old('office_population') == 4) selected @endif>بین ۱۰۰ تا ۱۰۰۰ نفر
                            </option>
                            <option value="5" @if (old('office_population') == 5) selected @endif>بیش از ۱۰۰۰ نفر
                            </option>
                        </select>
                    </span>
                    <div class="mg-top-half mg-left-half error job-form__error @error('company_url') show @enderror"
                        data-input-error>
                        @error('company_url')
                            <span>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                    <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                        for="company_url">وبسایت کمپانی
                    </label>
                    <input type="text" name="company_url" id="company_url" placeholder="https://digikala.com"
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__input"
                        data-error-name="وبسایت کمپانی" value="{{ old('company_url') }}" />
                    <div class="mg-top-half mg-left-half error job-form__error @error('company_url') show @enderror"
                        data-input-error>
                        @error('company_url')
                            <span>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                    <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                        for="central_office">
                        دفتر مرکزی</label>
                    <input type="text" name="central_office" id="central_office" placeholder="تهران"
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__input"
                        data-error-name="دفتر مرکزی" value="{{ old('central_office') }}" />
                    <div class="mg-top-half mg-left-half error job-form__error @error('central_office') show @enderror"
                        data-input-error>
                        @error('central_office')
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
