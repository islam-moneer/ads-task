<?php

namespace App\Http\Requests\API\Ad;

use Illuminate\Foundation\Http\FormRequest;

class AdvertiserAdsRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'advertiser_id' => $this->route('advertiser'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'advertiser_id' => ['required', 'integer', 'exists:advertisers,id']
        ];
    }
}
