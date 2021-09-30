@extends('../front.mobile.app')
@section('content')

<header class="bijoux jewerly general-header may">
    <ul class="nav">
        <li class="burger">
            <div id="burger">
                <div class="iconBar"></div>
            </div>
        </li>
        <li class="logoCenter"><a href="{{ url('/') }}"><img src="/fronts/img/icons/appaper.png" alt="" /></a></li>
        <li>
            <cart-counter-mob class="animated" id="cart" :items="{{ $cartProducts }}" site="loungewear">
            </cart-counter-mob>
        </li>
    </ul>
    <div class="navOpen" id="navOpen">
        <ul class="settings">
            <li class="widthSettings" >
                <p data-toggle="modal" data-target="#userSettings">
                    {{ $currency->abbr }} / {{ $lang->lang }} / <img src="/images/flags/24x24/{{ $country->flag }}" alt="icon" />
                </p>
                <p>|</p>
                <a href="#" data-toggle="modal" data-target="#userSettings">{{ trans('vars.TehButtons.change') }}</a>
            </li>
        </ul>

        <a href="{{ url('/'.$lang->lang.'/'.$site.'/contacts') }}">{{ trans('vars.Contacts.contactsTitle') }}</a>
        <a href="{{ url('/'.$lang->lang.'/'.$site.'/about') }}">{{ trans('vars.PagesNames.pageAboutUs')  }}</a>
        <a href="{{ url($lang->lang.'/'.$site.'/wholesale/')}}">{{ trans('vars.Wholesale.wholesaleTitle') }}</a>

        @if (Auth::guard('persons')->user())
            <a  href="{{ url('/'.$lang->lang.'/account/personal-data') }}" id="avatar">
        @else
            <a href="" id="avatar" data-toggle="modal" data-target="#auth">
        @endif
            Account
        </a>
        <!-- <div class="networks">
            <p>{{ trans('vars.HeaderFooter.followUs') }}:</p>
            <ul class="dspflex">
                <li>
                    <a href="{{ trans('vars.Contacts.instagram') }}">
                        <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" > <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Footer" transform="translate(-1548.000000, -431.000000)" fill="#B22D00" fill-rule="nonzero" > <g id="social"> <g transform="translate(1410.000000, 427.000000)"> <g id="instagram-social-network-logo-of-photo-camera" transform="translate(64.000000, 4.000000)" > <path d="M76.3103887,0 L89.6897961,0 C90.9604082,0 92,0.940705375 92,2.31018019 L92,15.6898198 C92,17.0592946 90.9604082,18 89.6897961,18 L76.3103887,18 C75.0394069,18 74,17.0592946 74,15.6898198 L74,2.31018019 C74,0.940705375 75.0394069,0 76.3103887,0 L76.3103887,0 Z M87.8865291,2 C87.398665,2 87,2.40944718 87,2.91045938 L87,5.08954062 C87,5.59034519 87.398665,6 87.8865291,6 L90.1130663,6 C90.6009304,6 91,5.59034519 91,5.08954062 L91,2.91045938 C91,2.40944718 90.6009304,2 90.1130663,2 L87.8865291,2 L87.8865291,2 Z M89.9996295,8 L88.4115078,8 C88.5617606,8.4706196 88.6430935,8.96914225 88.6430935,9.48490436 C88.6430935,12.3640726 86.1315936,14.6979761 83.0340894,14.6979761 C79.9367705,14.6979761 77.4256412,12.3640726 77.4256412,9.48490436 C77.4256412,8.96878679 77.5067888,8.47044187 77.6572268,8 L76,8 L76,15.3118432 C76,15.6902228 76.3227377,16 76.7173597,16 L89.2826403,16 C89.6772623,16 90,15.6904006 90,15.3118432 L90,8 L89.9996295,8 Z M83.4998211,6 C81.5670467,6 80,7.56690234 80,9.5 C80,11.4330977 81.5670467,13 83.4998211,13 C85.4327744,13 87,11.4330977 87,9.5 C87,7.56690234 85.4329533,6 83.4998211,6 Z" id="Shape" ></path> </g> </g> </g> </g> </g> </svg>
                    </a>
                </li>
                <li>
                    <a href="/">
                        <svg width="10px" height="19px" viewBox="0 0 10 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" > <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Footer" transform="translate(-1732.000000, -428.000000)" fill="#B22D00" fill-rule="nonzero" > <g id="social"> <g transform="translate(1410.000000, 427.000000)"> <path d="M330.187221,4.15465514 C328.766054,4.15465514 328.490905,4.82104815 328.490905,5.79901691 L328.490905,7.95536596 L331.880335,7.95536596 L331.879135,11.3329419 L328.490905,11.3329419 L328.490905,20 L324.955596,20 L324.955596,11.3329419 L322,11.3329419 L322,7.95536596 L324.955596,7.95536596 L324.955596,5.46473443 C324.955596,2.57406965 326.745162,1 329.358574,1 L332,1.00414645 L331.9998,4.15386534 L330.187221,4.15465514 Z" id="Shape-Copy" transform="translate(327.000000, 10.500000) rotate(-360.000000) translate(-327.000000, -10.500000) " ></path> </g> </g> </g> </g> </svg>
                    </a>
                </li>
            </ul>
        </div> -->
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
