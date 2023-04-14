<?php


function responseSuccess($data = [], $status_code = 200, $status = 'success')
    {
        return response()->json([
            "data" => $data,
            "status" => $status,
            "status_code" => $status_code
        ], $status_code);
    }

    function responseFail( $error_msg = null, $status_code = 400,$status = 'fail')
    {
        return response()->json([
            "error_msg" => $error_msg,
            "status" => $status,
            "status_code" => $status_code
        ], $status_code);
    }