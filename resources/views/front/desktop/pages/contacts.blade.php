@extends('front.desktop.app')
@section('content')
@include('front.desktop.partials.header')
<main class="contactContent">
    <!-- <h3>{{ trans('vars.Contacts.contactUs') }}</h3> -->
    <div class="contactBanner">
      <img src="/images/contactBanner.jpg" alt="">
      <div class="test">
        <div class="container">
          <div class="innerTest">
            <h3>{{ trans('vars.Contacts.contactUs') }}</h3>
            <p>{{ trans('vars.Contacts.ContactsSubtitle') }}</p>
          </div>
        </div>
      </div>
    </div>
    <h3>{{ trans('vars.Contacts.contactsTitle') }} </h3>
    <div class="container">
        <div class="row justify-content-around">
          <div class="col-md-4">
            <div class="bloc">
              <img src="/images/RO.png" alt="">
              <div class="country">
                {{ trans('vars.Contacts.countryRomania') }}
              </div>
              <ul>
                <li>{{ trans('vars.Contacts.queriesPaymentShippingReturnsCompany') }}</li>
                <li>
                  <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" class="svg-inline--fa fa-map-marker-alt fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#42261D" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg>

                  <a href="#" class="location">{{ trans('vars.Contacts.labelWarehouseAddress') }}: {{ trans('vars.Contacts.queriesPaymentShippingReturnsAddressWarehouse') }}</a>
                </li>
                <li>
                  <svg width="21px" height="20px" viewBox="0 0 21 20" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                        <g id="Contact_APL-" transform="translate(-736.000000, -897.000000)" fill="#42261D" fillRule="nonzero">
                            <g id="Contact" transform="translate(266.000000, 450.000000)">
                                <g id="Contacts" transform="translate(470.000000, 86.000000)">
                                    <g id="Group-3" transform="translate(0.000000, 353.000000)">
                                        <g id="call" transform="translate(0.000000, 8.000000)">
                                            <path d="M19.3149185,13.1277083 C18.0292187,13.1277083 16.7668157,12.9361979 15.5705298,12.5596875 C14.9741094,12.3659896 14.2950565,12.5163021 13.905956,12.8939063 L11.5447199,14.5915104 C8.80635988,13.199375 7.11958302,11.5934375 5.67780553,9.00505208 L7.40784008,6.81484375 C7.85731548,6.38734375 8.01853381,5.76286458 7.82537806,5.17692708 C7.42834784,4.03161458 7.22666087,2.82989583 7.22666087,1.60489583 C7.22671556,0.719947917 6.47077221,0 5.54163401,0 L1.68502686,0 C0.755943344,0 0,0.719947917 0,1.60479167 C0,11.7480729 8.66455556,20 19.3149185,20 C20.2440567,20 21,19.2800521 21,18.3951562 L21,14.7325 C21,13.8476562 20.244002,13.1277083 19.3149185,13.1277083 Z M19.8332999,18.3952083 C19.8332999,18.6675521 19.6008786,18.8889062 19.3149185,18.8889062 C9.30767889,18.8889062 1.16670009,11.1355208 1.16670009,1.60484375 C1.16670009,1.3325 1.39912136,1.11114583 1.68508155,1.11114583 L5.54168869,1.11114583 C5.82764889,1.11114583 6.06007016,1.3325 6.06007016,1.60484375 C6.06007016,2.94869792 6.28166333,4.26760417 6.71517001,5.51708333 C6.77554486,5.7015625 6.72654498,5.8925 6.53060018,6.08677083 L4.52537884,8.61598958 C4.39095732,8.78578125 4.369848,9.013125 4.47069148,9.20244792 C6.10732003,12.2661458 8.09602579,14.1601562 11.3356502,15.7410937 C11.5327434,15.8392708 11.7742975,15.8186979 11.9531798,15.6901042 L14.6698837,13.7299479 C14.8071489,13.5992187 15.0128281,13.5525521 15.1985464,13.6127604 C16.5195742,14.0283333 17.9044221,14.2388542 19.3149185,14.2388542 C19.6008786,14.2388542 19.8332999,14.4602083 19.8332999,14.7325521 L19.8332999,18.3952083 Z" id="Shape"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                  </svg>
                  <a href="tel:+{{ trans('vars.Contacts.queriesPaymentShippingReturnsPhone') }}" class="phone">{{ trans('vars.Contacts.telViberWhatsapp') }}: +{{ trans('vars.Contacts.queriesPaymentShippingReturnsPhone') }}</a>
                </li>
                <li>
                  <svg width="28px" height="27px" viewBox="0 0 28 27" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                            <g id="Contact_APL-" transform="translate(-736.000000, -1074.000000)" fill="#42261D" fillRule="nonzero">
                                <g id="email" transform="translate(736.000000, 1074.000000)">
                                    <path d="M27.641239,9.44299415 L23.6249914,6.60822531 L23.6249914,4.2206075 C23.6249914,3.75463182 23.2332651,3.3769263 22.749992,3.3769263 L19.0574942,3.3769263 L14.5162469,0.162500909 C14.2087393,-0.0541669698 13.7912552,-0.0541669698 13.4837475,0.162500909 L8.94250026,3.3769263 L5.25000248,3.3769263 C4.76672933,3.3769263 4.375003,3.75463182 4.375003,4.2206075 L4.375003,6.60822531 L0.35875542,9.44299415 C0.132622743,9.60229171 -0.00070530178,9.85634521 2.80643766e-06,10.1263759 L2.80643766e-06,24.4689564 C2.80643766e-06,25.8668307 1.1752393,27 2.62500406,27 L25.3749904,27 C26.8247551,27 27.9999916,25.8668307 27.9999916,24.4689564 L27.9999916,10.1263759 C28.0006997,9.85634521 27.867317,9.60229171 27.641239,9.44299415 Z M23.6249914,8.70055469 L25.5499903,10.0588814 L23.6249914,11.1641038 L23.6249914,8.70055469 Z M13.9999972,1.89204738 L16.099996,3.3769263 L11.8999985,3.3769263 L13.9999972,1.89204738 Z M6.12500195,5.0642887 L21.8749925,5.0642887 L21.8749925,12.1765213 L13.9999972,16.7323998 L6.12500195,12.1765213 L6.12500195,5.0642887 Z M4.375003,8.70055469 L4.375003,11.1725406 L2.45000416,10.0588814 L4.375003,8.70055469 Z M26.2499899,24.4689564 C26.2499899,24.9349321 25.8582635,25.3126376 25.3749904,25.3126376 L2.62500406,25.3126376 C2.14173091,25.3126376 1.75000458,24.9349321 1.75000458,24.4689564 L1.75000458,11.6196917 L13.5537475,18.4450726 C13.8244504,18.5957751 14.158044,18.5957751 14.428747,18.4450726 L26.2499899,11.6196917 L26.2499899,24.4689564 Z" id="Shape"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                  <a href="mailto:{{ trans('vars.Contacts.queriesPaymentShippingReturnsEmail') }}">{{ trans('vars.Contacts.labelEmail') }}: {{ trans('vars.Contacts.queriesPaymentShippingReturnsEmail') }}</a>
                </li>
              </ul>
              <p>
                  <a href="https://www.instagram.com" target="_blank" class="facebook">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#42261D" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
                  </a>
                  <a href="https://www.facebook.com" target="_blank" class="instagram">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="#42261D" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
                  </a>
              </p>
              <a href="#formcontact" class="contButt">{{ trans('vars.Contacts.sendUsMessage') }}</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bloc">
              <img src="/images/MD.png" alt="">
              <div class="country">
                {{ trans('vars.Contacts.countryMoldova') }}
              </div>
              <ul>
                <li>{{ trans('vars.Contacts.brandCompany') }}</li>
                <li>
                  <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" class="svg-inline--fa fa-map-marker-alt fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#42261D" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg>

                  {{ trans('vars.Contacts.labelWarehouseAddress') }}:
                </li>
                <li>
                  <svg width="21px" height="20px" viewBox="0 0 21 20" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                        <g id="Contact_APL-" transform="translate(-736.000000, -897.000000)" fill="#42261D" fillRule="nonzero">
                            <g id="Contact" transform="translate(266.000000, 450.000000)">
                                <g id="Contacts" transform="translate(470.000000, 86.000000)">
                                    <g id="Group-3" transform="translate(0.000000, 353.000000)">
                                        <g id="call" transform="translate(0.000000, 8.000000)">
                                            <path d="M19.3149185,13.1277083 C18.0292187,13.1277083 16.7668157,12.9361979 15.5705298,12.5596875 C14.9741094,12.3659896 14.2950565,12.5163021 13.905956,12.8939063 L11.5447199,14.5915104 C8.80635988,13.199375 7.11958302,11.5934375 5.67780553,9.00505208 L7.40784008,6.81484375 C7.85731548,6.38734375 8.01853381,5.76286458 7.82537806,5.17692708 C7.42834784,4.03161458 7.22666087,2.82989583 7.22666087,1.60489583 C7.22671556,0.719947917 6.47077221,0 5.54163401,0 L1.68502686,0 C0.755943344,0 0,0.719947917 0,1.60479167 C0,11.7480729 8.66455556,20 19.3149185,20 C20.2440567,20 21,19.2800521 21,18.3951562 L21,14.7325 C21,13.8476562 20.244002,13.1277083 19.3149185,13.1277083 Z M19.8332999,18.3952083 C19.8332999,18.6675521 19.6008786,18.8889062 19.3149185,18.8889062 C9.30767889,18.8889062 1.16670009,11.1355208 1.16670009,1.60484375 C1.16670009,1.3325 1.39912136,1.11114583 1.68508155,1.11114583 L5.54168869,1.11114583 C5.82764889,1.11114583 6.06007016,1.3325 6.06007016,1.60484375 C6.06007016,2.94869792 6.28166333,4.26760417 6.71517001,5.51708333 C6.77554486,5.7015625 6.72654498,5.8925 6.53060018,6.08677083 L4.52537884,8.61598958 C4.39095732,8.78578125 4.369848,9.013125 4.47069148,9.20244792 C6.10732003,12.2661458 8.09602579,14.1601562 11.3356502,15.7410937 C11.5327434,15.8392708 11.7742975,15.8186979 11.9531798,15.6901042 L14.6698837,13.7299479 C14.8071489,13.5992187 15.0128281,13.5525521 15.1985464,13.6127604 C16.5195742,14.0283333 17.9044221,14.2388542 19.3149185,14.2388542 C19.6008786,14.2388542 19.8332999,14.4602083 19.8332999,14.7325521 L19.8332999,18.3952083 Z" id="Shape"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                  </svg>
                  <a href="tel:+{{ trans('vars.Contacts.phoneNumber') }}">{{ trans('vars.Contacts.telViberWhatsapp') }}: +{{ trans('vars.Contacts.phoneNumber') }}</a>
                </li>
                <li>
                  <svg width="28px" height="27px" viewBox="0 0 28 27" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                            <g id="Contact_APL-" transform="translate(-736.000000, -1074.000000)" fill="#42261D" fillRule="nonzero">
                                <g id="email" transform="translate(736.000000, 1074.000000)">
                                    <path d="M27.641239,9.44299415 L23.6249914,6.60822531 L23.6249914,4.2206075 C23.6249914,3.75463182 23.2332651,3.3769263 22.749992,3.3769263 L19.0574942,3.3769263 L14.5162469,0.162500909 C14.2087393,-0.0541669698 13.7912552,-0.0541669698 13.4837475,0.162500909 L8.94250026,3.3769263 L5.25000248,3.3769263 C4.76672933,3.3769263 4.375003,3.75463182 4.375003,4.2206075 L4.375003,6.60822531 L0.35875542,9.44299415 C0.132622743,9.60229171 -0.00070530178,9.85634521 2.80643766e-06,10.1263759 L2.80643766e-06,24.4689564 C2.80643766e-06,25.8668307 1.1752393,27 2.62500406,27 L25.3749904,27 C26.8247551,27 27.9999916,25.8668307 27.9999916,24.4689564 L27.9999916,10.1263759 C28.0006997,9.85634521 27.867317,9.60229171 27.641239,9.44299415 Z M23.6249914,8.70055469 L25.5499903,10.0588814 L23.6249914,11.1641038 L23.6249914,8.70055469 Z M13.9999972,1.89204738 L16.099996,3.3769263 L11.8999985,3.3769263 L13.9999972,1.89204738 Z M6.12500195,5.0642887 L21.8749925,5.0642887 L21.8749925,12.1765213 L13.9999972,16.7323998 L6.12500195,12.1765213 L6.12500195,5.0642887 Z M4.375003,8.70055469 L4.375003,11.1725406 L2.45000416,10.0588814 L4.375003,8.70055469 Z M26.2499899,24.4689564 C26.2499899,24.9349321 25.8582635,25.3126376 25.3749904,25.3126376 L2.62500406,25.3126376 C2.14173091,25.3126376 1.75000458,24.9349321 1.75000458,24.4689564 L1.75000458,11.6196917 L13.5537475,18.4450726 C13.8244504,18.5957751 14.158044,18.5957751 14.428747,18.4450726 L26.2499899,11.6196917 L26.2499899,24.4689564 Z" id="Shape"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                  <a href="mailto:{{ trans('vars.Contacts.email') }}">{{ trans('vars.Contacts.labelEmail') }}: {{ trans('vars.Contacts.email') }}</a>
                </li>
              </ul>
              <p>
                  <a href="https://www.instagram.com" target="_blank" class="facebook">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#42261D" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
                  </a>
                  <a href="https://www.facebook.com" target="_blank" class="instagram">
                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="#42261D" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
                  </a>
              </p>
              <a href="#formcontact" class="contButt">{{ trans('vars.Contacts.sendUsMessage') }}</a>
            </div>
          </div>
        </div>
    </div>
    <section id="formcontact" class="formcontact">
        <div class="container">
            <div class="row">
                <div class="col-6 tabletNone">
                    <div class="imageContainer">
                        <img id="contact4" src="{{ Banner('Banner_Contacts_4', 'desktop') }}" alt="contact" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="workSchedule">
                      <p>
                        {{ trans('vars.Contacts.schedule') }}
                      </p>
                      <p>
                        {{ trans('vars.Contacts.scheduleInfoWeekdays') }}
                      </p>
                      <p>
                        {{ trans('vars.Contacts.scheduleInfoWeekEnds') }}
                      </p>
                    </div>
                    <form action="{{ url('/'.$lang->lang.'/homewear/contact-feed-back') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3>{{ trans('vars.Contacts.contactUs') }}</h3>
                        <p>{{ trans('vars.Contacts.fillTheForm') }}:</p>
                        <label>{{ trans('vars.FormFields.fieldFullName') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="text" name="name" required/>
                        <label>{{ trans('vars.FormFields.fieldphone') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input name="phone" type="number" required />
                        <label for="email">{{ trans('vars.FormFields.fieldEmail') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input name="email" type="email" required />
                        <label>{{ trans('vars.FormFields.contactPopupMessage') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <textarea rows="3" name="message" required></textarea>
                        <div class="g-recaptcha" data-sitekey="6LfjvbcZAAAAAJ8hY2IvGQqUmkgfaModXSOnNzJt"></div>
                        <button type="submit" class="butt">
                            <span>{{ trans('vars.FormFields.send') }} <b></b><b></b><b></b></span>
                        </button>
                    </form>
                </div>
                <div class="fonop"></div>
            </div>
        </div>
    </section>
</main>
@include('front.desktop.partials.footer')
@stop
