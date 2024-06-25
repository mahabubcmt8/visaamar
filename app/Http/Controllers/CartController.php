<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request){
        if($request->hasCookie('cookie_id')){
            $cookie_id = $request->cookie('cookie_id');
        }
        else{
            $cookie_id = time().Str::random(10);
            Cookie::queue('cookie_id', $cookie_id, 1440);
        }

        if(Cart::where(['cookie_id' => $cookie_id, 'product_id' => $request->product_id])->exists()){
            if(Cart::where(['cookie_id' => $cookie_id, 'product_id' => $request->product_id])->exists()){
                Cart::where(['cookie_id' => $cookie_id, 'product_id' => $request->product_id])->increment('quantity', $request->qty);
                return response()->json('increase');
            }
            else{
                $cart = new Cart;
                $cart->cookie_id = $cookie_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->qty;
                $cart->save();
                return response()->json('success');
            }
        }
        else{
            $cart = new Cart;
            $cart->cookie_id = $cookie_id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->qty;
            $cart->save();

            return response()->json('success');
        }

        return response()->json('error');


    }

    public function update(Request $request){
        if(request()->cookie('cookie_id')){
            $cookie_id = request()->cookie('cookie_id');

            $cart = Cart::where('cookie_id', $cookie_id)->where('product_id', $request->product_id)->first();
            if($cart == true){
                $cart->quantity = $request->quantity;
                $cart->save();
                return response()->json('success');
            }
            else{
                return response()->json('error');
            }
        }
        else{
            return response()->json('error');
        }
    }
    public function destroy($product_id){
        if(request()->cookie('cookie_id')){
            $cookie_id = request()->cookie('cookie_id');

            $cart = Cart::where('cookie_id', $cookie_id)->where('product_id', $product_id)->first();
            if($cart == true){
                $cart->forceDelete();
                return response()->json('success');
            }
            else{
                return response()->json('error');
            }
        }
        else{
            return response()->json('error');
        }
    }

    public function fetchData(){
        $cookie_id = request()->cookie('cookie_id');
        $data = Cart::with('product')->where('cookie_id', $cookie_id)->get();
        return response()->json($data);
    }

    // for agent
    public function agentStore(Request $request){
        $user = Auth::user();
        if($request->hasCookie('agent_cookie_id')){
            $cookie_id = $request->cookie('agent_cookie_id');
        }
        else{
            $cookie_id = time().Str::random(10);
            Cookie::queue('agent_cookie_id', $cookie_id, 1440);
        }

        if(Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id])->exists()){
            if(Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id])->exists()){
                Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id])->increment('quantity', $request->qty);
                return response()->json('increase');
            }
            else{
                $cart = new Cart;
                $cart->cookie_id = $cookie_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->qty;
                $cart->save();
                return response()->json('success');
            }
        }
        else{
            $cart = new Cart;
            $cart->cookie_id = $cookie_id;
            $cart->user_id = $user->id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->qty;
            $cart->save();

            return response()->json('success');
        }

        return response()->json('error');
    }

    public function agentUpdate(Request $request){
        $user = Auth::user();
        if(request()->cookie('agent_cookie_id')){
            $cookie_id = request()->cookie('agent_cookie_id');

            $cart = Cart::where('cookie_id', $cookie_id)->where('user_id', $user->id)->where('product_id', $request->product_id)->first();
            if($cart == true){
                $cart->quantity = $request->quantity;
                $cart->save();
                return response()->json('success');
            }
            else{
                return response()->json('error');
            }
        }
        else{
            return response()->json('error');
        }
    }
    public function agentDestroy($product_id){
        $user = Auth::user();
        if(request()->cookie('agent_cookie_id')){
            $cookie_id = request()->cookie('agent_cookie_id');

            $cart = Cart::where('cookie_id', $cookie_id)->where('user_id', $user->id)->where('product_id', $product_id)->first();
            if($cart == true){
                $cart->forceDelete();
                return response()->json('success');
            }
            else{
                return response()->json('error');
            }
        }
        else{
            return response()->json('error');
        }
    }

    public function agentFetchData(){
        $user = Auth::user();
        $cookie_id = request()->cookie('agent_cookie_id');
        $data = Cart::with('product')->where('cookie_id', $cookie_id)->where('user_id', $user->id)->get();
        return response()->json($data);
    }

    public function agentPackageStore(Request $request){
        if($request->hasCookie('package_cookie_id')){
            $cookie_id = $request->cookie('package_cookie_id');
        }
        else{
            $cookie_id = time().Str::random(10).Str::random(10);
            Cookie::queue('package_cookie_id', $cookie_id, 1440);
        }

        if(Cart::where(['cookie_id' => $cookie_id, 'product_id' => $request->product_id, 'client_id' => $request->client_id])->exists()){
            if(Cart::where(['cookie_id' => $cookie_id, 'product_id' => $request->product_id, 'client_id' => $request->client_id])->exists()){
                Cart::where(['cookie_id' => $cookie_id, 'product_id' => $request->product_id, 'client_id' => $request->client_id])->increment('quantity', $request->qty);
                return response()->json('increase');
            }
            else{
                $cart = new Cart;
                $cart->cookie_id = $cookie_id;
                $cart->client_id = $request->client_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->qty;
                $cart->save();
                return response()->json('success');
            }
        }
        else{
            $cart = new Cart;
            $cart->cookie_id = $cookie_id;
            $cart->client_id = $request->client_id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->qty;
            $cart->save();

            return response()->json('success');
        }

        return response()->json('error');


    }

    public function agentPackageFetchData($client_id){
        $cookie_id = request()->cookie('package_cookie_id');
        $data = Cart::with('package')->where('cookie_id', $cookie_id)->where('client_id', $client_id)->get();
        return response()->json($data);
    }

    public function agentPackageUpdate(Request $request){
        if(request()->cookie('package_cookie_id')){
            $cookie_id = request()->cookie('package_cookie_id');

            $cart = Cart::where('cookie_id', $cookie_id)->where('client_id', $request->client_id)->where('product_id', $request->product_id)->first();
            if($cart == true){
                $cart->quantity = $request->quantity;
                $cart->save();
                return response()->json('success');
            }
            else{
                return response()->json('error');
            }
        }
        else{
            return response()->json('error');
        }
    }

    public function agentPackageDestroy($product_id, $client_id){
        $user = Auth::user();
        if(request()->cookie('package_cookie_id')){
            $cookie_id = request()->cookie('package_cookie_id');

            $cart = Cart::where('cookie_id', $cookie_id)->where('client_id', $client_id)->where('product_id', $product_id)->first();
            if($cart == true){
                $cart->forceDelete();
                return response()->json('success');
            }
            else{
                return response()->json('error');
            }
        }
        else{
            return response()->json('error');
        }
    }

    public function agentPackagePurchaseStore(Request $request){
        $user = Auth::user();
        if($request->hasCookie('agent_package_purchase_cookie_id')){
            $cookie_id = $request->cookie('agent_package_purchase_cookie_id');
        }
        else{
            $cookie_id = time().Str::random(10);
            Cookie::queue('agent_package_purchase_cookie_id', $cookie_id, 1440);
        }

        if(Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id])->exists()){
            if(Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id])->exists()){
                Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id])->increment('quantity', $request->qty);
                return response()->json('increase');
            }
            else{
                $cart = new Cart;
                $cart->cookie_id = $cookie_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->qty;
                $cart->save();
                return response()->json('success');
            }
        }
        else{
            $cart = new Cart;
            $cart->cookie_id = $cookie_id;
            $cart->user_id = $user->id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->qty;
            $cart->save();

            return response()->json('success');
        }

        return response()->json('error');
    }

    public function agentPackagePurchaseFetchData(){
        $user = Auth::user();
        $cookie_id = request()->cookie('agent_package_purchase_cookie_id');
        $data = Cart::with('package')->where('cookie_id', $cookie_id)->where('user_id', $user->id)->get();
        return response()->json($data);
    }

    public function agentPackagePurchaseUpdate(Request $request){
        $user = Auth::user();
        if(request()->cookie('agent_package_purchase_cookie_id')){
            $cookie_id = request()->cookie('agent_package_purchase_cookie_id');

            $cart = Cart::where('cookie_id', $cookie_id)->where('user_id', $user->id)->where('product_id', $request->product_id)->first();
            if($cart == true){
                $cart->quantity = $request->quantity;
                $cart->save();
                return response()->json('success');
            }
            else{
                return response()->json('error');
            }
        }
        else{
            return response()->json('error');
        }
    }

    public function agentPackagePurchaseDestroy($product_id){
        $user = Auth::user();
        if(request()->cookie('agent_package_purchase_cookie_id')){
            $cookie_id = request()->cookie('agent_package_purchase_cookie_id');

            $cart = Cart::where('cookie_id', $cookie_id)->where('user_id', $user->id)->where('product_id', $product_id)->first();
            if($cart == true){
                $cart->forceDelete();
                return response()->json('success');
            }
            else{
                return response()->json('error');
            }
        }
        else{
            return response()->json('error');
        }
    }

    public function agentPackageRePurchaseStore(Request $request){
        // return $request->product_id.'-'.$request->qty.'-'.$request->type;
        $user = Auth::user();
        if($request->hasCookie('agent_repurchase_for_client_cookie_id')){
            $cookie_id = $request->cookie('agent_repurchase_for_client_cookie_id');
        }
        else{
            $cookie_id = time().Str::random(10);
            Cookie::queue('agent_repurchase_for_client_cookie_id', $cookie_id, 1440);
        }

        if(Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id, 'type' => $request->type])->exists()){
            if(Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id, 'type' => $request->type])->exists()){
                Cart::where(['cookie_id' => $cookie_id, 'user_id' => $user->id, 'product_id' => $request->product_id, 'type' => $request->type])->increment('quantity', $request->qty);
                return response()->json('increase');
            }
            else{
                $cart = new Cart;
                $cart->cookie_id = $cookie_id;
                $cart->product_id = $request->product_id;
                $cart->quantity = $request->qty;
                $cart->type = $request->type;
                $cart->save();
                return response()->json('success');
            }
        }
        else{
            $cart = new Cart;
            $cart->cookie_id = $cookie_id;
            $cart->user_id = $user->id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->qty;
            $cart->type = $request->type;
            $cart->save();

            return response()->json('success');
        }
        return response()->json('error');
    }
}
