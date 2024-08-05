<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background: #ccc">
                    <h3 class="text-center" style="text-transform: uppercase">{{ $country->name ?? '' }}</h3>
                </div>
                <div class="card-body">
                    @foreach ($country_visa as $item)
                        <p class="text-center"><strong>{{ $item->visa_name ?? '' }}</strong></p>
                        <small>{{ $item->description ?? '' }}</small>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Eligibility to Apply for Visa</h5>
                </div>
                <div class="card-body">
                    {!! $country->eligibility_for_visa !!}
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Documents Requirements</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        @foreach ($document_and_equirments as $item)
                            <div class="accordion-item">
                            <h2 class="accordion-header" style="border: 1px solid #ccc">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" aria-expanded="true" aria-controls="collapseOne">
                                {{ $item->document_name }}
                                </button>
                            </h2>
                            <div id="collapse{{ $item->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $item->document_description !!}
                                </div>
                            </div>
                            </div>
                        @endforeach
                      </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Visa Fees & Service Charges</h5>
                </div>
                <div class="card-body">
                    {!! $country->fees_charges !!}
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Processing Time</h5>
                </div>
                <div class="card-body">
                    {!! $country->processing_time !!}
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Sample Documents & Photos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($document_and_photos as $item)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ asset('uploads/country/'.$item->document_photo ) }}" alt="" width="100%">
                                        <p>{{ $item->details }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Country Information</h5>
                </div>
                <div class="card-body">
                    <h5 style="display: inline-block">{{ $country->name ?? '' }}</h5>
                    <img src="{{ asset('uploads/country/'.  $country->flag ) }}" alt="" style="display: inline-block" width="100px">
                    <table class="table table-bordered">
                        @foreach ($country_extra_info as $item)
                            <tr>
                                <td>{{ $item->info_key }}</td>
                                <td>{{ $item->info_value }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Before Departure Requirements</h5>
                </div>
                <div class="card-body">
                    {!! $country->departure_requiremet !!}
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Important Contacts & Links</h5>
                </div>
                <div class="card-body">
                    {!! $country->contacts_links !!}
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header" style="background: #ccc">
                    <h5 class="text-center" style="text-transform: uppercase">Remarks</h5>
                </div>
                <div class="card-body">
                    {!! $country->remarks !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

