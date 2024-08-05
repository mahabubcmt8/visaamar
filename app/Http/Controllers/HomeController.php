<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\AboutSection;
use App\Models\Admin\PageBanner;
use App\Models\AdsBanner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Country;
use App\Models\CountryExtraInfo;
use App\Models\CountryVisa;
use App\Models\DocumentAndPhotos;
use App\Models\DocumentAndRequirments;
use App\Models\Product;
use App\Models\Tour;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Share;
use function Illuminate\Validation\message;
use function PHPUnit\Framework\result;
use function Symfony\Component\Mime\Header\all;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = companyInfo()->site_mettro;
        $categories = Category::take(10)->get();
        $banners = PageBanner::latest()->get();
        $bannersections = AdsBanner::all();
        $categories2 = Category::all();
        //        $categories3 = Category::orderBy('id', 'desc')->take(4)->get();
        $latestProduct = Product::orderBy('id', 'desc')->take(6)->get();
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $addresses = Product::all();
        $contacts = Contact::all();
        $products = Product::orderBy('id', 'desc')->paginate(12);
        $aboutsection = AboutSection::first();
        $tours = Tour::latest()->get()->take(12);

        return view('frontend.index', compact(
            'categories',
            'contacts',
            'addresses',
            'divisions',
            'upazilas',
            'districts',
            'latestProduct',
            'categories2',
            'pageTitle',
            'banners',
            'products',
            'bannersections',
            'aboutsection',
            'tours'));
    }

    public function visa(){
        $pageTitle = companyInfo()->site_mettro;
        $countries = Country::oldest()->get();
        return view('frontend.visa', compact('pageTitle', 'countries'));
    }
    public function visaData($id){
        $data['country'] = Country::findOrFail($id);
        $data['country_visa'] = CountryVisa::where('country_id', $data['country']->id)->get();
        $data['country_extra_info'] = CountryExtraInfo::where('country_id', $data['country']->id)->get();
        $data['document_and_photos'] = DocumentAndPhotos::where('country_id', $data['country']->id)->get();
        $data['document_and_equirments'] = DocumentAndRequirments::where('country_id', $data['country']->id)->get();
        return view('frontend.visa-data', $data);
    }
    public function about()
    {
        $pageTitle = companyInfo()->site_mettro;
        $aboutsection = AboutSection::first();
        return view('frontend.about-us', compact('pageTitle', 'aboutsection'));
    }

    public function contact()
    {
        $pageTitle = companyInfo()->site_mettro;
        $contact = Contact::all();
        return view('frontend.contact', compact('pageTitle', 'contact'));
    }

    public function tours(){
        $pageTitle = companyInfo()->site_mettro;
        $tours = Tour::latest()->paginate(20);
        return view('frontend.tours', compact('pageTitle', 'tours'));
    }

    public function tours_details($slug){
        $pageTitle = companyInfo()->site_mettro;
        $tours = Tour::where('slug', $slug)->first();
        return view('frontend.tours-details', compact('pageTitle', 'tours'));
    }

    public function gallary()
    {
        if (request()->has('photo-gallary')) {
            $pageTitle = companyInfo()->site_mettro;
            return view('frontend.photo-gallary', compact('pageTitle'));
        } else {
            $pageTitle = companyInfo()->site_mettro;
            return view('frontend.video-gallary', compact('pageTitle'));
        }
    }

    public function search(Request $request)
    {
        $search = Product::query();
        if (($request->category_name2 != '') && ($request->district != '') && ($request->upazila != '') && ($request->address != '')) {
            $search = $search->where('category_id', '=', $request->category_name2)
                ->where('district_id', '=',  $request->district)
                ->where('upazila_id', '=', $request->upazila)
                ->orWhere('address', 'LIKE', '%' . $request->address . '%');
        } else if (($request->category_name2 != '') && ($request->district != '')) {
            $search = $search->where('category_id', '=', $request->category_name2)
                ->where('district_id', '=',  $request->district);
        } else if (($request->category_name2 != '') && ($request->upazila != '')) {
            $search = $search->where('category_id', '=', $request->category_name2)
                ->where('upazila_id', '=',  $request->upazila);
        } else if (($request->category_name2 != '') && ($request->address != '')) {
            $search = $search->where('category_id', '=', $request->category_name2)
                ->orWhere('address', 'LIKE', '%' . $request->address . '%');
        } else {
            if ($request->category_name2 != '') {
                $search = $search->where('category_id', $request->category_name2);
            } elseif ($request->district != '') {
                $search = $search->where('district_id', $request->district);
            } elseif ($request->upazila != '') {
                $search = $search->where('upazila_id', $request->upazila);
            } elseif ($request->address != '') {
                $search = $search->where('address', 'LIKE', '%' . $request->address . '%');
            }
        }

        $search = $search->orderBy('id', 'DESC')->get();




        // $search = DB::table('products')
        //     ->where('category_id', '=', $request->category_name2)
        //     ->orWhere('district_id', '=',  $request->district)
        //     ->orWhere('upazila_id', '=', $request->upazila)
        //     ->orWhere('address', 'LIKE', '%' . $request->address . '%')->get();

        if ($search) {
            $pageTitle = 'All Search  Products';

            return view('frontend.search', compact('search', 'pageTitle'));
        } else {
            return  redirect('/')->with('success', 'No Product Found');
        }


        //        if (($request->category_name2 != 'all') && ($request->district != null) && ($request->upazila != null)  && ($request->division != null) && ($request->address != null)) {
        //            $search = Product::where('category_id', $request->category_name)->where('division_id', $request->division)->where('district_id', $request->district)->where('upazila_id', $request->upazila)->where('address', $request->address != null)->latest()->get();
        //        } elseif ($request->category_name2 != 'all') {
        //            $search = Product::where('category_id', $request->category_name2)->latest()->get();
        //        } elseif (($request->district != null) && ($request->category_name2 == 'all')) {
        //            $search = Product::where('district_id', $request->district)->latest()->get();
        //        } elseif (($request->upazila != null) && ($request->category_name2 == 'all')) {
        //            $search = Product::where('upazila_id', $request->upazila)->latest()->get();
        //        } elseif (($request->division != null)  && ($request->category_name2 == 'all')) {
        //            $search = Product::where('division_id', $request->division)->latest()->get();
        //        } elseif (($request->address != null)  && ($request->category_name2 == 'all')) {
        //            $search = Product::where('address', $request->address)->latest()->get();
        //        } else {
        //            $search = Product::latest()->get();
        //        }

    }


    public function achieverList()
    {

        $pageTitle = companyInfo()->site_mettro;
        return view('frontend.achiever-list', compact('pageTitle'));
    }

    public function shop()
    {
        $pageTitle = 'All Products';
        $categories = Category::all();
        $products = Product::where('status', Constant::PRODUCT_STATUS['active'])->orderBy('id', 'DESC');

        if (request()->category) {
            $products = $products->where('category_id', request()->category)->get();
        }else if(request()->thana) {
            $products = $products->where('upazila_id', request()->thana)->get();
        } else {
            $products = $products->paginate(20);
        }
        return view('frontend.shop', compact('categories', 'products', 'pageTitle'));
    }

    //
    //    public function landSale()
    //    {
    //        $pageTitle = 'All Land Product Show';
    //        $categories = Category::all();
    //        $products = Product::where('status', Constant::PRODUCT_STATUS['active']);
    //
    //        if(request()->category){
    //            $products = $products->where('category_id', request()->category)->paginate(20);
    //        }
    //        else{
    //            $products = $products->paginate(20);
    //        }
    //        return view('frontend.shop', compact('categories', 'products', 'pageTitle'));
    //    }

    public function productView(int $id, string $slug)
    {
        $product = Product::findOrFail($id);
        $pageTitle = $product->title;
        $shareBtn = Share::page(route('product', ['id' => $product->id, 'slug' => $product->slug]), $product->title)
            ->facebook()
            ->telegram()
            ->whatsapp()
            ->getRawLinks();
        $latestProducts = Product::where('category_id', $product->category_id)->orderBy('id', 'DESC')->get();
        $youtube = Product::all();
        return view('frontend.product', compact('product', 'pageTitle', 'shareBtn', 'latestProducts', 'youtube'));
    }
}
