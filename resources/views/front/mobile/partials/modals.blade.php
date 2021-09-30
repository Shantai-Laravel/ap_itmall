<div class="modals">
    @if (!Auth::guard('persons')->user())
    <div class="modal" id="auth">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modalContent">
                    <div class="closeModal" data-dismiss="modal">
                        <img src="/fronts/img/icons/plusIconBlack.svg" alt="" />
                    </div>
                    @if (!is_null($unloggedUser))
                    <auth-mob guest="{{ json_encode($unloggedUser) }}" site="{{ $site }}"></auth-mob>
                    @else
                    <auth-mob guest="{{ null }}" site="{{ $site }}"></auth-mob>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Forget Password modal --}}
    <div class="modal fade" id="forgetPassword">
        <div class="modal-dialog">
            <div class="modal-content">
                <reset-password-mob></reset-password-mob>
            </div>
        </div>
    </div>
    @endif
    <div class="modal" id="userSettings">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="modalContent" action="{{ url('/'.$lang->lang.'/set-user-settings') }}" method="post">
                    {{ csrf_field() }}
                    <div class="closeModal" data-dismiss="modal">
                        <img src="/fronts/img/icons/plusIconBlack.svg" alt="" />
                    </div>
                    <div class="modalTitle">
                        {{ trans('vars.FormFields.settings') }}
                    </div>
                    <div class="modalBody">
                        <div class="inputGroup">
                            <label for="country">{{ trans('vars.FormFields.shipTo') }}</label>
                            <div class="selectContainer">
                                <select name="country_id">
                                @foreach ($countries as $key => $oneCountry)
                                    @if (@$_COOKIE['country_id'] == 140)
                                        @if ($oneCountry->id == 140)
                                            <option value="{{ $oneCountry->id }}" {{ $oneCountry->id == $country->id ? 'selected' : ''}}>{{ $oneCountry->translation->name }}</option>
                                        @endif
                                    @else
                                        @if ($oneCountry->id != 140)
                                            <option value="{{ $oneCountry->id }}" {{ $oneCountry->id == $country->id ? 'selected' : ''}}>{{ $oneCountry->translation->name }}</option>
                                        @endif
                                    @endif
                                    {{-- <option value="{{ $oneCountry->id }}" {{ $oneCountry->id == $country->id ? 'selected' : ''}}>{{ $oneCountry->translation->name }}</option> --}}
                                @endforeach
                                </select>
                                <span>
                                    <svg
                                        width="10px"
                                        height="6px"
                                        viewBox="0 0 10 6"
                                        version="1.1"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                            <g
                                                id="Cos._APL---"
                                                transform="translate(-1592.000000, -545.000000)"
                                                fill="#42261D"
                                                fillRule="nonzero"
                                                >
                                                <g id="Order-summery" transform="translate(1233.000000, 423.000000)">
                                                    <g id="Ship" transform="translate(15.000000, 108.000000)">
                                                        <polygon
                                                            id="Shape"
                                                            transform="translate(349.000000, 17.000000) scale(1, -1) translate(-349.000000, -17.000000) "
                                                            points="349 14 344 20 348.763602 20 354 20"
                                                            ></polygon>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="inputGroup">
                            <label for="languege">{{ trans('vars.FormFields.language') }}</label>
                            <div class="selectContainer">
                                <select name="lang_id">
                                    @foreach ($langs as $key => $language)
                                        <option value="{{ $language->id }}" {{ $lang->id == $language->id ? 'selected' : '' }}>{{ $language->description }}</option>
                                    @endforeach
                                </select>
                                <span>
                                    <svg
                                        width="10px"
                                        height="6px"
                                        viewBox="0 0 10 6"
                                        version="1.1"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                            <g
                                                id="Cos._APL---"
                                                transform="translate(-1592.000000, -545.000000)"
                                                fill="#42261D"
                                                fillRule="nonzero"
                                                >
                                                <g id="Order-summery" transform="translate(1233.000000, 423.000000)">
                                                    <g id="Ship" transform="translate(15.000000, 108.000000)">
                                                        <polygon
                                                            id="Shape"
                                                            transform="translate(349.000000, 17.000000) scale(1, -1) translate(-349.000000, -17.000000) "
                                                            points="349 14 344 20 348.763602 20 354 20"
                                                            ></polygon>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="inputGroup">
                            <label for="currency">{{ trans('vars.FormFields.currency') }}</label>
                            <div class="selectContainer">
                                <select name="currency_id">
                                {{-- @foreach ($currencies as $key => $oneCurrency)
                                    <option value="{{ $oneCurrency->id }}"  {{ $oneCurrency->id == $currency->id ? 'selected' : ''}}>{{ $oneCurrency->abbr }}</option>
                                @endforeach --}}
                                @foreach ($currencies as $key => $oneCurrency)
                                    @if ($country->iso != "MD")
                                        @if ($oneCurrency->abbr != 'MDL')
                                            <option value="{{ $oneCurrency->id }}" {{ $oneCurrency->id == $currency->id ? 'selected' : ''}}>{{ $oneCurrency->abbr }}</option>
                                        @endif
                                    @else
                                        {{-- @if ($oneCurrency->abbr == 'MDL') --}}
                                            <option value="{{ $oneCurrency->id }}" {{ $oneCurrency->id == $currency->id ? 'selected' : ''}}>{{ $oneCurrency->abbr }}</option>
                                        {{-- @endif --}}
                                    @endif
                                @endforeach
                                </select>
                                <span>
                                    <svg
                                        width="10px"
                                        height="6px"
                                        viewBox="0 0 10 6"
                                        version="1.1"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <g id="AnaPopova-Site" stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                            <g
                                                id="Cos._APL---"
                                                transform="translate(-1592.000000, -545.000000)"
                                                fill="#42261D"
                                                fillRule="nonzero"
                                                >
                                                <g id="Order-summery" transform="translate(1233.000000, 423.000000)">
                                                    <g id="Ship" transform="translate(15.000000, 108.000000)">
                                                        <polygon
                                                            id="Shape"
                                                            transform="translate(349.000000, 17.000000) scale(1, -1) translate(-349.000000, -17.000000) "
                                                            points="349 14 344 20 348.763602 20 354 20"
                                                            ></polygon>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <input type="submit" value="{{ trans('vars.FormFields.save') }}"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSize">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modalContent">
                    <div class="closeModal" data-dismiss="modal">
                        <img src="/fronts/img/icons/plusIconBlack.svg" alt="" />
                    </div>
                    <div class="closeModal" data-dismiss="modal"></div>
                    <div class="modalTitle">
                        <span>Size Guide</span>
                    </div>
                    <div class="modalBody">
                        <div class="col-12 editorPage">
                            @php $page = getPage('size-guide', $lang->id); @endphp
                            @if (!is_null($page))
                                {!! $page->body !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="shipping">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modalContent">
                    <div class="closeModal" data-dismiss="modal">
                        <img src="/fronts/img/icons/plusIconBlack.svg" alt="" />
                    </div>
                    <div class="closeModal" data-dismiss="modal"></div>
                    <div class="modalTitle"></div>
                    <div class="modalBody">
                        <div class="col-12 editorPage">
                            @php $page = getPage('livrare-achitare-retur', $lang->id); @endphp
                            @if (!is_null($page))
                                {!! $page->body !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="addToCartModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modalContent">
                    <div class="closeModal" data-dismiss="modal">
                        <img src="/fronts/img/icons/plusIconBlack.svg" alt="" />
                    </div>
                    <div class="closeModal" data-dismiss="modal"></div>
                    <div class="col-md-12">
                        <p class="text-center text-danger">
                            {{ trans('vars.Cart.cartnewItemAdded') }}
                        </p>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center flex-column">
                        <a href="#" class="butt onSubmit"data-dismiss="modal">{{ trans('vars.Cart.continueShopping') }}</a>
                        <a :href="'/' + this.$lang + '/cart'" class="butt onSubmit">{{ trans('vars.Cart.cartView') }}</a>
                    </div>
                </div>
            </div>
        </div>

        @if (Session::has('success'))
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                 <div class="modalContent">
                     <div class="closeModal" data-dismiss="modal">
                         <img src="/fronts/img/icons/plusIconBlack.svg" alt="" />
                     </div>
                     <div class="closeModal" data-dismiss="modal"></div>
                       <div class="modalTitle">
                       </div>
                       <div class="modalBody">
                           <div class="col-12 editorPage">
                              <p>{{ trans('vars.Wholesale.wholesalePopupRegMessage') }}</p>
                           </div>
                       </div>
                 </div>
                </div>
            </div>
        </div>
        @endif

        @if (Session::has('contacts-success'))
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                 <div class="modalContent">
                     <div class="closeModal" data-dismiss="modal">
                         <img src="/fronts/img/icons/plusIconBlack.svg" alt="" />
                     </div>
                     <div class="closeModal" data-dismiss="modal"></div>
                       <div class="modalTitle">
                       </div>
                       <div class="modalBody">
                           <div class="col-12 editorPage">
                              <p>{{ trans('vars.Contacts.ContactsFormCompletedMessage') }}</p>
                           </div>
                       </div>
                 </div>
                </div>
            </div>
        </div>
        @endif
</div>
