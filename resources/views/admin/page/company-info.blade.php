@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Company Info</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">General Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.logo.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="system_name">System Name <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control @error('system_name') is-invalid @enderror" id="system_name" name="system_name" placeholder="Enter System Name" value="{{ $company_info->system_name }}">
                                    @error('system_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="website_logo">Website Logo <span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control @error('website_logo') is-invalid @enderror" id="website_logo" name="website_logo">
                                    @error('website_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($company_info->website_logo != null)
                                        <div class="website_logo">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->website_logo }}" alt="">
                                                <span class="img-remove" onclick="remove('website_logo', 'website_logo');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="user_logo">User Logo <span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control @error('user_logo') is-invalid @enderror" id="user_logo" name="user_logo">
                                    @error('user_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($company_info->user_logo != null)
                                        <div class="user_logo">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->user_logo }}" alt="">
                                                <span class="img-remove" onclick="remove('user_logo', 'user_logo');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="admin_logo">Admin Logo <span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control" id="admin_logo" name="admin_logo">

                                    @error('admin_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($company_info->admin_logo != null)
                                        <div class="admin_logo">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->admin_logo }}" alt="">
                                                <span class="img-remove" onclick="remove('admin_logo', 'admin_logo');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="favicon">Fav Icon <span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control" id="favicon" name="favicon">

                                    @error('favicon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($company_info->favicon != null)
                                        <div class="favicon">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->favicon }}" alt="">
                                                <span class="img-remove" onclick="remove('favicon', 'favicon');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="timezone">System Timezone</label>
                                    <select name="timezone" id="timezone" class="form-control select2 @error('timezone') is-invalid @enderror">
                                        <option value>Select</option>
                                        <option value="Pacific/Kwajalein" @if ($company_info->timezone == 'Pacific/Kwajalein') selected @endif>(GMT-12:00) International Date Line West</option>
                                        <option value="Pacific/Midway" @if ($company_info->timezone == 'Pacific/Midway') selected @endif>(GMT-11:00) Midway Island</option>
                                        <option value="Pacific/Apia" @if ($company_info->timezone == 'Pacific/Apia') selected @endif>(GMT-11:00) Samoa</option>
                                        <option value="Pacific/Honolulu" @if ($company_info->timezone == 'Pacific/Honolulu') selected @endif>(GMT-10:00) Hawaii</option>
                                        <option value="America/Anchorage" @if ($company_info->timezone == 'America/Anchorage') selected @endif>(GMT-09:00) Alaska</option>
                                        <option value="America/Los_Angeles" @if ($company_info->timezone == 'America/Los_Angeles') selected @endif>(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                        <option value="America/Tijuana" @if ($company_info->timezone == 'America/Tijuana') selected @endif>(GMT-08:00) Tijuana</option>
                                        <option value="America/Phoenix" @if ($company_info->timezone == 'America/Phoenix') selected @endif>(GMT-07:00) Arizona</option>
                                        <option value="America/Denver" @if ($company_info->timezone == 'America/Denver') selected @endif>(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                        <option value="America/Chihuahua" @if ($company_info->timezone == 'America/Chihuahua') selected @endif>(GMT-07:00) Chihuahua</option>
                                        <option value="America/Chihuahua" @if ($company_info->timezone == 'America/Chihuahua') selected @endif>(GMT-07:00) La Paz</option>
                                        <option value="America/Mazatlan" @if ($company_info->timezone == 'America/Mazatlan') selected @endif>(GMT-07:00) Mazatlan</option>
                                        <option value="America/Chicago" @if ($company_info->timezone == 'America/Chicago') selected @endif>(GMT-06:00) Central Time (US &amp; Canada)</option>
                                        <option value="America/Managua" @if ($company_info->timezone == 'America/Managua') selected @endif>(GMT-06:00) Central America</option>
                                        <option value="America/Mexico_City" @if ($company_info->timezone == 'America/Mexico_City') selected @endif>(GMT-06:00) Guadalajara</option>
                                        <option value="America/Mexico_City" @if ($company_info->timezone == 'America/Mexico_City') selected @endif>(GMT-06:00) Mexico City</option>
                                        <option value="America/Monterrey" @if ($company_info->timezone == 'America/Monterrey') selected @endif>(GMT-06:00) Monterrey</option>
                                        <option value="America/Regina" @if ($company_info->timezone == 'America/Regina') selected @endif>(GMT-06:00) Saskatchewan</option>
                                        <option value="America/New_York" @if ($company_info->timezone == 'America/New_York') selected @endif>(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                        <option value="America/Indiana/Indianapolis" @if ($company_info->timezone == 'America/Indiana/Indianapolis') selected @endif>(GMT-05:00) Indiana (East)</option>
                                        <option value="America/Bogota" @if ($company_info->timezone == 'America/Bogota') selected @endif>(GMT-05:00) Bogota</option>
                                        <option value="America/Lima" @if ($company_info->timezone == 'America/Lima') selected @endif>(GMT-05:00) Lima</option>
                                        <option value="America/Bogota" @if ($company_info->timezone == 'America/Bogota') selected @endif>(GMT-05:00) Quito</option>
                                        <option value="America/Halifax" @if ($company_info->timezone == 'America/Halifax') selected @endif>(GMT-04:00) Atlantic Time (Canada)</option>
                                        <option value="America/Caracas" @if ($company_info->timezone == 'America/Caracas') selected @endif>(GMT-04:00) Caracas</option>
                                        <option value="America/La_Paz" @if ($company_info->timezone == 'America/La_Paz') selected @endif>(GMT-04:00) La Paz</option>
                                        <option value="America/Santiago" @if ($company_info->timezone == 'America/Santiago') selected @endif>(GMT-04:00) Santiago</option>
                                        <option value="America/St_Johns" @if ($company_info->timezone == 'America/St_Johns') selected @endif>(GMT-03:30) Newfoundland</option>
                                        <option value="America/Sao_Paulo" @if ($company_info->timezone == 'America/Sao_Paulo') selected @endif>(GMT-03:00) Brasilia</option>
                                        <option value="America/Argentina/Buenos_Aires" @if ($company_info->timezone == 'America/Argentina/Buenos_Aires') selected @endif>(GMT-03:00) Buenos Aires</option>
                                        <option value="America/Argentina/Buenos_Aires" @if ($company_info->timezone == 'America/Argentina/Buenos_Aires') selected @endif>(GMT-03:00) Georgetown</option>
                                        <option value="America/Godthab" @if ($company_info->timezone == 'America/Godthab') selected @endif>(GMT-03:00) Greenland</option>
                                        <option value="America/Noronha" @if ($company_info->timezone == 'America/Noronha') selected @endif>(GMT-02:00) Mid-Atlantic</option>
                                        <option value="Atlantic/Azores" @if ($company_info->timezone == 'Atlantic/Azores') selected @endif>(GMT-01:00) Azores</option>
                                        <option value="Atlantic/Cape_Verde" @if ($company_info->timezone == 'Atlantic/Cape_Verde') selected @endif>(GMT-01:00) Cape Verde Is.</option>
                                        <option value="Africa/Casablanca" @if ($company_info->timezone == 'Africa/Casablanca') selected @endif>(GMT) Casablanca</option>
                                        <option value="Europe/London" @if ($company_info->timezone == 'Europe/London') selected @endif>(GMT) Dublin</option>
                                        <option value="Europe/London" @if ($company_info->timezone == 'Europe/London') selected @endif>(GMT) Edinburgh</option>
                                        <option value="Europe/Lisbon" @if ($company_info->timezone == 'Europe/Lisbon') selected @endif>(GMT) Lisbon</option>
                                        <option value="Europe/London" @if ($company_info->timezone == 'Europe/London') selected @endif>(GMT) London</option>
                                        <option value="UTC" @if ($company_info->timezone == 'UTC') selected @endif>(GMT) UTC</option>
                                        <option value="Africa/Monrovia" @if ($company_info->timezone == 'Africa/Monrovia') selected @endif>(GMT) Monrovia</option>
                                        <option value="Europe/Amsterdam" @if ($company_info->timezone == 'Europe/Amsterdam') selected @endif>(GMT+01:00) Amsterdam</option>
                                        <option value="Europe/Belgrade" @if ($company_info->timezone == 'Europe/Belgrade') selected @endif>(GMT+01:00) Belgrade</option>
                                        <option value="Europe/Berlin" @if ($company_info->timezone == 'Europe/Berlin') selected @endif>(GMT+01:00) Berlin</option>
                                        <option value="Europe/Berlin" @if ($company_info->timezone == 'Europe/Berlin') selected @endif>(GMT+01:00) Bern</option>
                                        <option value="Europe/Bratislava" @if ($company_info->timezone == 'Europe/Bratislava') selected @endif>(GMT+01:00) Bratislava</option>
                                        <option value="Europe/Brussels" @if ($company_info->timezone == 'Europe/Brussels') selected @endif>(GMT+01:00) Brussels</option>
                                        <option value="Europe/Budapest" @if ($company_info->timezone == 'Europe/Budapest') selected @endif>(GMT+01:00) Budapest</option>
                                        <option value="Europe/Copenhagen" @if ($company_info->timezone == 'Europe/Copenhagen') selected @endif>(GMT+01:00) Copenhagen</option>
                                        <option value="Europe/Ljubljana" @if ($company_info->timezone == 'Europe/Ljubljana') selected @endif>(GMT+01:00) Ljubljana</option>
                                        <option value="Europe/Madrid" @if ($company_info->timezone == 'Europe/Madrid') selected @endif>(GMT+01:00) Madrid</option>
                                        <option value="Europe/Paris" @if ($company_info->timezone == 'Europe/Paris') selected @endif>(GMT+01:00) Paris</option>
                                        <option value="Europe/Prague" @if ($company_info->timezone == 'Europe/Prague') selected @endif>(GMT+01:00) Prague</option>
                                        <option value="Europe/Rome" @if ($company_info->timezone == 'Europe/Rome') selected @endif>(GMT+01:00) Rome</option>
                                        <option value="Europe/Sarajevo" @if ($company_info->timezone == 'Europe/Sarajevo') selected @endif>(GMT+01:00) Sarajevo</option>
                                        <option value="Europe/Skopje" @if ($company_info->timezone == 'Europe/Skopje') selected @endif>(GMT+01:00) Skopje</option>
                                        <option value="Europe/Stockholm" @if ($company_info->timezone == 'Europe/Stockholm') selected @endif>(GMT+01:00) Stockholm</option>
                                        <option value="Europe/Vienna" @if ($company_info->timezone == 'Europe/Vienna') selected @endif>(GMT+01:00) Vienna</option>
                                        <option value="Europe/Warsaw" @if ($company_info->timezone == 'Europe/Warsaw') selected @endif>(GMT+01:00) Warsaw</option>
                                        <option value="Africa/Lagos" @if ($company_info->timezone == 'Africa/Lagos') selected @endif>(GMT+01:00) West Central Africa</option>
                                        <option value="Europe/Zagreb" @if ($company_info->timezone == 'Europe/Zagreb') selected @endif>(GMT+01:00) Zagreb</option>
                                        <option value="Europe/Athens" @if ($company_info->timezone == 'Europe/Athens') selected @endif>(GMT+02:00) Athens</option>
                                        <option value="Europe/Bucharest" @if ($company_info->timezone == 'Europe/Bucharest') selected @endif>(GMT+02:00) Bucharest</option>
                                        <option value="Africa/Cairo" @if ($company_info->timezone == 'Africa/Cairo') selected @endif>(GMT+02:00) Cairo</option>
                                        <option value="Africa/Harare" @if($company_info->timezone == 'Africa/Harare') selected @endif>(GMT+02:00) Harare</option>
                                        <option value="Europe/Helsinki" @if($company_info->timezone == 'Europe/Helsinki') selected @endif>(GMT+02:00) Helsinki</option>
                                        <option value="Europe/Istanbul" @if($company_info->timezone == 'Europe/Istanbul') selected @endif>(GMT+02:00) Istanbul</option>
                                        <option value="Asia/Jerusalem" @if($company_info->timezone == 'Asia/Jerusalem') selected @endif>(GMT+02:00) Jerusalem</option>
                                        <option value="Europe/Kiev" @if($company_info->timezone == 'Europe/Kiev') selected @endif>(GMT+02:00) Kyev</option>
                                        <option value="Europe/Minsk" @if($company_info->timezone == 'Europe/Minsk') selected @endif>(GMT+02:00) Minsk</option>
                                        <option value="Africa/Johannesburg" @if($company_info->timezone == 'Africa/Johannesburg') selected @endif>(GMT+02:00) Pretoria</option>
                                        <option value="Europe/Riga" @if($company_info->timezone == 'Europe/Riga') selected @endif>(GMT+02:00) Riga</option>
                                        <option value="Europe/Sofia" @if($company_info->timezone == 'Europe/Sofia') selected @endif>(GMT+02:00) Sofia</option>
                                        <option value="Europe/Tallinn" @if($company_info->timezone == 'Europe/Tallinn') selected @endif>(GMT+02:00) Tallinn</option>
                                        <option value="Europe/Vilnius" @if($company_info->timezone == 'Europe/Vilnius') selected @endif>(GMT+02:00) Vilnius</option>
                                        <option value="Asia/Baghdad" @if($company_info->timezone == 'Asia/Baghdad') selected @endif>(GMT+03:00) Baghdad</option>
                                        <option value="Asia/Kuwait" @if($company_info->timezone == 'Asia/Kuwait') selected @endif>(GMT+03:00) Kuwait</option>
                                        <option value="Europe/Moscow" @if($company_info->timezone == 'Europe/Moscow') selected @endif>(GMT+03:00) Moscow</option>
                                        <option value="Africa/Nairobi" @if($company_info->timezone == 'Africa/Nairobi') selected @endif>(GMT+03:00) Nairobi</option>
                                        <option value="Asia/Riyadh" @if($company_info->timezone == 'Asia/Riyadh') selected @endif>(GMT+03:00) Riyadh</option>
                                        <option value="Europe/Moscow" @if($company_info->timezone == 'Europe/Moscow') selected @endif>(GMT+03:00) St. Petersburg</option>
                                        <option value="Europe/Volgograd" @if($company_info->timezone == 'Europe/Volgograd') selected @endif>(GMT+03:00) Volgograd</option>
                                        <option value="Asia/Tehran" @if($company_info->timezone == 'Asia/Tehran') selected @endif>(GMT+03:30) Tehran</option>
                                        <option value="Asia/Muscat" @if($company_info->timezone == 'Asia/Muscat') selected @endif>(GMT+04:00) Abu Dhabi</option>
                                        <option value="Asia/Baku" @if($company_info->timezone == 'Asia/Baku') selected @endif>(GMT+04:00) Baku</option>
                                        <option value="Asia/Muscat" @if($company_info->timezone == 'Asia/Muscat') selected @endif>(GMT+04:00) Muscat</option>
                                        <option value="Asia/Tbilisi" @if($company_info->timezone == 'Asia/Tbilisi') selected @endif>(GMT+04:00) Tbilisi</option>
                                        <option value="Asia/Yerevan" @if($company_info->timezone == 'Asia/Yerevan') selected @endif>(GMT+04:00) Yerevan</option>
                                        <option value="Asia/Kabul" @if($company_info->timezone == 'Asia/Kabul') selected @endif>(GMT+04:30) Kabul</option>
                                        <option value="Asia/Yekaterinburg" @if($company_info->timezone == 'Asia/Yekaterinburg') selected @endif>(GMT+05:00) Ekaterinburg</option>
                                        <option value="Asia/Karachi" @if($company_info->timezone == 'Asia/Karachi') selected @endif>(GMT+05:00) Islamabad</option>
                                        <option value="Asia/Karachi" @if($company_info->timezone == 'Asia/Karachi') selected @endif>(GMT+05:00) Karachi</option>
                                        <option value="Asia/Tashkent" @if($company_info->timezone == 'Asia/Tashkent') selected @endif>(GMT+05:00) Tashkent</option>
                                        <option value="Asia/Kolkata" @if($company_info->timezone == 'Asia/Kolkata') selected @endif>(GMT+05:30) Chennai</option>
                                        <option value="Asia/Kolkata" @if($company_info->timezone == 'Asia/Kolkata') selected @endif>(GMT+05:30) Kolkata</option>
                                        <option value="Asia/Kolkata" @if($company_info->timezone == 'Asia/Kolkata') selected @endif>(GMT+05:30) Mumbai</option>
                                        <option value="Asia/Kolkata" @if($company_info->timezone == 'Asia/Kolkata') selected @endif>(GMT+05:30) New Delhi</option>
                                        <option value="Asia/Kathmandu" @if($company_info->timezone == 'Asia/Kathmandu') selected @endif>(GMT+05:45) Kathmandu</option>
                                        <option value="Asia/Almaty" @if($company_info->timezone == 'Asia/Almaty') selected @endif>(GMT+06:00) Almaty</option>
                                        <option value="Asia/Dhaka" @if($company_info->timezone == 'Asia/Dhaka') selected @endif>(GMT+06:00) Dhaka</option>
                                        <option value="Asia/Novosibirsk" @if($company_info->timezone == 'Asia/Novosibirsk') selected @endif>(GMT+06:00) Novosibirsk</option>
                                        <option value="Asia/Colombo" @if($company_info->timezone == 'Asia/Colombo') selected @endif>(GMT+06:00) Sri Jayawardenepura</option>
                                        <option value="Asia/Rangoon" @if($company_info->timezone == 'Asia/Rangoon') selected @endif>(GMT+06:30) Rangoon</option>
                                        <option value="Asia/Bangkok" @if($company_info->timezone == 'Asia/Bangkok') selected @endif>(GMT+07:00) Bangkok</option>
                                        <option value="Asia/Bangkok" @if($company_info->timezone == 'Asia/Bangkok') selected @endif>(GMT+07:00) Hanoi</option>
                                        <option value="Asia/Jakarta" @if($company_info->timezone == 'Asia/Jakarta') selected @endif>(GMT+07:00) Jakarta</option>
                                        <option value="Asia/Krasnoyarsk" @if($company_info->timezone == 'Asia/Krasnoyarsk') selected @endif>(GMT+07:00) Krasnoyarsk</option>
                                        <option value="Asia/Hong_Kong" @if($company_info->timezone == 'Asia/Hong_Kong') selected @endif>(GMT+08:00) Beijing</option>
                                        <option value="Asia/Chongqing" @if($company_info->timezone == 'Asia/Chongqing') selected @endif>(GMT+08:00) Chongqing</option>
                                        <option value="Asia/Hong_Kong" @if($company_info->timezone == 'Asia/Hong_Kong') selected @endif>(GMT+08:00) Hong Kong</option>
                                        <option value="Asia/Irkutsk" @if($company_info->timezone == 'Asia/Irkutsk') selected @endif>(GMT+08:00) Irkutsk</option>
                                        <option value="Asia/Kuala_Lumpur" @if($company_info->timezone == 'Asia/Kuala_Lumpur') selected @endif>(GMT+08:00) Kuala Lumpur</option>
                                        <option value="Australia/Perth" @if($company_info->timezone == 'Australia/Perth') selected @endif>(GMT+08:00) Perth</option>
                                        <option value="Asia/Singapore" @if($company_info->timezone == 'Asia/Singapore') selected @endif>(GMT+08:00) Singapore</option>
                                        <option value="Asia/Taipei" @if($company_info->timezone == 'Asia/Taipei') selected @endif>(GMT+08:00) Taipei</option>
                                        <option value="Asia/Irkutsk" @if($company_info->timezone == 'Asia/Irkutsk') selected @endif>(GMT+08:00) Ulaan Bataar</option>
                                        <option value="Asia/Urumqi" @if($company_info->timezone == 'Asia/Urumqi') selected @endif>(GMT+08:00) Urumqi</option>
                                        <option value="Asia/Tokyo" @if($company_info->timezone == 'Asia/Tokyo') selected @endif>(GMT+09:00) Osaka</option>
                                        <option value="Asia/Tokyo" @if($company_info->timezone == 'Asia/Tokyo') selected @endif>(GMT+09:00) Sapporo</option>
                                        <option value="Asia/Seoul" @if($company_info->timezone == 'Asia/Seoul') selected @endif>(GMT+09:00) Seoul</option>
                                        <option value="Asia/Tokyo" @if($company_info->timezone == 'Asia/Tokyo') selected @endif>(GMT+09:00) Tokyo</option>
                                        <option value="Asia/Yakutsk" @if($company_info->timezone == 'Asia/Yakutsk') selected @endif>(GMT+09:00) Yakutsk</option>
                                        <option value="Australia/Adelaide" @if($company_info->timezone == 'Australia/Adelaide') selected @endif>(GMT+09:30) Adelaide</option>
                                        <option value="Australia/Darwin" @if($company_info->timezone == 'Australia/Darwin') selected @endif>(GMT+09:30) Darwin</option>
                                        <option value="Australia/Brisbane" @if($company_info->timezone == 'Australia/Brisbane') selected @endif>(GMT+10:00) Brisbane</option>
                                        <option value="Australia/Sydney" @if($company_info->timezone == 'Australia/Sydney') selected @endif>(GMT+10:00) Canberra</option>
                                        <option value="Pacific/Guam" @if($company_info->timezone == 'Pacific/Guam') selected @endif>(GMT+10:00) Guam</option>
                                        <option value="Australia/Hobart" @if($company_info->timezone == 'Australia/Hobart') selected @endif>(GMT+10:00) Hobart</option>
                                        <option value="Australia/Melbourne" @if($company_info->timezone == 'Australia/Melbourne') selected @endif>(GMT+10:00) Melbourne</option>
                                        <option value="Pacific/Port_Moresby" @if($company_info->timezone == 'Pacific/Port_Moresby') selected @endif>(GMT+10:00) Port Moresby</option>
                                        <option value="Australia/Sydney" @if($company_info->timezone == 'Australia/Sydney') selected @endif>(GMT+10:00) Sydney</option>
                                        <option value="Asia/Vladivostok" @if($company_info->timezone == 'Asia/Vladivostok') selected @endif>(GMT+10:00) Vladivostok</option>
                                        <option value="Asia/Magadan" @if($company_info->timezone == 'Asia/Magadan') selected @endif>(GMT+11:00) Magadan</option>
                                        <option value="Asia/Magadan" @if($company_info->timezone == 'Asia/Magadan') selected @endif>(GMT+11:00) New Caledonia</option>
                                        <option value="Asia/Magadan" @if($company_info->timezone == 'Asia/Magadan') selected @endif>(GMT+11:00) Solomon Is.</option>
                                        <option value="Pacific/Auckland" @if($company_info->timezone == 'Pacific/Auckland') selected @endif>(GMT+12:00) Auckland</option>
                                        <option value="Pacific/Fiji" @if($company_info->timezone == 'Pacific/Fiji') selected @endif>(GMT+12:00) Fiji</option>
                                        <option value="Asia/Kamchatka" @if($company_info->timezone == 'Asia/Kamchatka') selected @endif>(GMT+12:00) Kamchatka</option>
                                        <option value="Pacific/Fiji" @if($company_info->timezone == 'Pacific/Fiji') selected @endif>(GMT+12:00) Marshall Is.</option>
                                        <option value="Pacific/Auckland" @if($company_info->timezone == 'Pacific/Auckland') selected @endif>(GMT+12:00) Wellington</option>
                                        <option value="Pacific/Tongatapu" @if($company_info->timezone == 'Pacific/Tongatapu') selected @endif>(GMT+13:00) Nuku'alofa</option>
                                    </select>
                                    @error('timezone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group pt-3 text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Company Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.settings.company.details.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="company_name">Website / Comapny Name</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" placeholder="Enter Company Name" value="{{ $company_info->company_name }}">
                                    @error('company_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="site_mettro">Site Motto</label>
                                    <input type="text" id="site_mettro" name="site_mettro" class="form-control @error('site_mettro') is-invalid @enderror" placeholder="Enter Company Title" value="{{ $company_info->site_mettro }}">
                                    @error('site_mettro')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group border-bottom">
                                    <label for="">Global SEO Details</label>
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Enter Meta Title" value="{{ $company_info->meta_title }}">
                                    @error('meta_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_des">Meta Description</label>
                                    <input type="text" id="meta_des" name="meta_des" class="form-control @error('meta_des') is-invalid @enderror" placeholder="Enter Meta Description" value="{{ $company_info->meta_des }}">
                                    @error('meta_des')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <input type="text" id="meta_keywords" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="Enter Meta Keywords" value="{{ $company_info->meta_keywords }}">
                                    @error('meta_keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_image">Meta Image</label>
                                    <input type="file" id="meta_image" name="meta_image" class="form-control @error('meta_image') is-invalid @enderror">
                                    @error('meta_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if ($company_info->meta_image != null)
                                        <div class="meta_image">
                                            <div class="uploaded-img">
                                                <img src="{{ asset('uploads/system').'/'.$company_info->meta_image }}" alt="">
                                                <span class="img-remove" onclick="remove('meta_image', 'meta_image');">x</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group text-right mt-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('js')
    <script>
        function remove(field_name, class_name){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this logo?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('admin.settings.logo.remove', ':field_name') }}';
                    url = url.replace(':field_name', field_name);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            $('.'+data).html('');
                        }
                    });

                }
            });
        }
    </script>
@endpush
