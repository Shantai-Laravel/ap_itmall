<!DOCTYPE html>
<html   lang="{{ @$lang->lang }}"
        currency="{{ @$currency->abbr }}"
        currency-rate="{{ @$currency->rate }}"
        main-currency={{ @$mainCurrency->abbr }}
        device="{{ isMobile() ? 'sm' : 'md' }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{{ @$seoData['title'] }}</title>
        <meta name="description" content="{{ @$seoData['description'] }}">
        <meta name="keywords" content="{{ @$seoData['keywords'] }}">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('fronts_mobile/css/app.css?'. uniqid('', true)) }}" />

        <link rel="stylesheet" type="text/css" href="{{ asset('fronts/css/futures.css?'.uniqid()) }}" />

        @if ($site == 'bijoux')
            <link rel="shortcut icon" href="/APJ_favicon.png" type="image/x-icon">
            <link rel="stylesheet" type="text/css" href="{{ asset('fronts/css/desktop-bijoux.css?'. uniqid('', true)) }}" />
        @else
            <link rel="shortcut icon" href="/APL_favicon.png" type="image/x-icon">
            <!-- <link rel="stylesheet" type="text/css" href="{{ asset('fronts/css/desktop-homeware.css?'. uniqid('', true)) }}" /> -->
        @endif

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TX9D8K5');</script>
        <!-- End Google Tag Manager -->

        @yield('microdataFacebook')
        @yield('microdataGoogle')

        @include('front.facebookPixel')

        {{-- <script src="https://apps.elfsight.com/p/platform.js" defer></script> --}}
        {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
        {{-- <div class="elfsight-app-d84bcab9-0a8b-48a0-bd96-dd8bfe16a628"></div> --}}
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
       <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TX9D8K5"
       height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
       <!-- End Google Tag Manager (noscript) -->
        <div id="cover">
            <google-events :products="{{ @$productList }}" :list="'{{ @$list }}'"></google-events>
            @yield('content')
            @include('front.desktop.partials.modals')
        </div>

        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"
            ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"
            ></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"
            ></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <script>
            let images = $('.load-img');
            for (var i = 0; i < images.length; i++) {
                let src = $('.load-img').eq(i).data('src');
                $('.load-img').eq(i).attr('src', src);
            }
            $(window).on('load',function(){
                $('#myModal').modal('show');
            });
        </script>

        <script src="/{{ $lang->lang }}/js/lang.js?{{ uniqid('', true) }}"></script>
        <script src="{{ asset('fronts/js/app_desktop.js?'.uniqid()) }}"></script>
        <script src="{{ asset('fronts/js/bundle.js?'.uniqid()) }}"></script>

        {{-- @yield('purchase-event') --}}
        @yield('scripts')

        <style>
            .oneProduct .addToWish{display:none}.st1{fill:url(#SVGID_1_)}.cls-1{fill:none}.cls-2{fill:#ff5f00}.cls-3{fill:#eb001b}.cls-4{fill:#f79e1b}.cls-5{fill:#211e1f}.st1{fill:url(#SVGID_1_)}
        </style>

    </body>

</html>
