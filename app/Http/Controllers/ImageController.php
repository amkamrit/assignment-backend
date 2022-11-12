<?php

namespace App\Http\Controllers;

use App\Http\Contracts\ImageStoreIntreface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \Unsplash as Unsplash;
use Storage;
use App\Http\Controllers\MasterController\MasterController;
use App\Http\Resources\ImageResource;
use Response;
use DB;
use Illuminate\Support\Facades\Artisan;

class ImageController extends Controller
{
    // public  $whichModel;
    // public  $responseResource;
    public $image;
    public  function __construct(ImageStoreIntreface $imageInterface){
        $this->image=$imageInterface;
        // $this->whichModel=app('App\Models\Image');
        // $this->responseResource=ImageResource::class;
        // Artisan::call('download-image');
         unsplash_init();
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){
            $search = $request->payload;
            $page = 1;
            $per_page = 1;
            $orientation = 'landscape';
            //if we want to fetch more date form server, we can used jobs, fetching server is slow proess, jobs run request background
        $data=Unsplash\Search::photos($search, $page, $per_page, $orientation);
        return $image=$this->image->imageStoreFunction($data);
        // return  $image = $this->imageStoreFunction($data);
    }
    public function getImage(){
       try{
            $model=$this->whichModel;
            $model=$model->latest()->paginate(10);
            return $this->responseResource::collection($model)
                ->response()
                ->setStatusCode(200);
        }catch (Exception $e){
            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}