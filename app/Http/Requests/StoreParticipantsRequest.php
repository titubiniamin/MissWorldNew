<?php

namespace App\Http\Requests;

use App\MwApplicant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreParticipantsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//    public function rules(MwApplicant $mwApplicant) means    $mwApplicant = new  MwApplicant();
        return [
            'first_name' => 'required|max:40',
            'last_name' => 'required',
            'mobile_no' => "required",
//            'Mobile_No' => "required|unique:mw_applicants".$this->id,
//             'Mobile_No' =>['required', 'string', 'max:255',
//                 Rule::unique('mw_applicants')->ignore($this->mw_applicant->id), means from mw_applicant instance get id
//             ],
//            'Mobile_No' => Rule::unique('users')->ignore($this->id),

        ];
    }
}
