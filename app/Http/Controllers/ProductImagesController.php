<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
	public function insertProductImage(Request $request)
	{
		$productImageItem = $request->validate([
			'product_id' => 'required|integer',
			'path' => 'required|string',
		]);
		$productImage = ProductImages::create($productImageItem);
		return response()->json($productImage);
	}

	public function updateProductImageById(Request $request, $id)
	{
		$productImage = ProductImages::findOrFail($id);

		$productImageItem = $request->validate([
			'product_id' => 'integer',
			'path' => 'string',
		]);
		$productImage->update($productImageItem);
		return response()->json($productImage);
	}

	public function deleteProductImageById($id)
	{
		$productImage = ProductImages::findOrFail($id);
		$productImage->delete();
		return response()->json(['success' => true]);
	}
}
