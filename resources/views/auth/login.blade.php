@php
    $queryString = $_SERVER['QUERY_STRING'];
@endphp
@extends('layouts.frontend.app')
@section('content')
<style>
    .checkout-confirm-btn{
        display: flex;
        float: right;
    }
    .checkout-confirm-btn .btn{
        margin-left: 10px;
    }
    @media (max-width: 575.98px){
        .checkout-confirm-btn{
            display: block;
            float: center;
            width: 100%;
        }
        .checkout-confirm-btn .btn{
            width: 100%;
            margin-left: 0px;
        }
    }
</style>
    <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('home') }}"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span
                        class="mdi mdi-chevron-right"></span> <a href="#">Login/Register</a>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout-page section-padding">
        <div class="container">
            <div class="row justify-content-center">
                @if ($queryString == 'register')
                    <div class="col-xl-5 col-lg-6 col-md-8">
                        <div class="card animated-button1">

                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>

                            <div class="card-body">
                                <div class="login-form pt-3">
                                    <form action="{{ route('checkout.register.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="login-form">

                                            <div class="form-group border-bottom">
                                                <h4 class="text-center">Register Now!</h4>
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Enter Your Full Name <strong class="text-danger">*</strong></label>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="John Doe" value="{{ old('name') }}">

                                                @error('name')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Enter Username <strong class="text-danger">*</strong></label>
                                                <input type="username" name="username"  id="username" class="form-control @error('username') is-invalid @enderror" placeholder="johndoe" value="{{ old('username') }}">
                                                <div class="usernameError"></div>

                                                @error('username')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Enter Email <strong class="text-danger">*</strong></label>
                                                <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@mail.com" value="{{ old('email') }}">

                                                @error('email')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>

                                            {{-- <div class="form-group">
                                                <label>Select Country</label>
                                                <select class="form-control" name="country" id="country" required>
                                                    <option selected="selected">Select Country</option>
                                                    <option country="Albania" value="AL">Albania</option>
                                                    <option country="Algeria" value="DZ">Algeria</option>
                                                    <option country="American Samoa" value="AS">American Samoa
                                                    </option>
                                                    <option country="Andorra" value="AD">Andorra</option>
                                                    <option country="Angola" value="AO">Angola</option>
                                                    <option country="Anguilla" value="AI">Anguilla</option>
                                                    <option country="Antarctica" value="AQ">Antarctica</option>
                                                    <option country="Antigua and Barbuda" value="AG">Antigua and
                                                        Barbuda</option>
                                                    <option country="Argentina" value="AR">Argentina</option>
                                                    <option country="Armenia" value="AM">Armenia</option>
                                                    <option country="Aruba" value="AW">Aruba</option>
                                                    <option country="Australia" value="AU">Australia</option>
                                                    <option country="Austria" value="AT">Austria</option>
                                                    <option country="Azerbaijan" value="AZ">Azerbaijan</option>
                                                    <option country="Bahamas" value="BS">Bahamas</option>
                                                    <option country="Bahrain" value="BH">Bahrain</option>
                                                    <option country="Bangladesh" value="BD">Bangladesh</option>
                                                    <option country="Barbados" value="BB">Barbados</option>
                                                    <option country="Belarus" value="BY">Belarus</option>
                                                    <option country="Belgium" value="BE">Belgium</option>
                                                    <option country="Belize" value="BZ">Belize</option>
                                                    <option country="Benin" value="BJ">Benin</option>
                                                    <option country="Bermuda" value="BM">Bermuda</option>
                                                    <option country="Bhutan" value="BT">Bhutan</option>
                                                    <option country="Bolivia" value="BO">Bolivia</option>
                                                    <option country="Bosnia and Herzegowina" value="BA">Bosnia and
                                                        Herzegowina</option>
                                                    <option country="Botswana" value="BW">Botswana</option>
                                                    <option country="Bouvet Island" value="BV">Bouvet Island</option>
                                                    <option country="Brazil" value="BR">Brazil</option>
                                                    <option country="British Indian Ocean Territory" value="IO">
                                                        British Indian Ocean Territory</option>
                                                    <option country="Brunei Darussalam" value="BN">Brunei Darussalam
                                                    </option>
                                                    <option country="Bulgaria" value="BG">Bulgaria</option>
                                                    <option country="Burkina Faso" value="BF">Burkina Faso</option>
                                                    <option country="Burundi" value="BI">Burundi</option>
                                                    <option country="Cambodia" value="KH">Cambodia</option>
                                                    <option country="Cameroon" value="CM">Cameroon</option>
                                                    <option country="Canada" value="CA">Canada</option>
                                                    <option country="Cape Verde" value="CV">Cape Verde</option>
                                                    <option country="Cayman Islands" value="KY">Cayman Islands
                                                    </option>
                                                    <option country="Central African Republic" value="CF">Central
                                                        African Republic</option>
                                                    <option country="Chad" value="TD">Chad</option>
                                                    <option country="Chile" value="CL">Chile</option>
                                                    <option country="China" value="CN">China</option>
                                                    <option country="Christmas Island" value="CX">Christmas Island
                                                    </option>
                                                    <option country="Cocos (Keeling) Islands" value="CC">Cocos
                                                        (Keeling) Islands</option>
                                                    <option country="Colombia" value="CO">Colombia</option>
                                                    <option country="Comoros" value="KM">Comoros</option>
                                                    <option country="Congo" value="CG">Congo</option>
                                                    <option country="Congo, the Democratic Republic of the" value="CD">Congo, the
                                                        Democratic Republic of the</option>
                                                    <option country="Cook Islands" value="CK">Cook Islands</option>
                                                    <option country="Costa Rica" value="CR">Costa Rica</option>
                                                    <option country="Cote d'Ivoire" value="CI">Cote d'Ivoire</option>
                                                    <option country="Croatia (Hrvatska)" value="HR">Croatia
                                                        (Hrvatska)</option>
                                                    <option country="Cuba" value="CU">Cuba</option>
                                                    <option country="Cyprus" value="CY">Cyprus</option>
                                                    <option country="Czech Republic" value="CZ">Czech Republic
                                                    </option>
                                                    <option country="Denmark" value="DK">Denmark</option>
                                                    <option country="Djibouti" value="DJ">Djibouti</option>
                                                    <option country="Dominica" value="DM">Dominica</option>
                                                    <option country="Dominican Republic" value="DO">Dominican
                                                        Republic</option>
                                                    <option country="East Timor" value="TP">East Timor</option>
                                                    <option country="Ecuador" value="EC">Ecuador</option>
                                                    <option country="Egypt" value="EG">Egypt</option>
                                                    <option country="El Salvador" value="SV">El Salvador</option>
                                                    <option country="Equatorial Guinea" value="GQ">Equatorial Guinea
                                                    </option>
                                                    <option country="Eritrea" value="ER">Eritrea</option>
                                                    <option country="Estonia" value="EE">Estonia</option>
                                                    <option country="Ethiopia" value="ET">Ethiopia</option>
                                                    <option country="Falkland Islands (Malvinas)" value="FK">Falkland
                                                        Islands (Malvinas)</option>
                                                    <option country="Faroe Islands" value="FO">Faroe Islands</option>
                                                    <option country="Fiji" value="FJ">Fiji</option>
                                                    <option country="Finland" value="FI">Finland</option>
                                                    <option country="France" value="FR">France</option>
                                                    <option country="rance, Metropolitan" value="FX">France,
                                                        Metropolitan</option>
                                                    <option country="French Guiana" value="GF">French Guiana</option>
                                                    <option country="French Polynesia" value="PF">French Polynesia
                                                    </option>
                                                    <option country="French Southern Territories" value="TF">French
                                                        Southern Territories</option>
                                                    <option country="Gabon" value="GA">Gabon</option>
                                                    <option country="Gambia" value="GM">Gambia</option>
                                                    <option country="Georgia" value="GE">Georgia</option>
                                                    <option country="Germany" value="DE">Germany</option>
                                                    <option country="Ghana" value="GH">Ghana</option>
                                                    <option country="Gibraltar" value="GI">Gibraltar</option>
                                                    <option country="Greece" value="GR">Greece</option>
                                                    <option country="Greenland" value="GL">Greenland</option>
                                                    <option country="Grenada" value="GD">Grenada</option>
                                                    <option country="Guadeloupe" value="GP">Guadeloupe</option>
                                                    <option country="Guam" value="GU">Guam</option>
                                                    <option country="Guatemala" value="GT">Guatemala</option>
                                                    <option country="Guinea" value="GN">Guinea</option>
                                                    <option country="Guinea-Bissau" value="GW">Guinea-Bissau</option>
                                                    <option country="Guyana" value="GY">Guyana</option>
                                                    <option country="Haiti" value="HT">Haiti</option>
                                                    <option country="Heard and Mc Donald Islands" value="HM">Heard
                                                        and Mc Donald Islands</option>
                                                    <option country="Holy See (Vatican City State)" value="VA">Holy
                                                        See (Vatican City State)</option>
                                                    <option country="Honduras" value="HN">Honduras</option>
                                                    <option country="Hong Kong" value="HK">Hong Kong</option>
                                                    <option country="Hungary" value="HU">Hungary</option>
                                                    <option country="Iceland" value="IS">Iceland</option>
                                                    <option country="India" value="IN">India</option>
                                                    <option country="Indonesia" value="ID">Indonesia</option>
                                                    <option country="Iran (Islamic Republic of)" value="IR">Iran
                                                        (Islamic Republic of)</option>
                                                    <option country="Iraq" value="IQ">Iraq</option>
                                                    <option country="Ireland" value="IE">Ireland</option>
                                                    <option country="Israel" value="IL">Israel</option>
                                                    <option country="Italy" value="IT">Italy</option>
                                                    <option country="Jamaica" value="JM">Jamaica</option>
                                                    <option country="Japan" value="JP">Japan</option>
                                                    <option country="Jordan" value="JO">Jordan</option>
                                                    <option country="Kazakhstan" value="KZ">Kazakhstan</option>
                                                    <option country="KenyaKenya" value="KE">Kenya</option>
                                                    <option country="Kiribati" value="KI">Kiribati</option>
                                                    <option country="Korea, Democratic People's Republic of" value="KP">Korea,
                                                        Democratic People's Republic of</option>
                                                    <option country="Korea, Republic of" value="KR">Korea, Republic
                                                        of</option>
                                                    <option country="Kuwait" value="KW">Kuwait</option>
                                                    <option country="Kyrgyzstan" value="KG">Kyrgyzstan</option>
                                                    <option country="Lao People's Democratic Republic" value="LA">Lao
                                                        People's Democratic Republic</option>
                                                    <option country="Latvia" value="LV">Latvia</option>
                                                    <option country="Lebanon" value="LB">Lebanon</option>
                                                    <option country="Lesotho" value="LS">Lesotho</option>
                                                    <option country="Liberia" value="LR">Liberia</option>
                                                    <option country="Libyan Arab Jamahiriya" value="LY">Libyan Arab
                                                        Jamahiriya</option>
                                                    <option country="Liechtenstein" value="LI">Liechtenstein</option>
                                                    <option country="Lithuania" value="LT">Lithuania</option>
                                                    <option country="Luxembourg" value="LU">Luxembourg</option>
                                                    <option country="Macau" value="MO">Macau</option>
                                                    <option country="North Macedonia" value="MK">North Macedonia
                                                    </option>
                                                    <option country="Madagascar" value="MG">Madagascar</option>
                                                    <option country="Malawi" value="MW">Malawi</option>
                                                    <option country="Malaysia" value="MY">Malaysia</option>
                                                    <option country="Maldives" value="MV">Maldives</option>
                                                    <option country="Mali" value="ML">Mali</option>
                                                    <option country="Malta" value="MT">Malta</option>
                                                    <option country="Marshall Islands" value="MH">Marshall Islands
                                                    </option>
                                                    <option country="Martinique" value="MQ">Martinique</option>
                                                    <option country="Mauritania" value="MR">Mauritania</option>
                                                    <option country="Mauritius" value="MU">Mauritius</option>
                                                    <option country="Mayotte" value="YT">Mayotte</option>
                                                    <option country="Mexico" value="MX">Mexico</option>
                                                    <option country="Micronesia, Federated States of" value="FM">
                                                        Micronesia, Federated States of</option>
                                                    <option country="Moldova, Republic of" value="MD">Moldova,
                                                        Republic of</option>
                                                    <option country="Monaco" value="MC">Monaco</option>
                                                    <option country="Mongolia" value="MN">Mongolia</option>
                                                    <option country="Montserrat" value="MS">Montserrat</option>
                                                    <option country="Morocco" value="MA">Morocco</option>
                                                    <option country="Myanmar" value="MM">Myanmar</option>
                                                    <option country="Namibia" value="NA">Namibia</option>
                                                    <option country="Nauru" value="NR">Nauru</option>
                                                    <option country="Nepal" value="NP">Nepal</option>
                                                    <option country="Netherlands" value="NL">Netherlands</option>
                                                    <option country="Netherlands Antilles" value="AN">Netherlands
                                                        Antilles</option>
                                                    <option country="New Caledonia" value="NC">New Caledonia</option>
                                                    <option country="New Zealand" value="NZ">New Zealand</option>
                                                    <option country="Nicaragua" value="NI">Nicaragua</option>
                                                    <option country="Niger" value="NE">Niger</option>
                                                    <option country="Nigeria" value="NG">Nigeria</option>
                                                    <option country="Niue" value="NU">Niue</option>
                                                    <option country="Norfolk Island" value="NF">Norfolk Island
                                                    </option>
                                                    <option country="Northern Mariana Islands" value="MP">Northern
                                                        Mariana Islands</option>
                                                    <option country="Norway" value="NO">Norway</option>
                                                    <option country="Oman" value="OM">Oman</option>
                                                    <option country="Pakistan" value="PK">Pakistan</option>
                                                    <option country="Palau" value="PW">Palau</option>
                                                    <option country="Panama" value="PA">Panama</option>
                                                    <option country="Papua New Guinea" value="PG">Papua New Guinea
                                                    </option>
                                                    <option country="Paraguay" value="PY">Paraguay</option>
                                                    <option country="Peru" value="PE">Peru</option>
                                                    <option country="Philippines" value="PH">Philippines</option>
                                                    <option country="Pitcairn" value="PN">Pitcairn</option>
                                                    <option country="Poland" value="PL">Poland</option>
                                                    <option country="Portugal" value="PT">Portugal</option>
                                                    <option country="Puerto Rico" value="PR">Puerto Rico</option>
                                                    <option country="Qatar" value="QA">Qatar</option>
                                                    <option country="Reunion" value="RE">Reunion</option>
                                                    <option country="RomaniaRomania" value="RO">Romania</option>
                                                    <option country="Russian Federation" value="RU">Russian
                                                        Federation</option>
                                                    <option country="Rwanda" value="RW">Rwanda</option>
                                                    <option country="Saint Kitts and Nevis" value="KN">Saint Kitts
                                                        and Nevis</option>
                                                    <option country="Saint LUCIA" value="LC">Saint LUCIA</option>
                                                    <option country="Saint Vincent and the Grenadines" value="VC">
                                                        Saint Vincent and the Grenadines</option>
                                                    <option country="Samoa" value="WS">Samoa</option>
                                                    <option country="San Marino<" value="SM">San Marino</option>
                                                    <option country="Sao Tome and Principe" value="ST">Sao Tome and
                                                        Principe</option>
                                                    <option country="Saudi Arabia" value="SA">Saudi Arabia</option>
                                                    <option country="Senegal" value="SN">Senegal</option>
                                                    <option country="Seychelles" value="SC">Seychelles</option>
                                                    <option country="Sierra Leone" value="SL">Sierra Leone</option>
                                                    <option country="Singapore" value="SG">Singapore</option>
                                                    <option country="Slovakia (Slovak Republic)" value="SK">Slovakia
                                                        (Slovak Republic)</option>
                                                    <option country="Slovenia" value="SI">Slovenia</option>
                                                    <option country="Solomon Islands" value="SB">Solomon Islands
                                                    </option>
                                                    <option country="Somalia" value="SO">Somalia</option>
                                                    <option country="South Africa" value="ZA">South Africa</option>
                                                    <option country="South Georgia and the South Sandwich Islands" value="GS">South
                                                        Georgia and the South Sandwich Islands</option>
                                                    <option country="Spain" value="ES">Spain</option>
                                                    <option country="Sri Lanka" value="LK">Sri Lanka</option>
                                                    <option country="St. Helena" value="SH">St. Helena</option>
                                                    <option country="St. Pierre and Miquelon" value="PM">St. Pierre
                                                        and Miquelon</option>
                                                    <option country="Sudan" value="SD">Sudan</option>
                                                    <option country="Suriname" value="SR">Suriname</option>
                                                    <option country="Svalbard and Jan Mayen Islands" value="SJ">
                                                        Svalbard and Jan Mayen Islands</option>
                                                    <option country="Swaziland" value="SZ">Swaziland</option>
                                                    <option country="Sweden" value="SE">Sweden</option>
                                                    <option country="Switzerland" value="CH">Switzerland</option>
                                                    <option country="Syrian Arab Republic" value="SY">Syrian Arab
                                                        Republic</option>
                                                    <option country="Taiwan, Province of China" value="TW">Taiwan,
                                                        Province of China</option>
                                                    <option country="Tajikistan" value="TJ">Tajikistan</option>
                                                    <option country="Tanzania, United Republic of" value="TZ">
                                                        Tanzania, United Republic of</option>
                                                    <option country="Thailand" value="TH">Thailand</option>
                                                    <option country="Togo" value="TG">Togo</option>
                                                    <option country="Tokelau" value="TK">Tokelau</option>
                                                    <option country="Tonga" value="TO">Tonga</option>
                                                    <option country="Trinidad and Tobago" value="TT">Trinidad and
                                                        Tobago</option>
                                                    <option country="Tunisia" value="TN">Tunisia</option>
                                                    <option country="Turkey" value="TR">Turkey</option>
                                                    <option country="Turkmenistan" value="TM">Turkmenistan</option>
                                                    <option country="Turks and Caicos Islands" value="TC">Turks and
                                                        Caicos Islands</option>
                                                    <option country="Tuvalu" value="TV">Tuvalu</option>
                                                    <option country="Uganda" value="UG">Uganda</option>
                                                    <option country="Ukraine" value="UA">Ukraine</option>
                                                    <option country="United Arab Emirates" value="AE">United Arab
                                                        Emirates</option>
                                                    <option country="United Kingdom" value="GB">United Kingdom
                                                    </option>
                                                    <option country="United States" value="US">United States</option>
                                                    <option country="United States Minor Outlying Islands" value="UM">United States
                                                        Minor Outlying Islands</option>
                                                    <option country="Uruguay" value="UY">Uruguay</option>
                                                    <option country="Uzbekistan" value="UZ">Uzbekistan</option>
                                                    <option country="Vanuatu" value="VU">Vanuatu</option>
                                                    <option country="Venezuela" value="VE">Venezuela</option>
                                                    <option country="Viet Nam" value="VN">Viet Nam</option>
                                                    <option country="Virgin Islands (British)" value="VG">Virgin
                                                        Islands (British)</option>
                                                    <option country="Virgin Islands (U.S.)" value="VI">Virgin Islands
                                                        (U.S.)</option>
                                                    <option country="Wallis and Futuna Islands" value="WF">Wallis and
                                                        Futuna Islands</option>
                                                    <option country="Western Sahara" value="EH">Western Sahara
                                                    </option>
                                                    <option country="Yemen" value="YE">Yemen</option>
                                                    <option country="Yugoslavia" value="YU">Yugoslavia</option>
                                                    <option country="Zambia" value="ZM">Zambia</option>
                                                    <option country="Zimbabwe" value="ZW">Zimbabwe</option>
                                                </select>
                                            </div> --}}

                                            <div class="form-group">
                                                <label for="phone">Enter Phone Number <strong class="text-danger">*</strong></label>
                                                <input type="number" name="phone"  id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="01XXXXXXXXX" value="{{ old('phone') }}">

                                                @error('phone')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="refer">Enter Refer Username <strong class="text-danger">*</strong></label>
                                                <input type="text" name="refer" id="refer" class="form-control @error('refer') is-invalid @enderror" placeholder="Referral Username" value="{{ old('refer') }}">
                                                <i id="verify" class="fas fa-check refer_verify d-none"></i>
                                                <div class="referError"></div>

                                                @error('refer')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="agent">Enter Agent Username <strong class="text-danger">*</strong></label>
                                                <input type="text" name="agent" id="agent" class="form-control @error('agent') is-invalid @enderror" placeholder="Agent username" value="{{ old('agent') }}">
                                                <i id="verify" class="fas fa-check agent_verify d-none"></i>
                                                <div class="agentError"></div>

                                                @error('agent')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Enter Password <strong class="text-danger">*</strong></label>
                                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" >
                                                <p class="password-show-btn" id="password-show"><i id="password-show-icon" class="fas fa-eye"></i></p>

                                                @error('password')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="con_password">Enter Confirm Password <strong class="text-danger">*</strong></label>
                                                <input type="password" name="password_confirmation" id="con_password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="********" >
                                                <p class="password-show-btn" id="con-password-show"><i id="con-password-show-icon" class="fas fa-eye"></i></p>

                                                <div class="con_passwordError"></div>

                                                @error('password_confirmation')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="agree" required>
                                                <label class="custom-control-label text-dark" for="agree">I Agree with <a href="#">Term and Conditions</a></label>
                                            </div>

                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-lg btn-secondary btn-block" style="font-weight: 600; font-size: 17px;">Create Account</button>
                                            </div>
                                            <div class="form-group mt-3 text-center">
                                                <label for="">Already have an account? <a href="{{ route('login') }}" class="text-success">Login Now</a></label>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="card animated-button1">

                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>

                            <div class="card-body">
                                <div class="login-form pt-3">
                                    <form autocomplete="off" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="login-form">
                                            <div class="form-group text-center">
                                                <img src="{{ asset('uploads/system/').'/'.companyInfo()->admin_logo }}" alt="{{ companyInfo()->meta_title }}" style="width: 130px; height: 130px; border-radius: 50%; border: 1px solid #427939; padding: 2px;">
                                            </div>

                                            <div class="form-group border-bottom">
                                                <h4 class="text-center">Welcome Back!</h4>
                                            </div>

                                            @error('username')
                                                <div class="alert alert-danger w-100 text-center " style="background-color: #e92e401f; border-color: #e92e401f; color: #ff000f;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            @error('password')
                                                <div class="alert alert-danger w-100 text-center " style="background-color: #e92e401f; border-color: #e92e401f; color: #ff000f;">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="username">Enter Username <strong class="text-danger">*</strong></label>
                                                <input type="text" class="form-control" id="username" type="text" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" placeholder="Enter Username">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Enter Password <strong class="text-danger">*</strong></label>
                                                <input type="password" class="form-control" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter Password">

                                                <p class="password-show-btn" id="password-show"><i id="password-show-icon" class="fas fa-eye"></i></p>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="remember" value="remember" name="remember">
                                                <label class="custom-control-label text-dark" for="remember">Remember me</label>
                                            </div>

                                            <div class="form-group mt-3">
                                                <button type="submit" class="btn btn-lg btn-secondary btn-block" style="font-weight: 600; font-size: 17px;">Login Now</button>
                                            </div>
                                            <div class="form-group mt-3 text-center">
                                                <label for="">You don't have any account? <a href="{{ route('login') }}?register" class="text-success">Create Account</a></label>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @include('frontend.module.guarantee')
