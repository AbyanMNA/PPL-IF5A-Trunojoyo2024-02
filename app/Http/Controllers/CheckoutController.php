<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;
use App\Models\Vouchers;
use App\Models\VouchersDetail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function newCheckout(Request $request)
    {
        // dd($request->all());

        if (!$request->isMethod('POST')) {
            return redirect()->route('home');
        }

        $qty = $request->qty;
        $product_id = $request->product_id;
        // $product_id = $request->product_id;
        $product_id = [1, 2, 3, 26];
        $product = Product::whereIn('id', $product_id)->get();
        $merchant = Merchant::whereIn('id', $product->pluck('merchant_id'))->get();
        foreach ($product as $key => $value) {
            // if ($value->status != 'tersedia') {
            //     return back()->with('error', 'Produk tidak tersedia');
            // }
        }
        $userId = Auth::id();

        $total = 0;
        foreach ($product as $key => $value) {
            $total += $value->price;
        }

        // product to object
        $group_product = $product->groupBy('merchant_id');
        $groupedOrders = [];
        foreach ($group_product as $merchantId => $products) {
            $merchantDetails = $merchant->where('id', $merchantId)->first();
            $groupedOrders[] = [
                'merchant' => $merchantDetails,
                'products' => $products,
            ];
        }
        $data = [
            'qty' => $qty,
            'total' => $total,
            'userId' => $userId,
            'pesanan' => $groupedOrders,
        ];
        // dd($data);
        // dd($product->toArray() + $merchant->toArray());
        return view('Pages.checkout')->with($data);
    }
    public function applyVoucher(Request $request, $slug)
    {
        $voucher = Vouchers::where('code', $slug)->first();
        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher tidak ditemukan',
            ]);
        }
        $userId = Auth::id();
        $voucherDetail = VouchersDetail::where('voucher_id', $voucher->id)->where('users_id', $userId)->first();
        if ($voucherDetail) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher sudah digunakan',
            ]);
        }
        if ($voucher->expired_at < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher sudah kadaluarsa',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Voucher berhasil digunakan',
            'discount' => $voucher->discount_amount,
            'code' => $voucher->code,
        ]);
    }

    public function bayar(Request $request)
    {
        $data = $request->all();
        dd($data);
    }
}
