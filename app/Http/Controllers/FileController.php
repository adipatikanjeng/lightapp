<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Files;

use Request;


class FileController extends BaseController
{
    function __construct(Files $files)
    {       
        $this->model = $files;
    }

    public function upload()
    {
        $file = Request::file('file');

        $temp_name = explode(".", $file->getClientOriginalName());
        $filename = strtolower($temp_name[0]."_".date('mdYhis')).".".end($temp_name);
        Storage::put($filename,  File::get($file));

        $model = $this->model;
        $model->name = $filename;
        $model->user_id = \Auth::user()->id;
        $model->save();

        return response()->json('success');
    }

    public function delete($name)
    {
        Storage::delete($name);
        $model = $this->model->whereName($name)->first();
        $model->delete();

        return response()->json('success');
    }


    public function lists(){


        $files = Storage::files('/');
        $model = $this->model->whereUserId(\Auth::user()->id)->select('name')->orderBy('created_at', 'DESC')->get();
          
        return response()->json($model->toArray() );

    }

    public function view($name){

        return response()->make(Storage::get($name), 200, [
            'Content-Type' => Storage::mimeType($name),
            'Content-Disposition' => 'inline; '.$name,
            ]);

    }


}
