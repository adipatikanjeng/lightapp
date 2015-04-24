<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Request;



class FileController extends BaseController
{

    public function saveFile()
    {
        $file = Request::file('file');
        Storage::put($file->getClientOriginalName(),  File::get($file));

        return response()->json('success');
    }

    public function deleteFile($name)
    {
        Storage::delete($name);
        return response()->json('success');
    }


    public function getFileList(){

        $files = Storage::files('/');
        return response()->json($files);

    }

    public function viewFile($name){

        $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$name;


        return response()->make(file_get_contents($path), 200, [
            'Content-Type' => Storage::mimeType($name),
            'Content-Disposition' => 'inline; '.$name,
        ]);

    }


}
