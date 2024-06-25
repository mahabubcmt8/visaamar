<?php
namespace App\Helpers;
class Constant{
    const PRODUCT_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];
    const SOLD_STATUS = [
        'not_sold' => 0,
        'sold' => 1
    ];
    const POLICY_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];
    const TERMS_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];
    const USER_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];

    // const USER_STATUS = [
    //     'active' => 0,
    //     'deactive' => 1
    // ];

    const USER_TYPE = [
        'user' => 0,
        'agent' => 1
    ];
    const GENERATION_STATUS = [
        'active' => 1,
        'deactive' => 0
    ];
    const BANNER_TYPE = [
        'home' => 0,
        'banner' => 1
    ];
    const METHOD = [
        'Bkash' => 1,
        'Rocket' => 2,
        'Nagad' => 3
    ];

    const WALLET_TYPE = [
        'active_balance' => 1,
        'trading_balance' => 2,
        'DTP_balance' => 3,
        'affiliate_comission' => 4,
        'team_business' => 5,
        'total_earn' => 6
    ];

    const TRANSACTION_TYPE = [
        'add_fund' => 1,
        'withdraw' => 2,
        'product_sell' => 3,
        'sell_commission' => 4,
        'product_purchase' => 5,
        'package_purchase' => 6,
        'transfer' => 7,
        'receive' => 8,
        'deposit' => 9,
        'generation_income' => 10,
        'package_sell' => 11,
    ];
    const WITHDRAW_STATUS = [
        'pending' => 1,
        'processing' => 2,
        'confirmed' => 3,
        'approved' => 4,
        'rejected' => 5,
    ];
    const STATUS = [
        'approved' => 1,
        'pending' => 2,
        'rejected' => 3,
        'cancel' => 4
    ];
    const IN_STATUS=[
        'active' => 1,
        'deactive' => 0,
    ];

    const INVOICE_COMMISSION_STATUS=[
        'no' => 0,
        'yes' => 1,
    ];

    const MINIMUM_AMOUNT = [
        'deposit' => 100,
        'withdraw' => 20,
    ];

    const CURRENCY = [
        'name' => 'BDT',
        'symble' => '৳',
    ];

    const ORDER_STATUS = [
        'pending' => 1,
        'placed' => 2,
        'logistic' => 3,
        'deliverd' => 4,
        'rejected' => 5,
    ];
    const ORDER_TYPE = [
        'customer' => 1,
        'agent' => 2,
        'agent_packege' => 3,
        'customer_packege' => 4,
    ];

    const GENDER = [
        'male' => 1,
        'female' => 2,
        'others' => 3,
    ];
    const MIN_YEAR = [
        'old' => 18,
    ];
    const PACKAGE_STATUS = [
        'active' => 0,
        'deactive' => 1
    ];
}
