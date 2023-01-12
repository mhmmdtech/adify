@extends('admin.layouts.master')

@push('head-tags')
    <title>درخواست کار</title>
@endpush


@push('script-tags')
    <script defer src="{{ asset('admin-assets/js/utils/ClipboardCustom.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/utils/JobifyModal.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/components/modal.js') }}"></script>
    <script defer src="{{ asset('admin-assets/js/pages/showAd.js') }}"></script>
@endpush

@section('content')
    <div class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
        <h3 class="color-primary mg-top-1 head-tools__title">آگهی شغلی</h3>
        <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
            <button type="button"
                class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                data-get-copy="#ad-blog__whole-article">
                کپی کردن آگهی شغلی
            </button>
            <a href="{{ route('admin.ads.edit', ['ad' => $ad->id]) }}"
                class="pd-1 border-0 outline-0 text-decoration-none color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link">
                ویرایش آگهی
            </a>
            <button type="button"
                class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                data-modal-action="open|ad-preview__telegram">
                پیش‌نمایش تلگرام
            </button>
            <button type="button"
                class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                data-modal-action="open|ad-preview__whatsapp">
                پیش‌نمایش واتس‌اَپ
            </button>
            <button type="button"
                class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                data-modal-action="open|ad-preview__twitter">
                پیش‌نمایش توئیتر
            </button>

            <button type="button"
                class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                data-modal-action="open|ad-preview__linkedin">
                پیش‌نمایش لینکدین
            </button>
        </div>
    </div>
    <article class="w-100 mg-top-1 overflow-x job-blog" id="ad-blog__whole-article">
        <h1 class="color-primary mg-bottom-1 job-blog__title">
            ❇️استخدام {{ $ad->job->job_title }} در {{ $ad->company->company_name }}
        </h1>
        <p class="mg-bottom-1 color-primary job-blog__text">
            دوستان ما فقط #فرصت_شغلی رو معرفی میکنیم / پس خودتون حواستون به همه
            چیز باشه و اگر سوال و یا موردی بود توی کامنت ها بگید / اما بریم سراغ
            معرفی :
        </p>
        <ul class="d-flex flex-wrap list-style-none text-center color-primary mg-bottom-1 job-blog__detail">
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>نیازمندی‌ها: </span>
                <span>{{ ConcatAndConvertStringToString($ad->requirements, ',', ', ') }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>درجه ارشدیت:</span>
                <span>{{ $ad->seniority() }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>جمعیت محل کار:</span>
                <span>{{ $ad->company->office_population }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>میزان حقوق:</span>
                <span>{{ $ad->salary() }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>نوع همکاری:</span>
                <span>{{ $ad->workType() }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>محل کار:</span>
                <span>{{ $ad->company->central_office }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>وضعیت انتشار:</span>
                <span>{{ $ad->publishStatus() }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>تاریخ ایجاد در پلتفرم:</span>
                <span>{{ georgianToJalaliDate($ad->created_at) }}</span>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>آدرس سایت :</span>
                <a href="{{ $ad->company->company_url }}" class="sky-blue">
                    {{ $ad->company->company_url }}
                </a>
            </li>
            <li class="mg-bottom-1 job-blog__detail-item">
                <span>منبع آگهی:</span>
                <a href="{{ $ad->ad_url }}" class="sky-blue">
                    {{ $ad->ad_url }}
                </a>
            </li>
        </ul>
        @isset($ad->explanation)
            <section class="mg-bottom-1">
                <h3 class="mg-bottom-1 color-primary job-blog__subtitle">
                    نقد و بررسی
                </h3>
                <p style="display: inline" class="mg-bottom-1 color-primary job-blog__text">
                    {{ $ad->explanation }}
                </p>
            </section>
        @endisset
        <section class="mg-bottom-1">
            <h3 class="mg-bottom-1 color-primary job-blog__subtitle">
                ثبت گزارش تخلف برای این اگهی :
            </h3>
            <ul class="list-style-none color-primary mg-bottom-1 job-blog__notices">
                <li class="mg-bottom-1">
                    <span>اگر این اگهی هر گونه مشکلی دارد و یا تخلفی برای آن وجود دارد
                        میتوانید از طریق لینک زیر برای آن گزارش ثبت کنید :</span>
                    <a href="https://alirezap30web.ir/violation-report/?code=N150987"
                        class="sky-blue">https://alirezap30web.ir/violation-report/?code=N150987
                    </a>
                </li>
                <li class="mg-bottom-1">
                    <span>بهترین اگهی های استخدامی را میتوانید در کانال استخدامی ما در
                        واتساپ مشاهده کنید :</span>
                    <a href="https://chat.whatsapp.com/L4iRg8ZMyLlIi4F8MeysXw"
                        class="sky-blue">https://chat.whatsapp.com/L4iRg8ZMyLlIi4F8MeysXw</a>
                </li>
                <li class="mg-bottom-1">
                    ❌مسئولیت تمامی آگهی ها با شخص آگهی دهنده می باشد
                </li>
                <li class="mg-bottom-1">
                    #استخدام #بازار_کار #فرصت_شغلی #برنامه_نویسی #مالی #رزومه
                    #حسابداری
                </li>
            </ul>
        </section>
    </article>
@endsection

@section('modal')
    <div class="d-flex justify-content-center align-items-center w-100 pos-fixed z-100 bg-backdrop modal__backdrop"
        id="ad-preview__telegram" data-modal-action="close|ad-preview__telegram" data-modal>
        <div class="mg-1 pd-1 shadow shadow--hover bg-primary modal__wrapper" data-modal-wrapper>
            <header class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
                <h2 class="head-tools__title">پیش‌نمایش تلگرام</h2>

                <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
                    <button type="button"
                        class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                        data-get-copy="#ad-blog__telegram-article">
                        کپی کردن آگهی شغلی
                    </button>
                </div>
            </header>
            <article class="w-100 mg-top-1 overflow-x job-blog" id="ad-blog__telegram-article">
                <h1 class="color-primary mg-bottom-1 job-blog__title">
                    ❇️استخدام {{ $ad->job->job_title }} در {{ $ad->company->company_name }}
                </h1>
                <p class="mg-bottom-1 color-primary job-blog__text">
                    دوستان ما فقط #فرصت_شغلی رو معرفی میکنیم / پس خودتون حواستون به همه
                    چیز باشه و اگر سوال و یا موردی بود توی کامنت ها بگید / اما بریم سراغ
                    معرفی :
                </p>
                <ul class="d-flex flex-wrap list-style-none text-center color-primary mg-bottom-1 job-blog__detail">
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>نیازمندی‌ها: </span>
                        <span>{{ ConcatAndConvertStringToString($ad->requirements, ',', ', ') }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>درجه ارشدیت:</span>
                        <span>{{ $ad->seniority() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>جمعیت محل کار:</span>
                        <span>{{ $ad->company->office_population }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>میزان حقوق:</span>
                        <span>{{ $ad->salary() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>نوع همکاری:</span>
                        <span>{{ $ad->workType() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>محل کار:</span>
                        <span>{{ $ad->company->central_office }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>وضعیت انتشار:</span>
                        <span>{{ $ad->publishStatus() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>تاریخ ایجاد در پلتفرم:</span>
                        <span>{{ georgianToJalaliDate($ad->created_at) }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>آدرس سایت :</span>
                        <a href="{{ $ad->company->company_url }}" class="sky-blue">
                            {{ $ad->company->company_url }}
                        </a>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>منبع آگهی:</span>
                        <a href="{{ $ad->ad_url }}" class="sky-blue">
                            {{ $ad->ad_url }}
                        </a>
                    </li>
                </ul>
                @isset($ad->explanation)
                    <section class="mg-bottom-1">
                        <h3 class="mg-bottom-1 color-primary job-blog__subtitle">
                            نقد و بررسی
                        </h3>
                        <p style="display: inline" class="mg-bottom-1 color-primary job-blog__text">
                            {{ $ad->explanation }}
                        </p>
                    </section>
                @endisset

            </article>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center w-100 pos-fixed z-100 bg-backdrop modal__backdrop"
        id="ad-preview__whatsapp" data-modal-action="close|ad-preview__whatsapp" data-modal>
        <div class="mg-1 pd-1 shadow shadow--hover bg-primary modal__wrapper" data-modal-wrapper>
            <header class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
                <h2 class="head-tools__title">پیش‌نمایش واتس‌اَپ</h2>

                <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
                    <button type="button"
                        class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                        data-get-copy="#ad-blog__whatsapp-article">
                        کپی کردن آگهی شغلی
                    </button>
                </div>
            </header>
            <article class="w-100 mg-top-1 overflow-x job-blog" id="ad-blog__whatsapp-article">
                <h1 class="color-primary mg-bottom-1 job-blog__title">
                    ❇️استخدام {{ $ad->job->job_title }} در {{ $ad->company->company_name }}
                </h1>
                <p class="mg-bottom-1 color-primary job-blog__text">
                    دوستان ما فقط #فرصت_شغلی رو معرفی میکنیم / پس خودتون حواستون به همه
                    چیز باشه و اگر سوال و یا موردی بود توی کامنت ها بگید / اما بریم سراغ
                    معرفی :
                </p>
                <ul class="d-flex flex-wrap list-style-none text-center color-primary mg-bottom-1 job-blog__detail">
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>نیازمندی‌ها: </span>
                        <span>{{ ConcatAndConvertStringToString($ad->requirements, ',', ', ') }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>درجه ارشدیت:</span>
                        <span>{{ $ad->seniority() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>جمعیت محل کار:</span>
                        <span>{{ $ad->company->office_population }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>میزان حقوق:</span>
                        <span>{{ $ad->salary() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>نوع همکاری:</span>
                        <span>{{ $ad->workType() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>محل کار:</span>
                        <span>{{ $ad->company->central_office }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>وضعیت انتشار:</span>
                        <span>{{ $ad->publishStatus() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>تاریخ ایجاد در پلتفرم:</span>
                        <span>{{ georgianToJalaliDate($ad->created_at) }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>آدرس سایت :</span>
                        <a href="{{ $ad->company->company_url }}" class="sky-blue">
                            {{ $ad->company->company_url }}
                        </a>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>منبع آگهی:</span>
                        <a href="{{ $ad->ad_url }}" class="sky-blue">
                            {{ $ad->ad_url }}
                        </a>
                    </li>
                </ul>
                @isset($ad->explanation)
                    <section class="mg-bottom-1">
                        <h3 class="mg-bottom-1 color-primary job-blog__subtitle">
                            نقد و بررسی
                        </h3>
                        <p style="display: inline" class="mg-bottom-1 color-primary job-blog__text">
                            {{ $ad->explanation }}
                        </p>
                    </section>
                @endisset
            </article>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center w-100 pos-fixed z-100 bg-backdrop modal__backdrop"
        id="ad-preview__twitter" data-modal-action="close|ad-preview__twitter" data-modal>
        <div class="mg-1 pd-1 shadow shadow--hover bg-primary modal__wrapper" data-modal-wrapper>
            <header class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
                <h2 class="head-tools__title">پیش‌نمایش توئیتر</h2>

                <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
                    <button type="button"
                        class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                        data-action="copy-ad__twitter" data-get-copy="#ad-blog__twitter-article">
                        کپی کردن آگهی شغلی
                    </button>
                </div>
            </header>
            <article class="w-100 mg-top-1 overflow-x job-blog" id="ad-blog__twitter-article">
                <h1 class="color-primary mg-bottom-1 job-blog__title">
                    ❇️استخدام {{ $ad->job->job_title }} در {{ $ad->company->company_name }}
                </h1>
                <p class="mg-bottom-1 color-primary job-blog__text">
                    دوستان ما فقط #فرصت_شغلی رو معرفی میکنیم / پس خودتون حواستون به همه
                    چیز باشه و اگر سوال و یا موردی بود توی کامنت ها بگید / اما بریم سراغ
                    معرفی :
                </p>
                <ul class="d-flex flex-wrap list-style-none text-center color-primary mg-bottom-1 job-blog__detail">
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>نیازمندی‌ها: </span>
                        <span>{{ ConcatAndConvertStringToString($ad->requirements, ',', ', ') }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>درجه ارشدیت:</span>
                        <span>{{ $ad->seniority() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>جمعیت محل کار:</span>
                        <span>{{ $ad->company->office_population }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>میزان حقوق:</span>
                        <span>{{ $ad->salary() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>نوع همکاری:</span>
                        <span>{{ $ad->workType() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>محل کار:</span>
                        <span>{{ $ad->company->central_office }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>وضعیت انتشار:</span>
                        <span>{{ $ad->publishStatus() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>تاریخ ایجاد در پلتفرم:</span>
                        <span>{{ georgianToJalaliDate($ad->created_at) }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>آدرس سایت :</span>
                        <a href="{{ $ad->company->company_url }}" class="sky-blue">
                            {{ $ad->company->company_url }}
                        </a>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>منبع آگهی:</span>
                        <a href="{{ $ad->ad_url }}" class="sky-blue">
                            {{ $ad->ad_url }}
                        </a>
                    </li>
                </ul>
            </article>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center w-100 pos-fixed z-100 bg-backdrop modal__backdrop"
        id="ad-preview__linkedin" data-modal-action="close|ad-preview__linkedin" data-modal>
        <div class="mg-1 pd-1 shadow shadow--hover bg-primary modal__wrapper" data-modal-wrapper>
            <header class="d-flex flex-row-reverse flex-wrap align-items-center justify-content-between w-100 head-tools">
                <h2 class="head-tools__title">پیش‌نمایش لینکدین</h2>

                <div class="d-flex align-items-center flex-wrap head-tools__link-wrapper">
                    <button type="button"
                        class="pd-1 border-0 outline-0 cursor-pointer color-primary bg-primary mg-top-1 shadow shadow--hover head-tools__link"
                        data-get-copy="#ad-blog__linkedin-article">
                        کپی کردن آگهی شغلی
                    </button>
                </div>
            </header>
            <article class="w-100 mg-top-1 overflow-x job-blog" id="ad-blog__linkedin-article">
                <h1 class="color-primary mg-bottom-1 job-blog__title">
                    ❇️استخدام {{ $ad->job->job_title }} در {{ $ad->company->company_name }}
                </h1>
                <p class="mg-bottom-1 color-primary job-blog__text">
                    دوستان ما فقط #فرصت_شغلی رو معرفی میکنیم / پس خودتون حواستون به همه
                    چیز باشه و اگر سوال و یا موردی بود توی کامنت ها بگید / اما بریم سراغ
                    معرفی :
                </p>
                <ul class="d-flex flex-wrap list-style-none text-center color-primary mg-bottom-1 job-blog__detail">
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>نیازمندی‌ها: </span>
                        <span>{{ ConcatAndConvertStringToString($ad->requirements, ',', ', ') }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>درجه ارشدیت:</span>
                        <span>{{ $ad->seniority() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>جمعیت محل کار:</span>
                        <span>{{ $ad->company->office_population }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>میزان حقوق:</span>
                        <span>{{ $ad->salary() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>نوع همکاری:</span>
                        <span>{{ $ad->workType() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>محل کار:</span>
                        <span>{{ $ad->company->central_office }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>وضعیت انتشار:</span>
                        <span>{{ $ad->publishStatus() }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>تاریخ ایجاد در پلتفرم:</span>
                        <span>{{ georgianToJalaliDate($ad->created_at) }}</span>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>آدرس سایت :</span>
                        <a href="{{ $ad->company->company_url }}" class="sky-blue">
                            {{ $ad->company->company_url }}
                        </a>
                    </li>
                    <li class="mg-bottom-1 job-blog__detail-item">
                        <span>منبع آگهی:</span>
                        <a href="{{ $ad->ad_url }}" class="sky-blue">
                            {{ $ad->ad_url }}
                        </a>
                    </li>
                </ul>
            </article>
        </div>
    </div>
@endsection
