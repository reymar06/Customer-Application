<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function getCustomerInformation(){

        $data = DB::connection("mysql")
        ->table("customerinformation")
        ->whereNull("deleted_at")
        ->get();

        return $data;
    }

    public function addInformation(Request $req){
        DB::connection("mysql")
        ->table("customerinformation")
        ->insert([
            "firstname" => $req->firstname,
            "lastname" => $req->lastname,
            "emailaddress" => $req->emailaddress,
            "contactnumber" => $req->contactnumber,
            "created_by" => $req->firstname
        ]);
    }

    public function updateCustomerInformation(Request $data){
        DB::connection("mysql")
        ->table("customerinformation")
        ->where("id",$data->id)
        ->update([
            "firstname" =>$data->firstname,
            "lastname" => $data->lastname,
            "emailaddress" => $data->emailaddress,
            "contactnumber"=> $data->contactnumber,
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
    }
    public function deleteCustomerInfo(Request $data){
        DB::connection("mysql")
        ->table("customerinformation")
        ->where("id", $data->id)
        ->update([
            "deleted_at" => date("Y-m-d H:i:s"),
        ]);

    }
}
