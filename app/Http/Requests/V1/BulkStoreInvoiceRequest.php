<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // authorize the user to create a customer
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * The validation is applied in every invoice request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //  *. this an function of laravel, who validate each properties on object
        // if the data was passed like this data: [{name:}] then the validation rules will be like this: 'data.*.name'
        return [
            '*.customerId'    => ['required', 'integer'],
            '*.amount'        => ['required', 'numeric'],
            '*.status'        => ['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
            '*.billedDated'   => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paidDated'     => ['date_format:Y-m-d H:i:s', 'nullable'],
            // 'createdAt'    => ['required'],
            // 'updatedAt'    => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        // dd($this);

        $data = [];

        foreach ($this->toArray() as $obj) {
            // this id exists?
            $obj['customer_id']  = $obj['customerId']   ?? null;
            $obj['billed_dated'] = $obj['billedDated']  ?? null;
            $obj['paid_dated']   = $obj['paidDated']    ?? null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}
