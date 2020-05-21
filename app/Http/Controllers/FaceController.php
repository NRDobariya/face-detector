<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FaceController extends Controller
{
    public function index()
    {
        return view('face');
    }
    public function store(Request $request)
    {
        $image_base64 = base64_encode(file_get_contents($request->file('image')));
        $path_name = $request->file('image')->getClientOriginalName();
        $client =  new \GuzzleHttp\Client();
        $res = $client->post('https://www.betafaceapi.com/api/v2/media', [
            'json' => [
                'api_key' => 'd45fd466-51e2-4701-8da8-04351c872236',
                'detection_flags' => "cropface,recognition,content,classifiers,basicpoints,propoints",
                'file_base64' => $image_base64,
                'original_filename' => $path_name
            ] 
        ]);

            if ($res->getStatusCode() == 200) { // 200 OK
                $response_data = $res->getBody()->getContents();
                $res = json_decode($response_data); 
                // dd(json_decode($response_data));
               $croppedImage =  $this->getCropImage($res->media->faces[0]->face_uuid);
               return view('face',compact('croppedImage'));
            }   
    }
    public function getCropImage($uid)
    {
        $client =  new \GuzzleHttp\Client();
        $url = "https://www.betafaceapi.com/api/v2/face/cropped?api_key=d45fd466-51e2-4701-8da8-04351c872236&face_uuid=".$uid;
        $res = $client->get($url);
        if ($res->getStatusCode() == 200) { // 200 OK
            $response_data = $res->getBody()->getContents();
            $res = json_decode($response_data);
            //  dd(json_decode($response_data));
            return $res;
        } 
    }
}
