<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TempDepositeRequest;
use App\Models\TempDeposite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepositeController extends Controller
{
    public function store_temp_deposite(TempDepositeRequest $request)
    {

        $user = auth()->user();
        // dd("ok");
        $data = $this->prepareDataForCreate($request);

        try {
            foreach ($data as $row) {

                TempDeposite::create($row);
            }

            return response()->json([
                "message" => "Successfully submitted.",
                "status"  => true,
            ]);

        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();
            return response()->json([
                "message" => "Whoops! data save failed. try again later.",
                "status"  => false,
                "data"    => [],
            ]);
        }

    }
    private function prepareDataForCreate(Request $request): array
    {
        $user  = auth()->user();
        $array = [];

        foreach ($request->get("data") as $row) {
            $array[] = $this->makeData($row, $user);
        }
        return $array;
    }
    private function makeData(array $row, $user): array
    {

        return [
            'account_no'       => $row["account_no"],
            'amount_collected' => $row["amount_collected"],
            'collection_type'  => $row["collection_type"],
            'deposite_amount'  => $row["deposite_amount"],
            'member_name'      => $row["member_name"],
            'member_id'        => $row["member_id"],
            'deposite'         => $row["deposite"] ?? "",
            'lo_id'            => $user->id,
            'collected_by'     => $row["collected_by"],
            'collected_date'        => $row["collected_date"],
            'accountmaster_id' => $row["accountmaster_id"],
            'status'           => 1,

        ];
    }
}
