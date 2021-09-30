@extends('front.desktop.app')
@section('content')
@include('front.desktop.partials.header')
<main class="contactContent wholesale">
    <!-- <h3>{{ trans('vars.Contacts.contactUs') }}</h3> -->
    <div class="contactBanner">
      <img src="/images/pages/{{ $page->image }}" alt="">
      <div class="test">
        <div class="container">
          <div class="innerTest">
            <!-- <h3>wholesale</h3> -->
            <p></p>
          </div>
        </div>
      </div>
    </div>
    <h3>{{ trans('vars.Wholesale.wholesaleTitle') }}</h3>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-md-6">
                <p>
                    {{ trans('vars.Wholesale.wholesaleText1') }}
                </p>
                <p>
                    {{ trans('vars.Wholesale.wholesaleText2') }}
                </p>
                <p>
                    {{ trans('vars.Wholesale.wholesaleText3') }}
                </p>
            </div>
            <div class="col-md-6">
                <p>
                    {{ trans('vars.Wholesale.wholesaleText4') }}
                </p>
                <p>
                    {{ trans('vars.Wholesale.wholesaleText5') }}
                </p>
                <p>
                    {{ trans('vars.Wholesale.wholesaleText6') }}
                </p>
                <p>
                    <a href="mailto:byanapopova@gmail.com">{{ trans('vars.Wholesale.wholesaleText7') }}</a>
                </p>
            </div>
        </div>
    </div>

    <section class="_errors">
        <div class="col-12">
            @if ($errors->first('email'))
                <p class="alert alert-danger">{!! $errors->first('email') !!}</p>
            @endif
            @if ($errors->first('password'))
                <p class="alert alert-danger">{!! $errors->first('password') !!}</p>
            @endif
            @if ($errors->first('name'))
                <p class="alert alert-danger">{!! $errors->first('name') !!}</p>
            @endif
            @if ($errors->first('agree'))
                <p class="alert alert-danger">{!! $errors->first('agree') !!}</p>
            @endif
        </div>
    </section>

    <section id="formwholesale" class="formcontact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form action="{{ url('/'.$lang->lang.'/'.$site.'/auth-login/static/auth') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3>{{ trans('vars.Wholesale.wholesaleFormTitle1') }}</h3>
                        <label>{{ trans('vars.FormFields.fieldEmail') }}</label>
                        <input type="text" name="email" required/>
                        <label>{{ trans('vars.FormFields.pass') }}</label>
                        <input name="password" type="password" required />
                        <button type="submit" class="butt">
                            <span>{{ trans('vars.FormFields.send') }} <b></b><b></b><b></b></span>
                        </button>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12">
                    <form action="{{ url('/'.$lang->lang.'/'.$site.'/registration/static') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3>{{ trans('vars.Wholesale.wholesaleFormTitle2') }}</h3>

                        <label>{{ trans('vars.FormFields.fieldFullName') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="text" name="name" required/>

                        <label>{{ trans('vars.FormFields.fieldEmail') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="email" name="email" required/>

                        <div class="inputGroup">
                            <label for="name">{{ trans('vars.FormFields.fieldphone') }} ({{ trans('vars.FormFields.Required') }})</label>
                            <div class="phoneContainer">
                                <div class="telefonGroup">
                                    <div class="selectContainer">
                                        <select name="code">
                                            @foreach ($countries as $key => $countryItem)
                                                <option value="{{ $countryItem->phone_code }}" {{ $countryItem->phone_code == $country->phone_code ? 'selected' : '' }}>+{{ $countryItem->phone_code }}</option>
                                            @endforeach
                                        </select>
                                        <span>
                                            <svg width="10px" height="6px" viewBox="0 0 10 6" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                    <g id="Cos._APL---" transform="translate(-1592.000000, -545.000000)" fill="#42261D" fillRule="nonzero">
                                                        <g id="Order-summery" transform="translate(1233.000000, 423.000000)">
                                                            <g id="Ship" transform="translate(15.000000, 108.000000)">
                                                                <polygon id="Shape" transform="translate(349.000000, 17.000000) scale(1, -1) translate(-349.000000, -17.000000) " points="349 14 344 20 348.763602 20 354 20"></polygon>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <input type="number" name="phone" required/>
                            </div>
                        </div>

                        <label>{{ trans('vars.FormFields.company') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="text" name="company" required/>

                        <div class="inputGroup">
                            <label for="name">{{ trans('vars.FormFields.fieldCountry') }}</label>
                            <div class="selectContainer">
                                <select name="country">
                                    @foreach ($countries as $key => $oneCountry)
                                        <option value="{{ $oneCountry->translation->name }}" {{ $oneCountry->id == $country->id ? 'selected' : ''}}>{{ $oneCountry->translation->name }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    <svg width="10px" height="6px" viewBox="0 0 10 6" version="1.1" xmlns="http://www.w3.org/2000/svg"> <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd"> <g id="Cos._APL---" transform="translate(-1592.000000, -545.000000)" fill="#42261D" fillRule="nonzero"> <g id="Order-summery" transform="translate(1233.000000, 423.000000)"> <g id="Ship" transform="translate(15.000000, 108.000000)"> <polygon id="Shape" transform="translate(349.000000, 17.000000) scale(1, -1) translate(-349.000000, -17.000000) " points="349 14 344 20 348.763602 20 354 20"></polygon> </g> </g> </g> </g> </svg>
                                </span>
                            </div>
                        </div>

                        <label>{{ trans('vars.FormFields.fieldCity') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="text" name="city" required/>

                        <label>{{ trans('vars.FormFields.fieldStreet') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="text" name="street" required/>

                        <label>{{ trans('vars.FormFields.fieldFullApartment') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="text" name="apartment" required/>

                        <label>{{ trans('vars.FormFields.contactPerson') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="text" name="contact_person" required/>

                        <label>{{ trans('vars.FormFields.pass') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="password" name="password" required/>

                        <label>{{ trans('vars.FormFields.passRepeat') }} ({{ trans('vars.FormFields.Required') }})</label>
                        <input type="password" name="password-repeat" required/>

                        <input type="hidden" name="consumerType" value="diller">


                        <label class="checkContainer">
                            <input type="checkbox" name="agree"/>{{ trans('vars.FormFields.termsUserAgreementPersonalData3') }}
                            <a href="{{ url('/'.$lang->lang.'/'.$site.'/terms') }}" target="_blank"> {{ trans('vars.PagesNames.pageNameTermsConditions') }}</a>
                            <span class="check"></span>
                        </label>

                        <button type="submit" class="butt">
                            <span>{{ trans('vars.FormFields.send') }} <b></b><b></b><b></b></span>
                        </button>
                    </form>
                </div>
                <div class="fonop"></div>
            </div>
        </div>
    </section>
    <style>
        ._errors{
            position: fixed;
            z-index: 999;
            left: 50%;
            top: 50%;
            width: 400px;
            margin-left: -200px;
        }
    </style>
</main>


@include('front.desktop.partials.footer')
@stop
