@extends('../front.desktop.app')
@section('content')

@php
    $class = "jewerly";
    if ($site == "homewear") {
        $class = "loungewear";
    }
@endphp

<header class="{{ $class }} general-header">
<div class="general-logo">
    <a href="{{ url('/') }}"><img src="/fronts/img/icons/appaper.png"  height="30px"></a>
</div>

<div class="jewerlyContent">
    <div class="container">
        <div class="headerTop">
            <ul>
                <li>
                    <span><a href="{{ url('/'.$lang->lang.'/'.$site.'/contacts') }}">{{ trans('vars.Contacts.contactsTitle') }}</a></span>
                    <span><a href="{{ url('/'.$lang->lang.'/'.$site.'/about') }}">{{ trans('vars.PagesNames.pageAboutUs')  }}</a></span>
                    <span><a href="{{ url($lang->lang.'/'.$site.'/wholesale/')}}">{{ trans('vars.Wholesale.wholesaleTitle') }}</a></span>
                </li>
            </ul>
            <a href="{{ url('/'.$lang->lang.'/'.$site.'') }}" class="logo">
            <img src="/fronts/img/jewrly/logo.png" alt="logo" />
            </a>
            <ul class="userSettings">
                <li>
                    <span class="tooltip-flow" data-tooltip="{{ trans('vars.Wishlist.wishTitle') }}" data-flow="top">
                        <a href="{{ url('/'.$lang->lang.'/wish') }}" class="animated"  id="wish">
                            <wish-counter :items="{{ $wishProducts }}" site="loungewear"></wish-counter>
                        </a>
                    </span>
                </li>
                <li>
                    <span class="tooltip-flow" data-tooltip="{{ trans('vars.Cabinet.viewCart') }}" data-flow="top">
                        <a href="{{ url('/'.$lang->lang.'/cart') }}" class="animated"  id="cart">
                            <cart-counter :items="{{ $cartProducts }}" site="loungewear"></cart-counter>
                        </a>
                    </span>
                </li>
                <li>
                    <span class="tooltip-flow" data-tooltip="{{ trans('vars.Auth.myAccount') }}" data-flow="top">
                        @if (Auth::guard('persons')->user())
                        <a href="{{ url('/'.$lang->lang.'/account/personal-data') }}" id="avatar">
                        @else
                        <a href="" id="avatar" data-toggle="modal" data-target="#auth">
                            @endif
                            <svg viewBox="0 0 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg"> <g id="Symbols" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd"> <g id="project_20200129_150142" transform="translate(-1603.000000, -68.000000)"> <g transform="translate(-359.000000, -1053.000000)" id="Group-8"> <g> <g id="Group-16" transform="translate(355.500000, 1024.000000)"> <g id="Group-5" transform="translate(1606.500000, 97.000000)"> <path d="M14.4899419,27.375 C19.1843623,27.375 23,25.448744 23,23.5485015 C23,21.648259 19.1944204,14.625 14.5,14.625 C9.80557963,14.625 6,21.648259 6,23.5485015 C6,25.448744 9.79552154,27.375 14.4899419,27.375 Z" id="Oval-Copy" fill="none" opacity="0.946289062" ></path> <path d="M13.9898467,5.0655891e-05 C8.33156474,5.0655891e-05 3.23053052,3.40856172 1.06529337,8.63617717 C-1.09994384,13.8635529 0.0967607314,19.8806675 4.09767994,23.8818509 C7.62931266,27.4281256 12.7864312,28.8175386 17.6216642,27.5254349 C22.4568971,26.2335708 26.2334792,22.4567259 27.5255751,17.6217029 C28.8174312,12.7864403 27.4280267,7.62929018 23.8817738,4.0976358 C21.2640274,1.46549269 17.7019558,-0.00996461351 13.9898467,5.0655891e-05 Z M6.4275749,24.2634182 L6.4275749,23.052805 C6.4275749,18.8764169 9.81324461,15.4904868 13.9898467,15.4904868 C18.1664488,15.4904868 21.5521185,18.8764169 21.5521185,23.052805 L21.5521185,24.2634182 C17.0565071,27.5815195 10.9231863,27.5815195 6.4275749,24.2634182 Z M22.779262,23.2347205 L22.779262,23.052805 C22.779262,18.2065171 18.8363445,14.2635754 13.9898467,14.2635754 C9.14334894,14.2635754 5.2004314,18.2065171 5.2004314,23.052805 L5.2004314,23.2347205 C2.66249733,20.8295524 1.22563691,17.4862849 1.22755241,13.9896235 C1.22755241,6.95243969 6.95270599,1.22725285 13.9898467,1.22725285 C21.0269874,1.22725285 26.7521406,6.95243969 26.7521406,13.9896235 C26.7538168,17.4862849 25.3171961,20.8295524 22.7790223,23.2347205 L22.779262,23.2347205 Z" id="Shape" fill="#42261D" fillRule="nonzero" ></path> <circle id="Oval" fill="none" opacity="0.946289062" cx="14" cy="9" r="4"></circle> <path d="M14,4 C11.2386438,4 9,6.23864382 9,9 C9,11.7613562 11.2386438,14 14,14 C16.7613561,14 19,11.7613562 19,9 C18.9967156,6.239907 16.7600929,4.0032843 14,4 Z M14,12.7064827 C11.95311,12.7064827 10.2935173,11.04689 10.2935173,8.99999997 C10.2935173,6.95285737 11.95311,5.29351726 14,5.29351726 C16.0471427,5.29351726 17.7064827,6.95285737 17.7064827,8.99999997 C17.7042089,11.0461321 16.046132,12.704209 14,12.7064827 Z" id="Shape" fill="#42261D" fillRule="nonzero" ></path> </g> </g> </g> </g> </g> </g> </svg>
                        </a>
                    </span>
                </li>
                <li>
                    <span class="tooltip-flow" data-tooltip="{{ trans('vars.FormFields.settings') }}" data-flow="top">
                        <a href="#" id="settings" data-toggle="modal" data-target="#userSettings">
                            @if ($country->iso != "MD")
                                {{ $currency->abbr }} /
                            @else
                                MDL /
                            @endif
                            {{ $lang->lang }} /
                            <span><img src="/images/flags/24x24/{{ $country->flag }}" alt="icon" /></span>
                        </a>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>
</header>

<main class="homeContent">
    <section class="banner-section">
      <div class="item">
        <a href="{{ url('/'.$lang->lang.'/homewear') }}">
          {{-- <img src="https://anapopova.com/public/image/category/thumbs/version_drop/4ad7977ccdece79d12724722914fd8fa.jpg" alt=""> --}}
          <img src="{{ Banner('Banner_General_Homewear', $device) }}" alt="">
          <div class="title">
              {{ trans('vars.General.HomewearStore') }}
          </div>
        </a>
      </div>
      <div class="item">
        <a href="{{ url('/'.$lang->lang.'/bijoux') }}">
          {{-- <img src="https://anapopova.com/public/image/category/thumbs/version_drop/0021b0102e67a8329802ee98fa41a0d6.jpg" alt=""> --}}
          <img src="{{ Banner('Banner_General_Bijoux', $device) }}" alt="">
          <div class="title">
              {{ trans('vars.General.BijouxBoutique') }}
          </div>
        </a>
      </div>
    </section>
</main>
@stop
