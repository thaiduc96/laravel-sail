<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repository {nameRepository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modelName = $this->argument('nameRepository');

//        $moduleName = $this->option('module');

        $facadePath = app_path('/Facades') . '/' . $modelName . 'Facade.php';
        $cachePath = app_path('/Repositories/Cache') . '/' . $modelName . 'RepositoryCache.php';
        $contractPath = app_path('/Repositories/Contracts') . '/' . $modelName . 'Contract.php';
        $eloquentPath = app_path('/Repositories/Eloquents') . '/' . $modelName . 'RepositoryEloquent.php';
        $repoFacadePath = app_path('/Repositories/Facades') . '/' . $modelName . 'Repository.php';
        $servicePath = app_path('/Services') . '/' . $modelName . 'Service.php';

        if (!file_exists($servicePath) or !file_exists($facadePath) or !file_exists($cachePath) or !file_exists($contractPath) or !file_exists($eloquentPath) or !file_exists($repoFacadePath)) {
            $this->_createFacade($modelName, $facadePath);
            $this->_createService($modelName, $servicePath);

            $this->_createCache($modelName, $cachePath);
            $this->_createContract($modelName, $contractPath);
            $this->_createEloquent($modelName, $eloquentPath);
            $this->_createRepositoryFacade($modelName, $repoFacadePath);

//            $this->_createController($modelName, $moduleName);
//            $this->_createCreateRequest($modelName, 'Create', $moduleName);
//            $this->_createCreateRequest($modelName, 'Update', $moduleName);
//            $this->_createCollection($modelName, $moduleName);
//            $this->_createResource($modelName, $moduleName);
        } else {
            var_dump('File Exits');
        }
    }
