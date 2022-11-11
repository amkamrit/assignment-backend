<?php

namespace App\Http\Controllers\MasterController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Storage;
class MasterController extends Controller
{
    public function imageStoreFunction($data)
    {
        DB::beginTransaction();
        try {
            $path = $data[0]['links']['download'];
            $name = time().'.png';
            Storage::disk('local')->put($name, file_get_contents($path));
            $path = Storage::path($name);
            $model=new $this->whichModel;
            $model->url='/storage/'.$name;
            $model->save();
            DB::commit();
            if (method_exists(new $this->whichModel(), 'afterCreateProcess')) {
                $model->afterCreateProcess();
            }
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
