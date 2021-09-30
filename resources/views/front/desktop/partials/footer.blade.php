@php
$class = "footerLoungewear";
if ($site == "bijoux") {
    $class = "footerJewerly";
}
@endphp
<footer class="{{ $class }}">
    <div class="fontran"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="row justify-content-between">
                    <div class="col jrwLogo">
                        <p>{{ trans('vars.General.BijouxBoutique') }}</p>
                        <a href="{{ url('/'.$lang->lang.'/'.$site) }}" class="logo"><img src="/fronts/img/jewrly/logo.png" alt="logo"/></a>
                    </div>
                    <div class="col lngwLogo">
                        <p>{{ trans('vars.General.HomewearStore') }}</p>
                        <a href="{{ url('/'.$lang->lang.'/'.$site) }}" class="logo"><img src="/fronts/img/icons/logo.png" alt="logo"/></a>
                    </div>
                    <ul class="col-lg-auto col-md-6">
                        <li>{{ trans('vars.HeaderFooter.ourProducts') }}:</li>
                        <li><a href="{{ url('/'.$lang->lang.'/'.$site) }}">{{ trans('vars.General.HomewearStore') }}</a></li>
                        <li><a href="{{ url('/'.$lang->lang.'/'.$site) }}">{{ trans('vars.General.BijouxBoutique') }}</a></li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/wholesale/')}}">{{ trans('vars.Wholesale.wholesaleTitle') }}</a></li>
                    </ul>
                    <ul class="col-lg-auto col-md-6">
                        <li>{{ trans('vars.HeaderFooter.aboutAnnePopova') }}</li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/about/')}}">{{ trans('vars.PagesNames.pageAboutUs') }}</a></li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/contacts/')}}">{{ trans('vars.Contacts.contactsTitle') }}</a></li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/livrare-achitare-retur') }}">{{ trans('vars.PagesNames.pageDelivery') }}</a></li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/size-guide') }}">{{ trans('vars.PagesNames.pageSizeGuide') }}</a></li>
                    </ul>
                    <ul class="col-lg-auto col-md-6">
                        <li>{{ trans('vars.HeaderFooter.usefulInfo') }}:</li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/terms/')}}">{{ trans('vars.PagesNames.pageNameTermsConditions') }}</a></li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/confidentiality/')}}">{{ trans('vars.PagesNames.pageNamePrivacyPolicy') }}</a></li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/refund/')}}">{{ trans('vars.PagesNames.pageReturnPolicy') }}</a></li>
                        <li><a href="{{ url($lang->lang.'/'.$site.'/cookie/')}}">{{ trans('vars.PagesNames.pageNameCookiePolicy') }}</a></li>
                    </ul>
                    <div class="col-12">
                        <ul class="paymentMethodsFooter">
                            <li class="mastercard">
                                <img src="/images/mc_symbol.svg" alt="">
                            </li>
                            <li class="visa">
                                <svg width="256px" height="83px" viewBox="0 0 256 83" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid"> <defs> <linearGradient x1="45.9741966%" y1="-2.00617467%" x2="54.8768726%" y2="100%" id="linearGradient-1"> <stop stop-color="#222357" offset="0%"></stop> <stop stop-color="#254AA5" offset="100%"></stop> </linearGradient> </defs> <g> <path d="M132.397094,56.2397455 C132.251036,44.7242808 142.65954,38.2977599 150.500511,34.4772086 C158.556724,30.5567233 161.262627,28.0430004 161.231878,24.5376253 C161.17038,19.1719416 154.805357,16.804276 148.847757,16.7120293 C138.454628,16.5505975 132.412467,19.5178668 127.607952,21.7625368 L123.864273,4.24334875 C128.684163,2.02174043 137.609033,0.084559486 146.864453,-7.10542736e-15 C168.588553,-7.10542736e-15 182.802234,10.7236802 182.879107,27.3511501 C182.963666,48.4525854 153.69071,49.6210438 153.890577,59.05327 C153.959762,61.912918 156.688728,64.964747 162.669389,65.7411565 C165.628971,66.133205 173.800493,66.433007 183.0636,62.1665965 L186.699658,79.11693 C181.718335,80.931115 175.314876,82.6684285 167.343223,82.6684285 C146.895202,82.6684285 132.512402,71.798691 132.397094,56.2397455 M221.6381,81.2078555 C217.671491,81.2078555 214.327548,78.8940005 212.836226,75.342502 L181.802894,1.24533061 L203.511621,1.24533061 L207.831842,13.1835926 L234.360459,13.1835926 L236.866494,1.24533061 L256,1.24533061 L239.303345,81.2078555 L221.6381,81.2078555 M224.674554,59.6067505 L230.939643,29.5804456 L213.781755,29.5804456 L224.674554,59.6067505 M106.076031,81.2078555 L88.9642665,1.24533061 L109.650591,1.24533061 L126.754669,81.2078555 L106.076031,81.2078555 M75.473185,81.2078555 L53.941265,26.7822953 L45.2316377,73.059396 C44.2092367,78.2252115 40.1734431,81.2078555 35.6917903,81.2078555 L0.491982464,81.2078555 L0,78.886313 C7.22599245,77.318119 15.4359498,74.7890215 20.409585,72.083118 C23.4537265,70.4303645 24.322383,68.985166 25.3217224,65.0569935 L41.8185094,1.24533061 L63.68098,1.24533061 L97.1972855,81.2078555 L75.473185,81.2078555" fill="url(#linearGradient-1)" transform="translate(128.000000, 41.334214) scale(1, -1) translate(-128.000000, -41.334214) "></path> </g> </svg>
                            </li>
                            <li class="pp">
                              <img src="/images/pp.jpeg" alt="">
                            </li>
                    </div>
                    <div class="col-12">
                    <p>
                    {{ trans('vars.HeaderFooter.concept') }}
                    </p>
                    <p>©{{ date('Y') }} {{ trans('vars.HeaderFooter.footerCopyright') }} Website by Like-Media</p>
                    </div>
                </div>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 text-right">
                @if (@$_COOKIE['country_id'] == 140)
                    <ul class="support">
                        <li>{{ trans('vars.HeaderFooter.support') }}:</li>
                        <li><a href="#" onclick="return false;">{{ trans('vars.Contacts.brandCompany') }}</a></li>
                        <li><a href="#" onclick="return false;">{{ trans('vars.Contacts.contactsLabelAddress') }} {{ trans('vars.Contacts.addressSiteShop2') }}</a></li>
                        <li><a href="#" onclick="return false;">{{ trans('vars.Contacts.telViberWhatsapp') }}</a> <a href="tel:{{ trans('vars.Contacts.phoneNumber') }}">{{ trans('vars.Contacts.phoneNumber') }}</a></li>
                        <li><a href="#" onclick="return false;">{{ trans('vars.Contacts.contactsLabelEmail') }}</a> <a href="mailto:{{ trans('vars.Contacts.email') }}">{{ trans('vars.Contacts.email') }}</a></li>
                    </ul>
                @else
                    <ul class="support">
                        <li>{{ trans('vars.HeaderFooter.support') }}:</li>
                        <li><a href="#" onclick="return false;">{{ trans('vars.Contacts.queriesPaymentShippingReturnsCompany') }}</a></li>
                        <li><a href="#" onclick="return false;">{{ trans('vars.Contacts.contactsLabelAddress') }} {{ trans('vars.Contacts.queriesPaymentShippingReturnsAddressWarehouse') }}</a></li>
                        <li><a href="#" onclick="return false;">{{ trans('vars.Contacts.telViberWhatsapp') }}</a> <a href="tel:{{ trans('vars.Contacts.queriesPaymentShippingReturnsPhone') }}">{{ trans('vars.Contacts.queriesPaymentShippingReturnsPhone') }}</a></li>
                        <li><a href="#" onclick="return false;">{{ trans('vars.Contacts.contactsLabelEmail') }}</a> <a href="mailto:{{ trans('vars.Contacts.queriesPaymentShippingReturnsEmail') }}">{{ trans('vars.Contacts.queriesPaymentShippingReturnsEmail') }}</a></li>
                    </ul>
                @endif

                <div class="networks">
                    <p>{{ trans('vars.HeaderFooter.followUs') }}:</p>
                    <ul class="dspflex">
                        @if ($site == 'homewear')
                            <li>
                                <a href="{{ trans('vars.Contacts.instaHomewear') }}">
                                    <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" > <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Footer" transform="translate(-1548.000000, -431.000000)" fill="#B22D00" fill-rule="nonzero" > <g id="social"> <g transform="translate(1410.000000, 427.000000)"> <g id="instagram-social-network-logo-of-photo-camera" transform="translate(64.000000, 4.000000)" > <path d="M76.3103887,0 L89.6897961,0 C90.9604082,0 92,0.940705375 92,2.31018019 L92,15.6898198 C92,17.0592946 90.9604082,18 89.6897961,18 L76.3103887,18 C75.0394069,18 74,17.0592946 74,15.6898198 L74,2.31018019 C74,0.940705375 75.0394069,0 76.3103887,0 L76.3103887,0 Z M87.8865291,2 C87.398665,2 87,2.40944718 87,2.91045938 L87,5.08954062 C87,5.59034519 87.398665,6 87.8865291,6 L90.1130663,6 C90.6009304,6 91,5.59034519 91,5.08954062 L91,2.91045938 C91,2.40944718 90.6009304,2 90.1130663,2 L87.8865291,2 L87.8865291,2 Z M89.9996295,8 L88.4115078,8 C88.5617606,8.4706196 88.6430935,8.96914225 88.6430935,9.48490436 C88.6430935,12.3640726 86.1315936,14.6979761 83.0340894,14.6979761 C79.9367705,14.6979761 77.4256412,12.3640726 77.4256412,9.48490436 C77.4256412,8.96878679 77.5067888,8.47044187 77.6572268,8 L76,8 L76,15.3118432 C76,15.6902228 76.3227377,16 76.7173597,16 L89.2826403,16 C89.6772623,16 90,15.6904006 90,15.3118432 L90,8 L89.9996295,8 Z M83.4998211,6 C81.5670467,6 80,7.56690234 80,9.5 C80,11.4330977 81.5670467,13 83.4998211,13 C85.4327744,13 87,11.4330977 87,9.5 C87,7.56690234 85.4329533,6 83.4998211,6 Z" id="Shape" ></path> </g> </g> </g> </g> </g> </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ trans('vars.Contacts.facebookHomewear') }}">
                                    <svg width="10px" height="19px" viewBox="0 0 10 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" > <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Footer" transform="translate(-1732.000000, -428.000000)" fill="#B22D00" fill-rule="nonzero" > <g id="social"> <g transform="translate(1410.000000, 427.000000)"> <path d="M330.187221,4.15465514 C328.766054,4.15465514 328.490905,4.82104815 328.490905,5.79901691 L328.490905,7.95536596 L331.880335,7.95536596 L331.879135,11.3329419 L328.490905,11.3329419 L328.490905,20 L324.955596,20 L324.955596,11.3329419 L322,11.3329419 L322,7.95536596 L324.955596,7.95536596 L324.955596,5.46473443 C324.955596,2.57406965 326.745162,1 329.358574,1 L332,1.00414645 L331.9998,4.15386534 L330.187221,4.15465514 Z" id="Shape-Copy" transform="translate(327.000000, 10.500000) rotate(-360.000000) translate(-327.000000, -10.500000) " ></path> </g> </g> </g> </g> </svg>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ trans('vars.Contacts.instaBijoux') }}">
                                    <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" > <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Footer" transform="translate(-1548.000000, -431.000000)" fill="#B22D00" fill-rule="nonzero" > <g id="social"> <g transform="translate(1410.000000, 427.000000)"> <g id="instagram-social-network-logo-of-photo-camera" transform="translate(64.000000, 4.000000)" > <path d="M76.3103887,0 L89.6897961,0 C90.9604082,0 92,0.940705375 92,2.31018019 L92,15.6898198 C92,17.0592946 90.9604082,18 89.6897961,18 L76.3103887,18 C75.0394069,18 74,17.0592946 74,15.6898198 L74,2.31018019 C74,0.940705375 75.0394069,0 76.3103887,0 L76.3103887,0 Z M87.8865291,2 C87.398665,2 87,2.40944718 87,2.91045938 L87,5.08954062 C87,5.59034519 87.398665,6 87.8865291,6 L90.1130663,6 C90.6009304,6 91,5.59034519 91,5.08954062 L91,2.91045938 C91,2.40944718 90.6009304,2 90.1130663,2 L87.8865291,2 L87.8865291,2 Z M89.9996295,8 L88.4115078,8 C88.5617606,8.4706196 88.6430935,8.96914225 88.6430935,9.48490436 C88.6430935,12.3640726 86.1315936,14.6979761 83.0340894,14.6979761 C79.9367705,14.6979761 77.4256412,12.3640726 77.4256412,9.48490436 C77.4256412,8.96878679 77.5067888,8.47044187 77.6572268,8 L76,8 L76,15.3118432 C76,15.6902228 76.3227377,16 76.7173597,16 L89.2826403,16 C89.6772623,16 90,15.6904006 90,15.3118432 L90,8 L89.9996295,8 Z M83.4998211,6 C81.5670467,6 80,7.56690234 80,9.5 C80,11.4330977 81.5670467,13 83.4998211,13 C85.4327744,13 87,11.4330977 87,9.5 C87,7.56690234 85.4329533,6 83.4998211,6 Z" id="Shape" ></path> </g> </g> </g> </g> </g> </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ trans('vars.Contacts.facebookBijoux') }}">
                                    <svg width="10px" height="19px" viewBox="0 0 10 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" > <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Footer" transform="translate(-1732.000000, -428.000000)" fill="#B22D00" fill-rule="nonzero" > <g id="social"> <g transform="translate(1410.000000, 427.000000)"> <path d="M330.187221,4.15465514 C328.766054,4.15465514 328.490905,4.82104815 328.490905,5.79901691 L328.490905,7.95536596 L331.880335,7.95536596 L331.879135,11.3329419 L328.490905,11.3329419 L328.490905,20 L324.955596,20 L324.955596,11.3329419 L322,11.3329419 L322,7.95536596 L324.955596,7.95536596 L324.955596,5.46473443 C324.955596,2.57406965 326.745162,1 329.358574,1 L332,1.00414645 L331.9998,4.15386534 L330.187221,4.15465514 Z" id="Shape-Copy" transform="translate(327.000000, 10.500000) rotate(-360.000000) translate(-327.000000, -10.500000) " ></path> </g> </g> </g> </g> </svg>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
