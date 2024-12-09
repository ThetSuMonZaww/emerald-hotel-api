<?php
 namespace App\Helpers;

 class ResponseHelper{
     public static function success($status, $message, $data=[], $meta=null){
         return response()->json([
             'status' => $status,
             'message' => $message,
             'data' => $data,
             'meta' => $meta
         ]);
     }

     public static function fail($status, $message) {
         return response()->json([
             'status' => $status,
             'message' => $message
         ]);
     }
 }
?>
