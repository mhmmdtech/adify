@extends('admin.layouts.master')

@push('head-tags')
    <title>ویرایش آگهی</title>
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
    <script defer src="{{ asset('admin-assets/js/pages/editAd.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/utils/JobifyModal.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/components/modal.js') }}"></script>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary text-capitalize mg-top-1 head-tools__title">
            ویرایش آگهی
        </h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <a href="{{ route('admin.ads.index') }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover text-capitalize head-tools__link">رفتن
                به صفحه آگهی‌ها
            </a>
        </div>
    </div>
    <section class="w-100 mg-top-1">
        <form id="edit-ad-form"
            class="w-100 d-flex flex-wrap flex-row justify-content-between mg-top-1 mg-bottom-1 job-form" novalidate
            method="post" enctype="multipart/form-data" action="{{ route('admin.ads.update', ['ad' => $ad->id]) }}"
            data-secondary-action="{{ route('api.admin.ads.update', ['ad' => $ad->id]) }}">
            @csrf
            {{ method_field('put') }}
            <div class="w-100-lt-576 w-50-gt-576 pos-relative d-flex flex-column mg-top-1 job-form__input-group"
                data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                    for="company_id">نام شرکت آگهی دهنده</label>
                <span
                    class="d-flex align-items-center justify-content-between pd-left-half outline-0 border-0 shadow shadow--hover color-primary bg-primary job-form__input-area">
                    <input type="hidden" name="company" id="company" value="{{ $ad->company->id }}" />
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
            <div class="w-100-lt-576 w-50-gt-576 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                    for="job_id">عنوان شغلی
                </label>
                <span
                    class="d-flex align-items-center justify-content-between pd-left-half outline-0 border-0 shadow shadow--hover color-primary bg-primary job-form__input-area">
                    <input type="hidden" name="job" id="job" value="{{ $ad->job->id }}" />
                    <select
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__selectbox"
                        name="job_id" id="job_id" data-error-name="عنوان شغلی">
                    </select>
                    <svg class="fill-primary cursor-pointer" data-modal-action="open|add_job_title_modal">
                        <use xlink:href="{{ asset('admin-assets/assets/icons/sprites.svg#add') }}"></use>
                    </svg>
                </span>
                <div class="mg-top-half mg-left-half error job-form__error @error('job_id') show @enderror"
                    data-input-error>
                    @error('job_id')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="w-100-lt-576 w-50-gt-576 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                    for="salary">میزان حقوق
                </label>
                <span
                    class="d-flex align-items-center justify-content-between pd-left-half outline-0 border-0 shadow shadow--hover color-primary bg-primary job-form__input-area">
                    <select
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__selectbox"
                        name="salary" id="salary" data-error-name="میزان حقوق">
                        <option value=""></option>
                        <option value="1" @if (old('salary', $ad->salary) == 1) selected @endif>مشخص نیست</option>
                        <option value="2" @if (old('salary', $ad->salary) == 2) selected @endif>توافقی</option>
                        <option value="3" @if (old('salary', $ad->salary) == 3) selected @endif>کمتر از ۱۰ میلیون تومان
                        </option>
                        <option value="4" @if (old('salary', $ad->salary) == 4) selected @endif>بین ۱۰ تا ۲۰ میلیون تومان
                        </option>
                        <option value="5" @if (old('salary', $ad->salary) == 5) selected @endif>بین ۲۰ تا ۵۰ میلیون تومان
                        </option>
                        <option value="6" @if (old('salary', $ad->salary) == 6) selected @endif>بیش از ۵۰ میلیون تومان
                        </option>
                    </select>
                </span>
                <div class="mg-top-half mg-left-half error job-form__error @error('salary') show @enderror"
                    data-input-error>
                    @error('salary')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="w-100-lt-576 w-50-gt-576 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label" for="seniority">سطح
                    ارشدیت
                </label>
                <span
                    class="d-flex align-items-center justify-content-between pd-left-half outline-0 border-0 shadow shadow--hover color-primary bg-primary job-form__input-area">
                    <select
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__selectbox"
                        name="seniority" id="seniority" data-error-name="سطح ارشدیت">
                        <option value=""></option>
                        <option value="1" @if (old('seniority', $ad->seniority) == 1) selected @endif>مشخص نیست</option>
                        <option value="2" @if (old('seniority', $ad->seniority) == 2) selected @endif>کارآموز</option>
                        <option value="3" @if (old('seniority', $ad->seniority) == 3) selected @endif>تازه‌کار</option>
                        <option value="4" @if (old('seniority', $ad->seniority) == 4) selected @endif>میانی</option>
                        <option value="5" @if (old('seniority', $ad->seniority) == 5) selected @endif>ارشد</option>
                    </select>
                </span>
                <div class="mg-top-half mg-left-half error job-form__error @error('seniority') show @enderror"
                    data-input-error>
                    @error('seniority')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="w-100-lt-576 w-50-gt-576 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label" for="work_type">نوع
                    همکاری
                </label>
                <span
                    class="d-flex align-items-center justify-content-between pd-left-half outline-0 border-0 shadow shadow--hover color-primary bg-primary job-form__input-area">
                    <select
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__selectbox"
                        name="work_type" id="work_type" data-error-name="نوع همکاری">
                        <option value=""></option>
                        <option value="1" @if (old('work_type', $ad->work_type) == 1) selected @endif>مشخص نیست</option>
                        <option value="2" @if (old('work_type', $ad->work_type) == 2) selected @endif>دورکاری</option>
                        <option value="3" @if (old('work_type', $ad->work_type) == 3) selected @endif>حضوری</option>
                        <option value="4" @if (old('work_type', $ad->work_type) == 4) selected @endif>هیبریدی</option>
                    </select>
                </span>
                <div class="mg-top-half mg-left-half error job-form__error @error('work_type') show @enderror"
                    data-input-error>
                    @error('work_type')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="w-100-lt-576 w-50-gt-576 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label" for="ad_url">آدرس
                    اینترنتی منبع آگهی</label>
                <input type="text" name="ad_url" id="ad_url"
                    placeholder="https://jobinja.ir/companies/my_company/jobs/abcd/example_job"
                    class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__input"
                    data-error-name="منبع آگهی" value="{{ old('ad_url', $ad->ad_url) }}" />
                <div class="mg-top-half mg-left-half error job-form__error @error('ad_url') show @enderror"
                    data-input-error>
                    @error('ad_url')
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
                    <input type="hidden" name="requirements" id="requirements" data-error-name="نیازمندی‌های این آگهی"
                        value="{{ old('requirements', ConcatAndConvertStringToString($ad->requirements, ',', ', ')) }}" />
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
            <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                    for="explanation">نقد و بررسی</label>
                <textarea name="explanation" id="explanation" cols="30" rows="10"
                    placeholder="خلاصه‌ای از بررسی‌های انجام شده را بنویسید(اختیاری)"
                    class="w-100 outline-0 border-0 resize-none pd-half shadow shadow--hover color-primary bg-primary growing-height-textarea-js job-form__input"
                    data-error-name="توضیحات">{{ old('explanation', $ad->explanation) }}</textarea>
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
    <div class="d-flex justify-content-center align-items-center w-100 pos-fixed z-100 bg-backdrop modal__backdrop"
        id="add_job_title_modal" data-modal-action="close|add_job_title_modal" data-modal>
        <div class="mg-1 pd-1 shadow shadow--hover bg-primary modal__wrapper" data-modal-wrapper>
            <header class="text-center color-primary modal__header">
                <h2>عنوان شغلی جدیدی اضافه کنید</h2>
            </header>
            <form id="create-job-form-in-modal"
                class="w-100 d-flex flex-wrap flex-row justify-content-between mg-top-1 mg-bottom-1 job-form" novalidate
                method="post" enctype="multipart/form-data" action="{{ route('admin.jobs.store-modal') }}"
                data-secondary-action="{{ route('api.admin.jobs.store-modal') }}">
                @csrf
                <div class="w-100 d-flex flex-column mg-top-1 job-form__input-group" data-input-group>
                    <label class="text-capitalize mg-bottom-half mg-left-half color-primary job-form__label"
                        for="job_title">عنوان شغلی
                    </label>
                    <input type="text" name="job_title" id="job_title" placeholder="توسعه‌دهنده فرانت‌اند"
                        class="w-100 outline-0 border-0 pd-half shadow shadow--hover color-primary bg-primary job-form__input"
                        data-error-name="عنوان شغلی" value="{{ old('job_title') }}" />
                    <div class="mg-top-half mg-left-half error job-form__error @error('job_title') show @enderror"
                        data-input-error>
                        @error('job_title')
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
