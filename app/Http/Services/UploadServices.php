<?php

namespace App\Http\Services;


class UploadService
{
    // public function store($request)
    // {
    //     // trước khi upload file kiểm tra xem file có tồn tại không
    //     if ($request->hasFile('file')) {
    //         try {
    //             $name = $request->file('file')->getClientOriginalName();
    //             $pathFull = 'uploads/' . date("Y/m/d");

    //             $request->file('file')->storeAs(
    //                 'public/' . $pathFull,
    //                 $name
    //             );

    //             return '/storage/' . $pathFull . '/' . $name;
    //         } catch (\Exception $error) {
    //             return false;
    //         }
    //     }
    // }

    public function store($request)
    {
        // trước khi upload file kiểm tra xem file có tồn tại không
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y/m/d");

                $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    $name
                );

                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return response()->json(['error' => true, 'message' => $error->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => true, 'message' => 'No file uploaded.'], 400);
        }
    }
}