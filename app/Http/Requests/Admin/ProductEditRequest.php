<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class ProductEditRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [];
	}

    public function messages() {
    	return [];
    }

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		if (\Entrust::hasRole('admin'))
			return true;

		$paramEstablismentId = Product::where('id', '=', $this->route()->parameters('id'))->select('establishment_id')->firstOrFail();
		$productEstablishmentId = Product::whereIn('establishment_id', [$paramEstablismentId['establishment_id']])
			->select('products.establishment_id')
			->get();

		if (empty($productEstablishmentId[0]))
			return false;

		return $productEstablishmentId[0]['establishment_id'] === session('establishment');
	}

    /**
     * Get the sanitized input for the request.
     *
     * @return array
     */
    public function sanitize() {
        return $this->all();
    }


	/**
	 * Get the response for a forbidden operation.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function forbiddenResponse() {
		return redirect('admin/products/');
	}
}