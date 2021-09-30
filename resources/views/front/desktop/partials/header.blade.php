@php
$class = "jewerly";
if ($site == "homewear") {
    $class = "loungewear";
}
@endphp
<header class="{{ $class }}">
    <div class="cont">
        <div class="container tabHeader">
            <div id="jrly">
                <div class="innerTab">
                    <div class="logo">
                        <img src="/fronts/img/jewrly/logo.png" alt="" />
                    </div>
                    <a class="buttHeader" id="" href="{{ url('/'.$lang->lang.'/bijoux') }}">
                        <svg width="24px" height="12px" viewBox="0 0 24 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" > <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Header--Jewelry" transform="translate(-1538.000000, -54.000000)" fill="#5C591A"> <g id="Header" transform="translate(5.000000, -129.000000)"> <g id="Loungewear"> <g transform="translate(981.000000, 129.000000)"> <g id="Button-cos" transform="translate(541.000000, 29.000000)"> <g id="left-arrow" transform="translate(23.000000, 31.000000) scale(-1, 1) translate(-23.000000, -31.000000) translate(11.000000, 25.000000)" > <path d="M23.0625007,5.03225758 L3.20823416,5.03225758 L6.49716922,1.65367503 C6.86415332,1.27664256 6.86555957,0.663916412 6.50030984,0.285093618 C6.13506011,-0.0937775623 5.54143555,-0.0951807889 5.17445145,0.281803294 L0.275830079,5.31406419 C0.275501954,5.31435451 0.275267579,5.31469322 0.274986329,5.31498354 C-0.0910602746,5.69201601 -0.0922321487,6.30672603 0.274892579,6.68501657 C0.275220704,6.68530689 0.275455079,6.6856456 0.275736329,6.68593593 L5.1743577,11.7181968 C5.54129493,12.0951325 6.13491949,12.0938261 6.50021609,11.7149065 C6.86546582,11.3360837 6.86405957,10.7233575 6.49707547,10.3463251 L3.20823416,6.96774254 L23.0625007,6.96774254 C23.5802816,6.96774254 24,6.53448423 24,6 C24,5.46551588 23.5802816,5.03225758 23.0625007,5.03225758 Z" id="Path" ></path> </g> </g> </g> </g> </g> </g> </g> </svg>
                        {{ trans('vars.General.BijouxBoutique') }}
                    </a>
                    <div class="activeTab">
                        <a href="{{ url('/'.$lang->lang.'/bijoux') }}">
                            {{ trans('vars.General.BijouxBoutique') }}
                        </a>
                    </div>
                </div>
            </div>
            <div id="lngwr">
                <div class="innerTab">
                    <div class="logo">
                        <img src="/fronts/img/icons/logo.png" alt="" />
                    </div>
                    <a class="buttHeader" id="" href="{{ url('/'.$lang->lang.'/homewear') }}">
                        <svg width="24px" height="12px" viewBox="0 0 24 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" > <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Header--Jewelry" transform="translate(-1538.000000, -54.000000)" fill="#B22D00"> <g id="Header" transform="translate(5.000000, -129.000000)"> <g id="Loungewear"> <g transform="translate(981.000000, 129.000000)"> <g id="Button-cos" transform="translate(541.000000, 29.000000)"> <g id="left-arrow" transform="translate(23.000000, 31.000000) scale(-1, 1) translate(-23.000000, -31.000000) translate(11.000000, 25.000000)" > <path d="M23.0625007,5.03225758 L3.20823416,5.03225758 L6.49716922,1.65367503 C6.86415332,1.27664256 6.86555957,0.663916412 6.50030984,0.285093618 C6.13506011,-0.0937775623 5.54143555,-0.0951807889 5.17445145,0.281803294 L0.275830079,5.31406419 C0.275501954,5.31435451 0.275267579,5.31469322 0.274986329,5.31498354 C-0.0910602746,5.69201601 -0.0922321487,6.30672603 0.274892579,6.68501657 C0.275220704,6.68530689 0.275455079,6.6856456 0.275736329,6.68593593 L5.1743577,11.7181968 C5.54129493,12.0951325 6.13491949,12.0938261 6.50021609,11.7149065 C6.86546582,11.3360837 6.86405957,10.7233575 6.49707547,10.3463251 L3.20823416,6.96774254 L23.0625007,6.96774254 C23.5802816,6.96774254 24,6.53448423 24,6 C24,5.46551588 23.5802816,5.03225758 23.0625007,5.03225758 Z" id="Path" ></path> </g> </g> </g> </g> </g> </g> </g> </svg>
                        {{ trans('vars.General.HomewearStore') }}
                    </a>
                    <div class="activeTab">
                        <a href="{{ url('/'.$lang->lang.'/homewear') }}">
                            {{ trans('vars.General.HomewearStore') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($site == 'homewear')
    <div class="loungewearContent">
        <div class="container">
            <div class="headerTop">
                <ul>
                    <li class="submenu hoverThis" id="submenu">
                        <span><a href="#">{{ trans('vars.HeaderFooter.collections') }}</a></span>
                        <ul class="firstLvl" id="navCollections">
                            @if ($collectionsMenuLoungewear->count() > 0)
                                @foreach ($collectionsMenuLoungewear as $key => $collection)
                                    <li class="onHover">
                                        <a href="{{ url('/'.$lang->lang.'/'.$site.'/collection/'. $collection->alias) }}">{{ $collection->translation->name }}</a>
                                        @if ($collection->sets->count() > 0)
                                            <ul class="nextLvl" id="navSubcollections">
                                                @foreach ($collection->sets as $key => $set)
                                                    <li><a href="{{ url('/'.$lang->lang.'/'.$site.'/collection/'. $collection->alias.'?order='.$set->id) }}">{{ $set->translation->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li>
                        <span><a href="{{ url('/'.$lang->lang.'/'.$site.'/new') }}">{{ trans('vars.HeaderFooter.newIn') }}</a></span>
                        <span><a href="{{ url('/'.$lang->lang.'/'.$site.'/sale') }}">{{ trans('vars.HeaderFooter.outlet') }}</a></span>
                    </li>
                </ul>
                <a href="{{ url('/'.$lang->lang.'/'.$site.'') }}" class="logo">
                <img src="/fronts/img/icons/logo.png" alt="logo" />
                </a>
                <ul class="userSettings">
                    <li>
                      <span>
                        <a id="toHome" href="{{ url('/') }}">
                          <svg
                              id="Layer_1"
                              style="fill: currentColor"
                              enable-background="new 0 0 512 512"
                              viewBox="0 0 512 512"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                            <g>
                              <path
                                d="m426 495.983h-340c-25.364 0-46-20.635-46-46v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 7.72 6.28 14 14 14h340c7.72 0 14-6.28 14-14v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 25.364-20.635 46-46 46z"
                              ></path>
                              <path
                                d="m496 263.958c-4.095 0-8.189-1.562-11.313-4.687l-198.989-198.987c-16.375-16.376-43.02-16.376-59.396 0l-198.988 198.988c-6.248 6.249-16.379 6.249-22.627 0-6.249-6.248-6.249-16.379 0-22.627l198.988-198.989c28.852-28.852 75.799-28.852 104.65 0l198.988 198.988c6.249 6.249 6.249 16.379 0 22.627-3.123 3.125-7.218 4.687-11.313 4.687z"
                              ></path>
                              <path
                                d="m320 495.983h-128c-8.837 0-16-7.164-16-16v-142c0-27.57 22.43-50 50-50h60c27.57 0 50 22.43 50 50v142c0 8.836-7.163 16-16 16zm-112-32h96v-126c0-9.925-8.075-18-18-18h-60c-9.925 0-18 8.075-18 18z"
                              ></path>
                            </g>
                          </svg>
                        </a>
                      </span>
                    </li>
                    <li>
                        <span class="tooltip-flow" data-tooltip="Search" data-flow="top">
                            <a href="#" data-toggle="modal" data-target="#search">

                              <svg width="27px" height="26px" viewBox="0 0 27 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="project_20200129_150142" transform="translate(-1363.000000, -68.000000)" fill="#42261D" fill-rule="nonzero">
                                        <g transform="translate(-359.000000, -1053.000000)" id="Group-8">
                                            <g>
                                                <g id="Group-16" transform="translate(356.500000, 1055.000000)">
                                                    <path d="M1392.5,90.4223958 L1384.53359,82.7442708 C1385.99609,80.9838542 1386.875,78.7427083 1386.875,76.3052083 C1386.875,70.6109375 1382.08672,66 1376.1875,66 C1370.28125,66 1365.5,70.6177083 1365.5,76.3052083 C1365.5,81.9927083 1370.28828,86.6104167 1376.1875,86.6104167 C1378.73281,86.6104167 1381.06719,85.7505208 1382.90234,84.321875 L1390.86172,92 L1392.5,90.4223958 Z M1369.42344,82.8322917 C1367.61641,81.0921875 1366.625,78.7765625 1366.625,76.3119792 C1366.625,73.8473958 1367.62344,71.5317708 1369.42344,69.7916667 C1371.22344,68.0515625 1373.63516,67.0833333 1376.1875,67.0833333 C1378.73984,67.0833333 1381.14453,68.0447917 1382.95156,69.7848958 C1384.75859,71.525 1385.75,73.840625 1385.75,76.3052083 C1385.75,78.7697917 1384.75156,81.0854167 1382.95156,82.8255208 C1381.14453,84.565625 1378.73984,85.5271189 1376.1875,85.5271189 C1373.63516,85.5338542 1371.23047,84.5723958 1369.42344,82.8322917 Z" id="Shape"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                              </svg>
                            </a>
                        <span>
                    </li>
                    <li>
                        <span class="tooltip-flow" data-tooltip="{{ trans('vars.Wishlist.wishTitle') }}" data-flow="top">
                            <a href="{{ url('/'.$lang->lang.'/wish') }}" class="animated"  id="wish">
                                <wish-counter :items="{{ $wishProducts }}" site="loungewear"></wish-counter>
                            </a>
                        <span>
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
                        <span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="headerBottom">
            <div class="utilBloc"></div>
            <ul>
                @if ($categoriesMenuLoungewear->count() > 0)
                    @foreach ($categoriesMenuLoungewear as $key => $category)
                        <li>
                            <span><a href="{{ url('/'.$lang->lang.'/'.$site.'/catalog/'. $category->alias) }}">{{ $category->translation->name }}</a></span>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="utilBloc"></div>
        </div>
    </div>
    @else
    <div class="jewerlyContent">
        <div class="container">
            <div class="headerTop">
                <ul>
                    <li class="submenu hoverThis" id="submenu">
                        <span><a href="#">{{ trans('vars.HeaderFooter.collections') }}</a></span>
                        <ul class="firstLvl" id="navCollections">
                            @if ($collectionsMenuJewelry->count() > 0)
                                @foreach ($collectionsMenuJewelry as $key => $collection)
                                    <li class="onHover">
                                        <a href="{{ url('/'.$lang->lang.'/'.$site.'/collection/'. $collection->alias) }}">{{ $collection->translation->name }}</a>
                                        @if ($collection->sets->count() > 0)
                                            <ul class="nextLvl" id="navSubcollections">
                                                @foreach ($collection->sets as $key => $set)
                                                    <li><a href="{{ url('/'.$lang->lang.'/'.$site.'/collection/'. $collection->alias.'?order='.$set->id) }}">{{ $set->translation->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li>
                        <span><a href="{{ url('/'.$lang->lang.'/'.$site.'/new') }}">{{ trans('vars.HeaderFooter.newIn') }}</a></span>
                        <span><a href="{{ url('/'.$lang->lang.'/'.$site.'/sale') }}">{{ trans('vars.HeaderFooter.outlet') }}</a></span>
                    </li>
                </ul>
                <a href="{{ url('/'.$lang->lang.'/'.$site.'') }}" class="logo">
                <img src="/fronts/img/jewrly/logo.png" alt="logo" />
                </a>
                <ul class="userSettings">
                    <li>
                      <span>
                        <a id="toHome" href="{{ url('/') }}">
                          <svg
                              id="Layer_1"
                              style="fill: currentColor"
                              enable-background="new 0 0 512 512"
                              viewBox="0 0 512 512"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                            <g>
                              <path
                                d="m426 495.983h-340c-25.364 0-46-20.635-46-46v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 7.72 6.28 14 14 14h340c7.72 0 14-6.28 14-14v-242.02c0-8.836 7.163-16 16-16s16 7.164 16 16v242.02c0 25.364-20.635 46-46 46z"
                              ></path>
                              <path
                                d="m496 263.958c-4.095 0-8.189-1.562-11.313-4.687l-198.989-198.987c-16.375-16.376-43.02-16.376-59.396 0l-198.988 198.988c-6.248 6.249-16.379 6.249-22.627 0-6.249-6.248-6.249-16.379 0-22.627l198.988-198.989c28.852-28.852 75.799-28.852 104.65 0l198.988 198.988c6.249 6.249 6.249 16.379 0 22.627-3.123 3.125-7.218 4.687-11.313 4.687z"
                              ></path>
                              <path
                                d="m320 495.983h-128c-8.837 0-16-7.164-16-16v-142c0-27.57 22.43-50 50-50h60c27.57 0 50 22.43 50 50v142c0 8.836-7.163 16-16 16zm-112-32h96v-126c0-9.925-8.075-18-18-18h-60c-9.925 0-18 8.075-18 18z"
                              ></path>
                            </g>
                          </svg>
                        </a>
                      </span>
                    </li>
                    <li>
                        <span class="tooltip-flow" data-tooltip="Search" data-flow="top">
                            <a href="#" data-toggle="modal" data-target="#search">

                              <svg width="28px" height="26px" viewBox="0 0 28 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Header" transform="translate(-1363.000000, -65.000000)" fill="#5C591A" fill-rule="nonzero">
                                        <g transform="translate(-5.000000, -32.000000)" id="project_20200129_150142">
                                            <g>
                                                <g transform="translate(0.813021, 0.000000)" id="Group-8">
                                                    <g>
                                                        <g id="Group-16" transform="translate(0.685677, 0.000000)">
                                                            <path d="M1394.22526,121.422396 L1386.2547,113.744271 C1387.71797,111.983854 1388.59733,109.742708 1388.59733,107.305208 C1388.59733,101.610937 1383.80656,97 1377.90426,97 C1371.99494,97 1367.2112,101.617708 1367.2112,107.305208 C1367.2112,112.992708 1372.00197,117.610417 1377.90426,117.610417 C1380.4509,117.610417 1382.78649,116.750521 1384.62261,115.321875 L1392.58613,123 L1394.22526,121.422396 Z M1371.13668,113.832292 C1369.32871,112.092188 1368.33678,109.776562 1368.33678,107.311979 C1368.33678,104.847396 1369.33574,102.531771 1371.13668,100.791667 C1372.93762,99.0515625 1375.35059,98.0833333 1377.90426,98.0833333 C1380.45794,98.0833333 1382.86388,99.0447917 1384.67185,100.784896 C1386.47982,102.525 1387.47174,104.840625 1387.47174,107.305208 C1387.47174,109.769792 1386.47279,112.085417 1384.67185,113.825521 C1382.86388,115.565625 1380.45794,116.527119 1377.90426,116.527119 C1375.35059,116.533854 1372.94465,115.572396 1371.13668,113.832292 Z" id="Shape"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                              </svg>
                            </a>
                        </span>
                    </li>
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
        <div class="headerBottom">
            <div class="utilBloc" style="background-position: 100%;"></div>
            <ul>
                @if ($categoriesMenuJewelry->count() > 0)
                    @foreach ($categoriesMenuJewelry as $key => $category)
                        <li>
                            <span><a href="{{ url('/'.$lang->lang.'/'.$site.'/catalog/'. $category->alias) }}">{{ $category->translation->name }}</a></span>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="utilBloc"></div>
        </div>
    </div>
    @endif
</header>
