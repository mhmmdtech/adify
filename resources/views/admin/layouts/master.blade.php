<!DOCTYPE html>
<html lang="fa-IR" dir="rtl">
  <head>
    @include('admin.layouts.head-tags')
    @stack('head-tags')
    @include('admin.layouts.style-tags')
    @stack('style-tags')
    @include('admin.layouts.script-tags')
    @stack('script-tags')
  </head>
  <body
    class="pos-relative d-flex flex-column align-items-center justify-content-start bg-primary"
  >
    @include('admin.layouts.header')
    <main
      class="d-flex flex-column justify-content-start align-items-center flex-grow-1 app-main"
    >
        @yield('content')
    </main>

    @yield('modal')

  </body>
</html>
