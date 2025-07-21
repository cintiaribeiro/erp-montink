<?php

namespace App\Services;

use App\Models\Coupon;

class CoupnService
{
    public function __construct(
        private Coupon $coupon
    ){}
    public function allCoupons()
    {
        $coupons = $this->coupon->all();
        return view('coupons.index', compact('coupons'));
    }

    public function createCoupons()
    {
        return view('coupons.create');
    }

    public function storeCoupons($request)
    {
        $data = $request->all();
        try {
            $this->coupon->create($data);
            return redirect()->route('coupons.index')->with('success', 'Cupom cadastrado com sucesso!');
        }catch (\Exception $e){
            return redirect()->route('coupons.index')->with('error', 'Erro ao cadastrar cupom!' . $e->getMessage());
        }
    }

    public function showCoupons($coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    public function editCoupons($coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    public function updateCoupons($request, $coupon)
    {
        $data = $request->all();
        try {
            $coupon->update($data);
            return redirect()->route('coupons.index')->with('success', 'Cupom atualizado com sucesso!');
        }catch (\Exception $e){
            return redirect()->route('coupons.index')->with('error', 'Erro ao atualizar cupom!' . $e->getMessage());
        }
    }

    public function destroyCoupons($coupon)
    {
        try {
            $coupon->delete();
            return redirect()->route('coupons.index')->with('success', 'Cupom deletado com sucesso!');
        }catch (\Exception $e){
            return redirect()->route('coupons.index')->with('error', 'Erro ao deletar cupom!' . $e->getMessage());
        }
    }
}
