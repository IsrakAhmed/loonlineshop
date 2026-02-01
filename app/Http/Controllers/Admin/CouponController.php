<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function coupon()
    {
        return view('backEnd.admin.coupon');
    }
    public function index()
    {
        return response()->json(Coupon::all());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => 'required|unique:coupons,code',
                'amount' => 'required|numeric',
                'type' => 'required|in:percent,fixed',
                'expired_date' => 'required|date',
                'min_purchase' => 'nullable|numeric',
                'max_value' => 'nullable|numeric',
            ]);
    
            Coupon::create($validated);
            return response()->json(['message' => 'Coupon created successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->validator->errors(),
            ]);
        }
    }


    public function show($id)
    {
        return response()->json(Coupon::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
    
            $validated = $request->validate([
                'code' => 'required|unique:coupons,code,' . $id,
                'amount' => 'required|numeric',
                'type' => 'required|in:percent,fixed',
                'expired_date' => 'required|date',
                'min_purchase' => 'nullable|numeric',
                'max_value' => 'nullable|numeric',
            ]);
    
            $coupon->update($validated);
            return response()->json(['message' => 'Coupon updated successfully']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->validator->errors(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the coupon',
                'error' => $e->getMessage(),
            ]);
        }
    }


    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();
        return response()->json(['message' => 'Coupon deleted successfully']);
    }
}
