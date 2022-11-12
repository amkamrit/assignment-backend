<?php 
namespace App\Http\Repository;

use App\Http\Contracts\storeInterface;
use Illuminate\Http\Request;
use Storage;
use App\Http\Resources\ImageResource;
use Response;
use DB;

class ImageStoreRepository implements ImageStoreIntreface{
    public  function __construct(){
        $this->whichModel=app('App\Models\Image');
        $this->responseResource=ImageResource::class;
        Artisan::call('download-image');
        // unsplash_init();
    }
    public function imageStoreFunction($data){
        DB::beginTransaction();
        try {
            $path = $data[0]['links']['download'];
            $name = time().'.png';
            Storage::disk('local')->put($name, file_get_contents($path));
            $path = Storage::path($name);
            $model=new $this->whichModel;
            $model->url='/storage/'.$name;
            $model->title=$data[0]['links']['download'];
            $model->save();
            DB::commit();
            if ($model instanceof $this->whichModel) {
                return (new $this->responseResource($model))->response()->setStatusCode(200);
            } else {
                return Response::json([
                    'code' => 400,
                    'data' => $model,
                ], 400);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return Response::json([
                'code' => 500,
                'message' => 'Something went Wrong',
                'devMessage' => $e->getMessage(),
            ], 500);
        }
    }
}