@endsection

@push('js')
    @if ($queryString == 'register')
        <script>
            $("#password-show").on("click", function() {
                var passwordField = $("#password");
                var passwordIcon = $("#password-show-icon");

                if (passwordField.attr("type") === "password") {
                    passwordField.attr("type", "text");
                    passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
                }
                else {
                    passwordField.attr("type", "password");
                    passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
            $("#con-password-show").on("click", function() {
                var passwordField = $("#con_password");
                var passwordIcon = $("#con-password-show-icon");

                if (passwordField.attr("type") === "password") {
                    passwordField.attr("type", "text");
                    passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
                }
                else {
                    passwordField.attr("type", "password");
                    passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });

            $('#username').keyup(function(){
                let username =$(this).val();

                var regex = /^[a-zA-Z0-9]+$/;

                if(username != ''){
                    if (regex.test(username)) {
                        url = "{{ route('ajax.username.check', ':username') }}";
                        url = url.replace(':username', username);

                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {
                                let html = '';
                                if(data === 'no'){
                                    html = '<strong style="font-size: 16px; font-weight: 500;" class="text-success">Username is available </strong>';
                                    $('#username').removeClass('is-invalid');
                                }
                                else{
                                    html = '<strong style="font-size: 16px; font-weight: 500;" class="text-danger">The username has already been taken.</strong>';
                                    $('#username').addClass('is-invalid');
                                }
                                $('.usernameError').html(html);
                            }
                        });

                    }
                    else {
                        $('.usernameError').html('<strong style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Username. Spaces, dots, and special characters are not allowed.</strong>');
                    }
                }
            });

            $('#refer').keyup(function(){
                let refer_username =$(this).val();

                var regex = /^[a-zA-Z0-9]+$/;

                if(refer_username != ''){
                    if (regex.test(refer_username)) {
                        url = "{{ route('ajax.referusername.check', ':refer_username') }}";
                        url = url.replace(':refer_username', refer_username);

                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {
                                let html = '';
                                if(data === 'no'){
                                    html = '<strong style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Refer Username </strong>';
                                    $('#refer').addClass('is-invalid');
                                    $('.refer_verify').addClass('d-none');
                                }
                                else{
                                    html = '<strong style="font-size: 16px; font-weight: 500;" class="text-success">Refer User : '+ data +' </strong>';
                                    $('#refer').removeClass('is-invalid');
                                    $('.refer_verify').removeClass('d-none');
                                }
                                $('.referError').html(html);
                            }
                        });

                    }
                    else {
                        $('.referError').html('<strong style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Refer Username. Spaces, dots, and special characters are not allowed.</strong>');
                    }
                }
            });

            $('#agent').keyup(function(){
                let agent_username =$(this).val();

                var regex = /^[a-zA-Z0-9]+$/;

                if(agent_username != ''){
                    if (regex.test(agent_username)) {
                        url = "{{ route('ajax.agent_username.check', ':agent_username') }}";
                        url = url.replace(':agent_username', agent_username);

                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {
                                let html = '';
                                if(data === 'no'){
                                    html = '<strong style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Agent Username </strong>';
                                    $('#agent').addClass('is-invalid');
                                    $('.agent_verify').addClass('d-none');
                                }
                                else{
                                    html = '<strong style="font-size: 16px; font-weight: 500;" class="text-success">Agent User : '+ data +' </strong>';
                                    $('#agent').removeClass('is-invalid');
                                    $('.agent_verify').removeClass('d-none');
                                }
                                $('.agentError').html(html);
                            }
                        });

                    }
                    else {
                        $('.agentError').html('<strong style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Agent Username. Spaces, dots, and special characters are not allowed.</strong>');
                    }
                }
            });

            $('#con_password').keyup(function(){
                let html = '';
                if($('#password').val() !== $('#con_password').val()){
                    html = '<strong style="font-size: 16px; font-weight: 500;" class="text-danger">Confirm Password Not Match! </strong>';
                    $('#con_password').addClass('is-invalid');
                }
                else{
                    html = '';
                    $('#con_password').removeClass('is-invalid');
                }
                $('.con_passwordError').html(html);
            });

        </script>
    @else
        <script>
            $("#password-show").on("click", function() {
                var passwordField = $("#password");
                var passwordIcon = $("#password-show-icon");

                if (passwordField.attr("type") === "password") {
                    passwordField.attr("type", "text");
                    passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
                }
                else {
                    passwordField.attr("type", "password");
                    passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        </script>
    @endif
@endpush
