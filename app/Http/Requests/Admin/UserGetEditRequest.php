<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserGetEditRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		if (\Auth::user()->hasRole('admin'))
			return true;

		$paramPersonId = User::where('id', '=', $this->route()->parameters('id'))->select('person_id')->firstOrFail();
		$userEstablishmentId = User::userEstablishments($paramPersonId['person_id'])
			->select('establishment_person.establishment_id')
			->get();

		if (empty($userEstablishmentId[0])) {
			return false;
		}
		return $userEstablishmentId[0]['establishment_id'] === session('establishment');
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
		return redirect('admin/users/');
	}

}