//
//    private function _createCollection($modelName, $module = null)
//    {
//        $resourceName = $modelName . "Collection";
//        if($module){
//            $folderPath = app_path("/Modules/$module/Http/Resources/$modelName");
//            $folder = app_path("/Modules/$module/Http/Resources");
//        }else{
//            $folderPath = app_path("Http/Resources/$modelName");
//            $folder = app_path("Http/Resources");
//        }
//        if (!file_exists($folder)) {
//            mkdir($folder, 7);
//        }
//        if (!file_exists($folderPath)) {
//            mkdir($folderPath, 7);
//        }
//        $path = $folderPath . '/' . $resourceName . ".php";
//
//        if (!file_exists($folderPath)) {
//            mkdir($folderPath, 7);
//        }
//
//        $myfile = fopen($path, "w");
//        $txt = "<?php \n";
//
//        if($module){
//            $txt .= ' namespace App\Modules\\' . $module . '\Http\Resources\\' . $modelName . ';';
//        }else{
//            $txt .= ' namespace App\Http\Resources\\' . $modelName . ';';
//        }
//
//        $txt .= '
//        use Illuminate\Http\Resources\Json\ResourceCollection;
//
//        class ' . $modelName . 'Collection extends ResourceCollection
//        {
//            /**
//             * Transform the resource collection into an array.
//             *
//             * @param \Illuminate\Http\Request $request
//             * @return array
//             */
//            public function toArray($request)
//            {
//                $arrayParent = parent::toArray($request);
//                return array_merge($arrayParent,[
//                    "data" =>  ' . $modelName . 'Resource::collection($this->collection),
//                ]);
//            }
//        }
//        ';
//        fwrite($myfile, $txt);
//        fclose($myfile);
//    }
//
//    private function _createResource($modelName, $module = null)
//    {
//        $resourceName = $modelName . "Resource";
//        if($module){
//            $folderPath = app_path("/Modules/$module/Http/Resources/$modelName");
//        }else{
//            $folderPath = app_path("Http/Resources/$modelName");
//        }
//
//        $path = $folderPath . '/' . $resourceName . ".php";
//        if (!file_exists($folderPath)) {
//            mkdir($folderPath, 7);
//        }
//
//        $myfile = fopen($path, "w");
//        $txt = "<?php \n";
//        if($module){
//            $txt .= 'namespace App\Modules\\' . $module . '\Http\Resources\\' . $modelName . ';';
//        }else{
//            $txt .= ' namespace App\Http\Resources\\' . $modelName . ';';
//        }
//
//        $txt .= '
//        use Illuminate\Http\Resources\Json\JsonResource;
//
//        class ' . $modelName . 'Resource extends JsonResource
//        {
//            /**
//             * Transform the resource into an array.
//             *
//             * @param \Illuminate\Http\Request $request
//             * @return array
//             */
//            public function toArray($request)
//            {
//               return parent::toArray($request);
//            }
//        }
//        ';
//        fwrite($myfile, $txt);
//        fclose($myfile);
//    }
//
//    private function _createCreateRequest($modelName, $type, $module = null)
//    {
//        $requestName = $type . $modelName . "Request";
//        if($module){
//            $folderPath = app_path("/Modules/$module/Http/Requests/$modelName");
//            $folder = app_path("/Modules/$module/Http/Requests");
//        }else{
//            $folderPath = app_path("Http/Requests/$modelName");
//            $folder =  app_path("Http/Requests");
//        }
//        if (!file_exists($folder)) {
//            mkdir($folder, 7);
//        }
//
//        $path = $folderPath . '/' . $requestName . ".php";
//        if (!file_exists($folderPath)) {
//            mkdir($folderPath, 7);
//        }
//
//        $myfile = fopen($path, "w");
//        $txt = "<?php \n";
//        fwrite($myfile, $txt);
//
//        if($module){
//            $txt .= "namespace App\Modules\\$module\Http\Requests\\$modelName;";
//        }else{
//            $txt .= " namespace App\Http\Requests\\$modelName;";
//        }
//
//        $txt .= "
//        use Illuminate\Foundation\Http\FormRequest;
//        class " . $requestName . " extends FormRequest
//        {
//            /**
//             * Determine if the user is authorized to make this request.
//             *
//             * @return bool
//             */
//            public function authorize()
//            {
//                return true;
//            }
//            /**
//             * Get the validation rules that apply to the request.
//             *
//             * @return array
//             */
//            public function rules()
//            {
//                return [
//                ];
//            }
//        }
//        ";
//        fwrite($myfile, $txt);
//        fclose($myfile);
//
//    }
//
//    private function _createController($modelName, $module = null)
//    {
//        $controllerName = $modelName . "Controller";
//        if($module){
//            $path = app_path("/Modules/$module/Http/Controllers/") . '/' . $controllerName . ".php";
//        }else{
//            $path = app_path("Http/Controllers/") . '/' . $controllerName . ".php";
//        }
//
//        $myfile = fopen($path, "w");
//        $txt = "<?php \n";
//        fwrite($myfile, $txt);
//
//        if($module){
//            $txt = "namespace App\Modules\\$module\Http\Controllers; \n \n";
//            $txt .= "use Illuminate\Http\Request; \n";
//            $txt .= "use Illuminate\Support\Facades\DB; \n";
//            $txt .= "use App\Facades\\" . $modelName . "Facade; \n";
//            $txt .= "use App\Http\Controllers\Controller; \n";
//            $txt .= "use App\Modules\\$module\Http\Resources\\$modelName\\" . $modelName . "Resource; \n";
//            $txt .= "use App\Modules\\$module\Http\Resources\\$modelName\\" . $modelName . "Collection; \n";
//            $txt .= "use App\Modules\\$module\Http\Requests\\$modelName\Create" . $modelName . "Request; \n";
//            $txt .= "use App\Modules\\$module\Http\Requests\\$modelName\Update" . $modelName . "Request; \n";
//            $txt .= "class $controllerName extends Controller \n { \n";
//            $txt .= 'public function index(Request $request){  ';
//            $txt .= '$res = ' . $modelName . 'Facade::filter($request->all()); ';
//            $txt .= '  return $this->successResponse(new ' . $modelName . 'Collection($res));  } ';
//        }else{
//            $txt = "namespace App\Http\Controllers; \n \n";
//            $txt .= "use Illuminate\Http\Request; \n";
//            $txt .= "use Illuminate\Support\Facades\DB; \n";
//            $txt .= "use App\Facades\\" . $modelName . "Facades; \n";
//            $txt .= "use App\Http\Controllers\Controller; \n";
//            $txt .= "use App\Http\Resources\\$modelName\\" . $modelName . "Resource; \n";
//            $txt .= "use App\Http\Resources\\$modelName\\" . $modelName . "Collection; \n";
//            $txt .= "use App\Http\Requests\\$modelName\Create" . $modelName . "Request; \n";
//            $txt .= "use App\Http\Requests\\$modelName\Update" . $modelName . "Request; \n";
//            $txt .= "class $controllerName extends Controller \n { \n";
//            $txt .= 'public function index(Request $request){  ';
//            $txt .= '$res = ' . $modelName . 'Facade::filter($request->all()); ';
//            $txt .= '  return $this->successResponse(new ' . $modelName . 'Collection($res));  } ';
//        }
//
//        fwrite($myfile, $txt);
//
//        $txt = 'public function create(Create' . $modelName . 'Request $request)
//                {
//                    DB::beginTransaction();
//                    try {
//                        $data = ' . $modelName . 'Facade::create($request->all());
//                        $data = ' . $modelName . 'Facade::find($data->id);
//                        DB::commit();
//                    } catch (\Exception $ex) {
//                        DB::rollBack();
//                        throw $ex;
//                    }
//                    return $this->successResponse(new ' . $modelName . 'Resource($data));
//                }';
//        fwrite($myfile, $txt);
//
//
//        $txt = 'public function update(Update' . $modelName . 'Request $request, $id)
//                {
//                    DB::beginTransaction();
//                    try {
//                        $data = ' . $modelName . 'Facade::update($id, $request->all());
//                        $data = ' . $modelName . 'Facade::find($data->id);
//                        DB::commit();
//                    } catch (\Exception $ex) {
//                        DB::rollBack();
//                        throw $ex;
//                    }
//                    return $this->successResponse(new ' . $modelName . 'Resource($data));
//                }';
//        fwrite($myfile, $txt);
//
//        $txt = 'public function show($id)
//            {
//                $model = ' . $modelName . 'Facade::find($id);
//                return $this->successResponse(new ' . $modelName . 'Resource($model));
//            }';
//        fwrite($myfile, $txt);
//
//        $txt = '
//            public function delete($id)
//            {
//                DB::beginTransaction();
//                try {
//                    ' . $modelName . 'Facade::delete($id);
//                    DB::commit();
//                } catch (\Exception $ex) {
//                    DB::rollBack();
//                    throw $ex;
//                }
//                return $this->successResponse(true);
//            }';
//        fwrite($myfile, $txt);
//
//        $txt = "  } \n";
//        fwrite($myfile, $txt);
//
//        fclose($myfile);
//    }

    private function _createRepositoryFacade($name, $path)
    {
        $name = $name . "Repository";
        $myfile = fopen($path, "w");
        $txt = "<?php \n";
        fwrite($myfile, $txt);

        $txt = "namespace App\Repositories\Facades;\n \n";
        fwrite($myfile, $txt);


        $txt = "use Illuminate\Support\Facades\Facade; \n\n";
        fwrite($myfile, $txt);

        $txt = "class $name extends Facade \n { \n";
        fwrite($myfile, $txt);

        $txt = "    protected static function getFacadeAccessor(){ return self::class; }  \n } \n";
        fwrite($myfile, $txt);

        fclose($myfile);
    }

    private function _createEloquent($name, $path)
    {
        $nameClass = $name . "RepositoryEloquent";
        $nameContract = $name . "Contract";
        $myfile = fopen($path, "w");
        $txt = "<?php \n\n";
        fwrite($myfile, $txt);

        $txt = 'namespace App\Repositories\Eloquents;';
        fwrite($myfile, $txt);

        $txt = "\n \n";
        fwrite($myfile, $txt);

        $txt = "use App\Models\\$name;\n";
        fwrite($myfile, $txt);
        $txt = "use App\Repositories\Contracts\\$nameContract;\n";
        fwrite($myfile, $txt);
        $txt = "use Illuminate\Database\Eloquent\Model;\n";
        fwrite($myfile, $txt);

        $txt = "\n \n";
        fwrite($myfile, $txt);


        $txt = "class $nameClass extends BaseRepositoryEloquent implements $nameContract \n";
        fwrite($myfile, $txt);

        $txt = "{\n";
        fwrite($myfile, $txt);

        $txt = "public function getModel(): Model \n { \n";
        fwrite($myfile, $txt);


        $txt = "return new $name; \n } \n";
        fwrite($myfile, $txt);

        $txt = "}\n";
        fwrite($myfile, $txt);

        fclose($myfile);
    }

    private function _createContract($name, $path)
    {
        $name = $name . "Contract";
        $myfile = fopen($path, "w");
        $txt = "<?php \n\n";
        fwrite($myfile, $txt);

        $txt = 'namespace App\Repositories\Contracts;';
        fwrite($myfile, $txt);

        $txt = "\n \n";
        fwrite($myfile, $txt);

        $txt = "interface $name extends BaseContract";
        fwrite($myfile, $txt);

        $txt = "\n";
        fwrite($myfile, $txt);
        $txt = "{\n}";
        fwrite($myfile, $txt);

        fclose($myfile);
    }

    private function _createCache($name, $path)
    {
        $name = $name . "RepositoryCache";
        $myfile = fopen($path, "w");
        $txt = "<?php \n";
        fwrite($myfile, $txt);

        $txt = 'namespace App\Repositories\Cache;';
        fwrite($myfile, $txt);

        $txt = "\n";
        fwrite($myfile, $txt);

        $txt = "use Illuminate\Support\Facades\Cache;";
        fwrite($myfile, $txt);

        $txt = "\n";
        fwrite($myfile, $txt);

        $txt = "class $name extends BaseRepositoryCache";
        fwrite($myfile, $txt);

        $txt = "\n";
        fwrite($myfile, $txt);
        $txt = '{}';
        fwrite($myfile, $txt);

        fclose($myfile);
    }

    private function _createService($modelName, $path)
    {
        $name = $modelName . "Service";
        $myfile = fopen($path, "w");
        $txt = "<?php \n\n";
        fwrite($myfile, $txt);

        $txt = '
namespace App\Services;

use App\Repositories\Facades\\'.$modelName.'Repository;
use Illuminate\Database\Eloquent\Model;

class '.$modelName.'Service
{
    public function filter($filter)
    {
        $list = '.$modelName.'Repository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = '.$modelName.'Repository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = '.$modelName.'Repository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = '.$modelName.'Repository::findOrFail($id);
        $res = '.$modelName.'Repository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : '.$modelName.'Repository::find($model);
        return '.$modelName.'Repository::delete($model);
    }

    public function recovery($model)
    {
        return '.$modelName.'Repository::recovery($model);
    }
}
        ';
        fwrite($myfile, $txt);

        fclose($myfile);
    }

    private function _createFacade($name, $path)
    {
        $name = $name . "Facade";
        $myfile = fopen($path, "w");
        $txt = "<?php \n";
        fwrite($myfile, $txt);

        $txt = 'namespace App\Facades;';
        fwrite($myfile, $txt);

        $txt = "\n";
        fwrite($myfile, $txt);

        $txt = "use Illuminate\Support\Facades\Facade;";
        fwrite($myfile, $txt);

        $txt = "\n";
        fwrite($myfile, $txt);

        $txt = "class $name extends Facade";
        fwrite($myfile, $txt);

        $txt = "\n";
        fwrite($myfile, $txt);

        $txt = '{';
        fwrite($myfile, $txt);

        $txt = "\n";
        fwrite($myfile, $txt);

        $txt = '    protected static function getFacadeAccessor(){ return self::class; }';
        fwrite($myfile, $txt);

        $txt = " \n";
        fwrite($myfile, $txt);

        $txt = '} ';
        fwrite($myfile, $txt);

        fclose($myfile);
    }
}
