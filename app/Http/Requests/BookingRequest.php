<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
                'trip_id' => 'required|exists:trips,id',
                'from_station_id' => 'required|exists:stations,id',
                'to_station_id' => 'required|exists:stations,id|greater_than_field:from_station_id',
         
        ];
    }
    public function messages()
{
    return [
        'to_station_id.greater_than_field' => 'The to station id must be greater than from station id.',
    ];
}
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(responseFail($validator->errors(),401));
    }
}
