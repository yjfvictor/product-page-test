<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
	private function formatResponse($product)
	{
		$full_price = $product->price;
		$price = [
			'full' => $full_price,
			'discounted' => $full_price,
		];
		$discount = null;

		if ($product->discount)
		{
			$discountAmount = $product->discount->discount;
			$discount = [
				'type' => $product->discount->type,
				'amount' => $discountAmount,
			];

			if ($product->discount->type == 'percent')
			{
				$discountAmount = $full_price * $discountAmount / 100;
			}
			$price['discounted'] -= $discountAmount;

		}
		$images = $product->images->pluck('path');


		return [
			'id' => $product->id,
			'name' => $product->name,
			'description' => $product->description,
			'slug' => $product->slug,
			'price' => $price,
			'discount' => $discount, 
			'images' => $images,
		];
	}

	public function getProductById($id)
	{
		$product = Product::with(['images', 'discount'])->findOrFail($id);
		return response()->json($this->formatResponse($product));
	}

	public function getProductBySlug($slug)
	{
		$product = Product::with(['images', 'discount'])->where('slug', $slug)->firstOrFail();
		return response()->json($this->formatResponse($product));
	}

	public function insertProduct(Request $request)
	{
		$productItem = $request->validate([
			'name' => 'required|string',
			'description' => 'required|string',
			'slug' => 'required|string|unique:products',
			'price' => 'required|integer',
			'active' => 'required|boolean',
		]);
		$product = Product::create($productItem);
		return response()->json($product);
	}

	public function updateProductById(Request $request, $id)
	{
		$product = Product::findOrFail($id);

		$productItem = $request->validate([
			'name' => 'string',
			'description' => 'string',
			'slug' => 'string|unique:products',
			'price' => 'integer',
			'active' => 'boolean',
		]);
		$product->update($productItem);
		return response()->json($product);
	}

	public function deleteProductById($id)
	{
		$product = Product::with(['images', 'discount'])->findOrFail($id);
		$product->delete();
		return response()->json(['success' => true]);
	}
}
