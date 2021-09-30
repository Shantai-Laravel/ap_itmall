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
    <section class="map-contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-5 col-12">
            <div class="hours-plan">
              <h5>{{ trans('vars.ContactsAndForms.graficLucruTitle') }}</h5>
              <p>{{ trans('vars.ContactsAndForms.graficLucruSubTitle') }}</p>
              <ul>
                <li><span>{{ trans('vars.ContactsAndForms.monday') }}</span><span>{{ trans('vars.ContactsAndForms.mondayFridayHours') }}</span></li>
                <li><span>{{ trans('vars.ContactsAndForms.tuesday') }}</span><span>{{ trans('vars.ContactsAndForms.mondayFridayHours') }}</span></li>
                <li><span>{{ trans('vars.ContactsAndForms.wednesday') }}</span><span>{{ trans('vars.ContactsAndForms.mondayFridayHours') }}</span></li>
                <li><span>{{ trans('vars.ContactsAndForms.thursday') }}</span><span>{{ trans('vars.ContactsAndForms.mondayFridayHours') }}</span></li>
                <li><span>{{ trans('vars.ContactsAndForms.friday') }}</span><span>{{ trans('vars.ContactsAndForms.mondayFridayHours') }}</span></li>
                <li><span>{{ trans('vars.ContactsAndForms.saturday') }}</span><span>{{ trans('vars.ContactsAndForms.saturdayHours') }}</span></li>
                <li><span>{{ trans('vars.ContactsAndForms.sunday') }}</span><span>{{ trans('vars.ContactsAndForms.closed') }}</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="mapouter">
      <div class="gmap_canvas">



        <iframe
          id="gmap_canvas"
          src="https://maps.google.com/maps?q=Moldova%2C%20Chisinau%2C%20str.%20Puskin%208&t=&z=13&ie=UTF8&iwloc=&output=embed"
          frameborder="0"
          scrolling="no"
          marginheight="0"
          marginwidth="0"
        ></iframe>
        <a href="https://www.embedgooglemap.net"></a>
      </div>
      <style>
        .mapouter {
          text-align: right;
          height: 100%;
          width: 100%;
        }
        .gmap_canvas {
          overflow: hidden;
          background: none !important;
          height: 100%;
          width: 100%;
        }
      </style>
    </div>
    </section>

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
                        {{ trans('vars.Contacts.shopContacts') }}
                      </p>
                      <p>
                        {{ trans('vars.Contacts.contactsLabelAddress') }} {{ trans('vars.Contacts.addressSiteShopMDAdress') }}
                      </p>
                      <p>
                        {{ trans('vars.Contacts.contactsLabelTel') }} {{ trans('vars.Contacts.addressSiteShopMDPhone') }}
                      </p>
                      <p>
                        {{ trans('vars.Contacts.contactsLabelEmail') }} {{ trans('vars.Contacts.addressSiteShopMDEmail1') }}
                      </p>
                      <p>
                        {{ trans('vars.Contacts.contactsLabelEmail') }} {{ trans('vars.Contacts.addressSiteShopMDEmail2') }}
                      </p>
                      <p>
                        {{-- {{ trans('vars.Contacts.scheduleInfoWeekEnds') }} --}}
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
