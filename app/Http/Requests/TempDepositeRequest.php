<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempDepositeRequest extends FormRequest
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
        return [
            "data"                    => "required|array|min:1",
            "data.*.account_no"       => "required",
            "data.*.amount_collected" => "required|numeric|min:1",
            "data.*.collection_type"  => "required|string|in:DD,MD",
            "data.*.deposite_amount"  => "required|numeric|min:1",
            "data.*.member_name"      => "required|string|min:1",
            "data.*.accountmaster_id" => "required",
            "data.*.member_id"        => "required|exists:accountmaster,MemberId",
        ];
    }
    public function prepareData()
    {
        $all = collect($this->all()["data"]);
        return $all->map(function($row){
            $row["status"] = 1231;
            return $row;
        })->toArray();

    }
}
