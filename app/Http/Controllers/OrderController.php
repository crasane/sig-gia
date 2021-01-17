<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\TravelPackage;
use App\Order;

use Exception;

class OrderController extends Controller
{

    /**
     * Create a new Business Object instance.
     *
     * @return void
     */
    public function __construct(
    )
    {
    }

    /**
     * addOrder
     * @return Response
     */
    public function addOrder(Request $request)
    {
        try{

            \Log::debug("REQUEST");
            \Log::debug($request->all());

            $travel_package_id  = $request->travel_package_id;
            $name               = $request->name;
            $phone              = $request->phone;
            $message            = $request->message;

            /* List Validasi
            * 1. Validasi Travel Package Id tidak boleh kosong
            * 2. Validasi Travel Package Id harus terdaftar di Sistem
            * 3. Name Tidak boleh kosong
            * 4. Phone Tidak boleh kosong
            * 5. Phone harus angka
            */

            // 1. Validasi Travel Package Id tidak boleh kosong
            if($travel_package_id == '' || $travel_package_id == NULL){
                throw new Exception("Travel Package Id tidak boleh kosong");
            }

            // 2. Validasi Travel Package Id harus terdaftar di Sistem
            $TravelPackage = TravelPackage::find($travel_package_id);

            if(is_null($TravelPackage)){
                throw new Exception("Travel Package Id tidak terdaftar di sistem");
            }

            // 3. Name Tidak boleh kosong
            if($name == '' || $name == NULL){
                throw new Exception("Name tidak boleh kosong");
            }

            // 4. Phone Tidak boleh kosong
            if($phone == '' || $phone == NULL){
                throw new Exception("Phone tidak boleh kosong");
            }

            // 5. Phone harus angka
            if(!is_numeric($phone)){
                throw new Exception("Phone harus angka");
            }

            $Order = new Order();

            $Order->travel_package_id   = $travel_package_id;
            $Order->name                = $name;
            $Order->phone               = $phone;
            $Order->message             = $message;

            $Order->save();
            
            return response()->json(["message"  => "Submit Success, Our People will Contact you"]);

        } catch(Exception $ex) {

            \Log::debug("Exception");
            \Log::debug($ex->getMessage());

            return response()->json(["message"  => $ex->getMessage()]);

        }

    }

}