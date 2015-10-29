<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
	        'name' => 'required',
	        'discount' => 'required',
	        'products_list' => 'required',
	        'initial_period' => 'required|date_format:"d/m/Y"',
	        'final_period' => 'required|date_format:"d/m/Y"'
	        // 'initial_period' => 'required|date_format:"d/m/Y"|before_equal:final_period',
	        // 'final_period' => 'required|date_format:"d/m/Y"|after_equal:initial_period'
		];
	}

    public function messages() {
    	return [
	        'name.required' => 'É preciso preencher o nome da promoção',
	        'discount.required' => 'É preciso preencher o desconto da promoção',
	        'initial_period.required' => 'É preciso preencher a data inicial da promoção',
	        'final_period.required' => 'É preciso preencher a data final da promoção',
	        'initial_period.before' => 'A data inicial precisa ser menor que a data final',
	        'final_period.after' => 'A data final precisa ser maior que a data inicial',
	    ];
    }

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
