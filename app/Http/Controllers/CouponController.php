<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Services\CoupnService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(
        private CoupnService $coupnService,
    )
    {
    }

    public function index()
    {
        return $this->coupnService->allCoupons();
    }

    public function create()
    {
        return $this->coupnService->createCoupons();
    }

    public function store(Request $request)
    {
        return $this->coupnService->storeCoupons($request);
    }

    public function show(Coupon $coupon)
    {
        return $this->coupnService->showCoupons($coupon);
    }

    public function edit(Coupon $coupon)
    {
        return $this->coupnService->editCoupons($coupon);
    }

    public function update(Request $request, Coupon $coupon)
    {
        return $this->coupnService->updateCoupons($request, $coupon);
    }

    public function destroy(Coupon $coupon)
    {
        return $this->coupnService->destroyCoupons($coupon);
    }

    public function validate(Request $request)
    {
        return $this->coupnService->validateCoupon($request);
    }
}
