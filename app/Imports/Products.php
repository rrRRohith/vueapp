<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Products implements ToModel, WithHeadingRow{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        try{
            if(isset($row['name']) && isset($row['sku']) && isset($row['price']))
                return \Auth::user()->products()->updateOrcreate([
                    'sku' => $row['sku'],
                ],[
                    "name" => $row['name'],
                    "price" => $row['price'],
                    'description' => $row['description'] ?? null,
                ]);
            return;
		}
		catch(\Exception $e){
			return;
		}
    }
}