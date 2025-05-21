<?php

namespace App\Http\Controllers;

use App\Models\ProductDiscounts;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductDiscountsController extends Controller
{
	public function insertProductDiscount(Request $request)
	{
		$productDiscountItem = $request->validate([
			'product_id' => 'required|integer',
			'type' => ['required', Rule::in(['percent', 'amount'])],
			'discount' => 'required|integer',
		]);
		$productDiscount = ProductDiscounts::create($productDiscountItem);
		return response()->json($productDiscount);
	}

	public function updateProductDiscountById(Request $request, $id)
	{
		$productDiscount = ProductDiscounts::findOrFail($id);

		$productDiscountItem = $request->validate([
			'product_id' => 'integer',
			'type' => Rule::in(['percent', 'amount']),
			'discount' => 'integer',
		]);
		$productDiscount->update($productDiscountItem);
		return response()->json($productDiscount);
	}

	public function deleteProductDiscountById($id)
	{
		$productDiscountItem = ProductDiscounts::findOrFail($id);
		$productDiscountItem->delete();
		return response()->json(['success' => true]);
	}
}
