<?php

namespace App\Helpers\Traits;

use App\Helpers\Constant;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait StockTrait {
    public function purchase_qty($product_id, $user_id){
        $totalQty = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->where('invoices.user_id', $user_id)->where('invoices.type', Constant::ORDER_TYPE['agent'])->where('invoices.status', Constant::STATUS['approved'])->where('invoices.order_status', Constant::ORDER_STATUS['deliverd'])->where('invoice_items.product_id', $product_id)->sum('invoice_items.qty');
        return $totalQty ?? 0;
    }

    public function package_purchase_qty($package_id, $user_id){
        $totalQty = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->where('invoices.user_id', $user_id)->where('invoices.type', Constant::ORDER_TYPE['agent_packege'])->where('invoices.status', Constant::STATUS['approved'])->where('invoices.order_status', Constant::ORDER_STATUS['deliverd'])->where('invoice_items.package_id', $package_id)->sum('invoice_items.qty');
        return $totalQty ?? 0;
    }

    public function purchase_price($product_id, $user_id){
        $totalPrice = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->where('invoices.user_id', $user_id)
            ->where('invoices.type', Constant::ORDER_TYPE['agent'])
            ->where('invoices.status', Constant::STATUS['approved'])
            ->where('invoices.order_status', Constant::ORDER_STATUS['deliverd'])
            ->where('invoice_items.product_id', $product_id)
            ->selectRaw('SUM(COALESCE(NULLIF(invoice_items.offer_price, 0), invoice_items.price)) as totalPrice')
            ->first();

        return $totalPrice->totalPrice ?? 0;
    }

    public function package_purchase_price($package_id, $user_id){
        $totalPrice = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->where('invoices.user_id', $user_id)
            ->where('invoices.type', Constant::ORDER_TYPE['agent_packege'])
            ->where('invoices.status', Constant::STATUS['approved'])
            ->where('invoices.order_status', Constant::ORDER_STATUS['deliverd'])
            ->where('invoice_items.package_id', $package_id)
            ->selectRaw('SUM(COALESCE(NULLIF(invoice_items.offer_price, 0), invoice_items.price)) as totalPrice')
            ->first();

        return $totalPrice->totalPrice ?? 0;
    }

    public function sell_qty($product_id, $agent){
        $totalQty = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->where('invoices.agent_id', $agent)->where('invoices.type', Constant::ORDER_TYPE['customer'])->whereIn('invoices.status', [Constant::STATUS['pending'], Constant::STATUS['approved']])->where('invoices.order_status', '!=' ,Constant::ORDER_STATUS['rejected'])->where('invoice_items.product_id', $product_id)->sum('invoice_items.qty');
        return $totalQty ?? 0;
    }

    public function package_sell_qty($package_id, $agent){
        $totalQty = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->where('invoices.agent_id', $agent)->where('invoices.type', Constant::ORDER_TYPE['customer_packege'])->whereIn('invoices.status', [Constant::STATUS['pending'], Constant::STATUS['approved']])->where('invoices.order_status', '!=' ,Constant::ORDER_STATUS['rejected'])->where('invoice_items.package_id', $package_id)->sum('invoice_items.qty');
        return $totalQty ?? 0;
        // pending
    }

    public function stock($product_id, $agent, $user_id){
        return $this->purchase_qty($product_id, $user_id) - $this->sell_qty($product_id, $agent);
    }

    public static function agent_product_stock($product_id, $agent, $user_id){
        $purchase_qty = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->where('invoices.user_id', $user_id)->where('invoices.type', Constant::ORDER_TYPE['agent'])->where('invoices.status', Constant::STATUS['approved'])->where('invoices.order_status', Constant::ORDER_STATUS['deliverd'])->where('invoice_items.product_id', $product_id)->sum('invoice_items.qty') ?? 0;

        $sell_qty = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->where('invoices.agent_id', $agent)->where('invoices.type', Constant::ORDER_TYPE['customer'])->whereIn('invoices.status', [Constant::STATUS['pending'], Constant::STATUS['approved']])->where('invoices.order_status', '!=' ,Constant::ORDER_STATUS['rejected'])->where('invoice_items.product_id', $product_id)->sum('invoice_items.qty') ?? 0;

        return $purchase_qty - $sell_qty;
    }

    public function package_stock($package_id, $agent, $user_id){
        return $this->package_purchase_qty($package_id, $user_id) - $this->package_sell_qty($package_id, $agent);
    }

    public static function agent_package_stock($package_id, $agent, $user_id){
        $purchase_qty = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->where('invoices.user_id', $user_id)->where('invoices.type', Constant::ORDER_TYPE['agent_packege'])->where('invoices.status', Constant::STATUS['approved'])->where('invoices.order_status', Constant::ORDER_STATUS['deliverd'])->where('invoice_items.package_id', $package_id)->sum('invoice_items.qty') ?? 0;

        $sell_qty = Invoice::leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->where('invoices.agent_id', $agent)->where('invoices.type', Constant::ORDER_TYPE['customer_packege'])->whereIn('invoices.status', [Constant::STATUS['pending'], Constant::STATUS['approved']])->where('invoices.order_status', '!=' ,Constant::ORDER_STATUS['rejected'])->where('invoice_items.package_id', $package_id)->sum('invoice_items.qty') ?? 0;

        return $purchase_qty - $sell_qty;
    }
}
