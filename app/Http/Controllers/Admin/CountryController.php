<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryExtraInfo;
use App\Models\CountryVisa;
use App\Models\DocumentAndPhotos;
use App\Models\DocumentAndRequirments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Country';

        if (request()->ajax()) {
            $get = Country::where('is_deleted', 0)->get();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name ?? '';
                })
                ->addColumn('currency_name', function ($row) {
                    return $row->currency_name ?? '';
                })
                ->addColumn('flag', function($row){
                    $asset = asset('uploads/country/' . $row->flag);
                    return '<img src="'. $asset .'" width="30px">';
                })
                ->addColumn('action', function ($row) {
                    $button = '<a  href="'. route('visa.data', $row->id) .'" class="btn btn-sm btn-info mr-2"><i class="fas fa-eye"></i></a>';
                    $button .= '<a  href="'. route('admin.settings.country.edit', $row->id) .'" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></a>';
                    $button .= '<button type="button" onclick="destroy('. $row->id .')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';
                    return $button;
                })
                ->rawColumns(['action', 'flag'])
                ->make(true);
        }
        return view('admin.page.country.index',compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Country';
        return view('admin.page.country.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $slug = Str::slug($request->name, '-').'-'.rand(1,500);

            $country = new Country();
            $country->name = $request->name;
            $country->remarks = $request->remarks;
            $country->eligibility_for_visa = $request->eligibility_for_visa;
            $country->fees_charges = $request->fees_charges;
            $country->departure_requiremet = $request->departure_requiremet;
            $country->processing_time = $request->processing_time;
            $country->contacts_links = $request->contacts_links;
            // flag
            if ($request->hasFIle('flag')){
                $image = $request->file('flag');
                $file_name = $slug.'.'.$image->getclientoriginalextension();

                Image::make($image)->resize(370, 395)->save(public_path('uploads/country/'.$file_name));

                $country->flag = $file_name;
            }

            $country->save();

            // Product extra information
            $info_key = $request->input('info_key');
            $info_value = $request->input('info_value');
            if(isset($info_key)){
                foreach ($info_key as $index => $extra_info) {
                    $extra_info = new CountryExtraInfo();
                    $extra_info->country_id = $country->id;
                    $extra_info->info_key = $info_key[$index];
                    $extra_info->info_value = $info_value[$index];
                    $extra_info->save();
                }
            }

            // Product extra information
            $visa_names = $request->input('visa_name');
            $descriptions = $request->input('description');

            if (isset($visa_names) && is_array($visa_names)) {
                foreach ($visa_names as $index => $visa_name) {
                    // Check if visa_name and corresponding description are not empty
                    if (!empty($visa_name) && isset($descriptions[$index]) && !empty($descriptions[$index])) {
                        $visa = new CountryVisa();
                        $visa->country_id = $country->id;
                        $visa->visa_name = $visa_name;
                        $visa->description = $descriptions[$index];
                        $visa->save();
                    }
                }
            }


            // Documents Requirements
            $document_names = $request->input('document_name');
            $document_descriptions = $request->input('document_description');

            if (isset($document_names) && is_array($document_names)) {
                foreach ($document_names as $index => $document_name) {
                    // Check if document_name and corresponding document_description are not empty
                    if (!empty($document_name) && isset($document_descriptions[$index]) && !empty($document_descriptions[$index])) {
                        $document = new DocumentAndRequirments();
                        $document->country_id = $country->id;
                        $document->document_name = $document_name;
                        $document->document_description = $document_descriptions[$index];
                        $document->save();
                    }
                }
            }

            $details = $request->input('details');
            $document_photos = $request->file('document_photo');

            if (isset($details) && is_array($details)) {
                foreach ($details as $index => $detail) {
                    // Check if detail is not empty
                    if (!empty($detail)) {
                        $documentDetail = new DocumentAndPhotos();
                        $documentDetail->country_id = $country->id;
                        $documentDetail->details = $detail;

                        // Handle image upload
                        if ($request->hasFile('document_photo')) {
                            if (is_array($document_photos) && isset($document_photos[$index])) {
                                $document_photo = $document_photos[$index];
                                $document_photo_name = $slug . '_' . $index . '.' . $document_photo->getClientOriginalExtension();
                                Image::make($document_photo)->save(public_path('uploads/country/' . $document_photo_name));
                                $documentDetail->document_photo = $document_photo_name;
                            } elseif (!is_array($document_photos) && $index == 0) {
                                $document_photo = $document_photos;
                                $document_photo_name = $slug . '_' . $index . '.' . $document_photo->getClientOriginalExtension();
                                Image::make($document_photo)->save(public_path('uploads/country/' . $document_photo_name));
                                $documentDetail->document_photo = $document_photo_name;
                            }
                        }

                        $documentDetail->save();
                    }
                }
            }



            return redirect()->route('admin.settings.country.index')->with('success', 'Country added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Countries';
        $country =  Country::findOrFail($id);
        $countryExtraInfo = CountryExtraInfo::where('country_id', $country->id)->get();
        $countryVisa = CountryVisa::where('country_id', $country->id)->get();
        $documentRequirments = DocumentAndRequirments::where('country_id', $country->id)->get();
        $documentPhotos = DocumentAndPhotos::where('country_id', $country->id)->get();
        return view('admin.page.country.edit', compact('country', 'pageTitle', 'countryExtraInfo', 'countryVisa', 'documentRequirments', 'documentPhotos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $slug = Str::slug($request->name, '-').'-'.rand(1,500);
            $country = Country::findOrFail($id);

            // Delete
            $countryExtraInfo = CountryExtraInfo::where('country_id', $country->id)->delete();
            $countryVisa = CountryVisa::where('country_id', $country->id)->delete();
            $documentRequirments = DocumentAndRequirments::where('country_id', $country->id)->delete();
            $documentPhotos = DocumentAndPhotos::where('country_id', $country->id)->delete();

            $country->name = $request->name;
            $country->remarks = $request->remarks;
            $country->eligibility_for_visa = $request->eligibility_for_visa;
            $country->fees_charges = $request->fees_charges;
            $country->departure_requiremet = $request->departure_requiremet;
            $country->processing_time = $request->processing_time;
            $country->contacts_links = $request->contacts_links;
            // flag
            if ($request->hasFIle('flag')){
                $image = $request->file('flag');
                $file_name = $slug.'.'.$image->getclientoriginalextension();

                Image::make($image)->resize(370, 395)->save(public_path('uploads/country/'.$file_name));

                $country->flag = $file_name;
            }

            $country->save();

            // Product extra information
            $info_key = $request->input('info_key');
            $info_value = $request->input('info_value');
            if(count($info_key) > 0){
                foreach ($info_key as $index => $extra_info) {
                    $extra_info = new CountryExtraInfo();
                    $extra_info->country_id = $country->id;
                    $extra_info->info_key = $info_key[$index];
                    $extra_info->info_value = $info_value[$index];
                    $extra_info->save();
                }
            }

            // Product extra information
            $visa_name = $request->input('visa_name');
            $description = $request->input('description');
            if(count($visa_name) > 0){
                foreach ($visa_name as $index => $visa) {
                    $visa = new CountryVisa();
                    $visa->country_id = $country->id;
                    $visa->visa_name = $visa_name[$index];
                    $visa->description = $description[$index];
                    $visa->save();
                }
            }

            // Documents Requirements
            $document_name = $request->input('document_name');
            $document_description = $request->document_description;
            if(count($document_name) > 0){
                foreach ($document_name as $index => $document) {
                    $document = new DocumentAndRequirments();
                    $document->country_id = $country->id;
                    $document->document_name = $document_name[$index];
                    $document->document_description = $document_description[$index];
                    $document->save();
                }
            }

            // Sample Documents & Photos
            $details = $request->input('details');
            $document_photo = $request->file('document_photo');
            if(count($details) > 0){
                foreach ($details as $index => $detail) {
                    $detail = new DocumentAndPhotos();
                    $detail->country_id = $country->id;
                    $detail->details = $details[$index];
                    // Handle image upload
                    if ($request->hasFile('document_photo') && isset($document_photo[$index])) {
                        $document_photo = $document_photo[$index];
                        $document_photo_name = $slug . '_' . $index . '.' . $document_photo->getClientOriginalExtension();
                        Image::make($document_photo)->save(public_path('uploads/country/' . $document_photo_name));
                        $detail->document_photo = $document_photo_name;
                    }
                    $detail->save();
                }
            }

            return redirect()->route('admin.settings.country.index')->with('success', 'Country added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
