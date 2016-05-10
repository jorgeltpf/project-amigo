<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Promotion;

class PromotionGetEditRequest extends FormRequest {
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

		$paramEstablismentId = Promotion::where('id', '=', $this->route()->parameters('id'))->select('establishment_id')->firstOrFail();
		$promotionEstablishmentId = Promotion::whereIn('establishment_id', [$paramEstablismentId['establishment_id']])
			->select('promotions.establishment_id')
			->get();

		if (empty($promotionEstablishmentId[0]))
			return false;

		return $promotionEstablishmentId[0]['establishment_id'] === session('establishment');
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
		return redirect('admin/promotions/');
	}
}