<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // type: web, api
    protected $signature = 'create-controller {nameRepository} {--module=} {--type=}';
    //php artisan create-controller Handle --module=Admin --type=web

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $modelName = $this->argument('nameRepository');
        $moduleName = $this->option('module');
        $type = $this->option('type');

        $this->_createController($modelName, $type, $moduleName);
        $this->_createCreateRequest($modelName, 'Create', $moduleName);
        $this->_createCreateRequest($modelName, 'Update', $moduleName);
        $this->_createCollection($modelName, $moduleName);
        $this->_createResource($modelName, $moduleName);
        $this->_createRoute($modelName, $moduleName);
    }

    private function _createRoute($modelName, $module = null){
        if ($module) {
            $folderPath = app_path("/Modules/$module/routes/item");
        } else {
            $folderPath = base_path("routes/item");
        }
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 7);
        }
        $modelSnake = Str::snake($modelName);
        $path = $folderPath . '/' . $modelSnake . ".php";
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 7);
        }

        $myfile = fopen($path, "w");
        $txt = "<?php \n";
        $modelSnake = Str::snake($modelName,'-');
        if ($module) {
            $txt .= 'use Illuminate\Support\Facades\Route;';
        } else {
            $txt .= 'use App\Http\Controllers\\' . $modelName . 'Controller;';
        }

        $txt .= '
            use Illuminate\Support\Facades\Route;
            Route::group([ "middleware" => ""], function () {
            Route::get("' . $modelSnake . 's/options", [' . $modelName . 'Controller::class,"options"])->name("' . $module . '.' . $modelSnake . 's.options");
            Route::apiResource("' . $modelSnake . 's", ' . $modelName . 'Controller::class, ["as" => "' . $module . '"]);
        });
        ';
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    private function _createCollection($modelName, $module = null)
    {
        $resourceName = $modelName . "Collection";
        if ($module) {
            $folderPath = app_path("/Modules/$module/Http/Resources/$modelName");
            $folder = app_path("/Modules/$module/Http/Resources");
        } else {
            $folderPath = app_path("Http/Resources/$modelName");
            $folder = app_path("Http/Resources");
        }
        if (!file_exists($folder)) {
            mkdir($folder, 7);
        }
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 7);
        }
        $path = $folderPath . '/' . $resourceName . ".php";

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 7);
        }

        $myfile = fopen($path, "w");
        $txt = "<?php \n";

        if ($module) {
            $txt .= ' namespace App\Modules\\' . $module . '\Http\Resources\\' . $modelName . ';';
        } else {
            $txt .= ' namespace App\Http\Resources\\' . $modelName . ';';
        }

        $txt .= '
        use Illuminate\Http\Resources\Json\ResourceCollection;

        class ' . $modelName . 'Collection extends ResourceCollection
        {
            /**
             * Transform the resource collection into an array.
             *
             * @param \Illuminate\Http\Request $request
             * @return array
             */
            public function toArray($request)
            {
                return [
                    "data" => ' . $modelName . 'Resource::collection($this->collection),
                    "current_page" => $this->currentPage(),
                    "last_page" => $this->lastPage(),
                    "total" => $this->total(),
                    "per_page" => $this->perPage(),
                ];
            }
        }
        ';
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    private function _createResource($modelName, $module = null)
    {
        $resourceName = $modelName . "Resource";
        if ($module) {
            $folderPath = app_path("/Modules/$module/Http/Resources/$modelName");
        } else {
            $folderPath = app_path("Http/Resources/$modelName");
        }

        $path = $folderPath . '/' . $resourceName . ".php";
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 7);
        }

        $myfile = fopen($path, "w");
        $txt = "<?php \n";
        if ($module) {
            $txt .= 'namespace App\Modules\\' . $module . '\Http\Resources\\' . $modelName . ';';
        } else {
            $txt .= ' namespace App\Http\Resources\\' . $modelName . ';';
        }

        $txt .= '
        use Illuminate\Http\Resources\Json\JsonResource;

        class ' . $modelName . 'Resource extends JsonResource
        {
            /**
             * Transform the resource into an array.
             *
             * @param \Illuminate\Http\Request $request
             * @return array
             */
            public function toArray($request)
            {
               return parent::toArray($request);
            }
        }
        ';
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    private function _createCreateRequest($modelName, $type, $module = null)
    {
        $requestName = $type . $modelName . "Request";
        if ($module) {
            $folderPath = app_path("/Modules/$module/Http/Requests/$modelName");
            $folder = app_path("/Modules/$module/Http/Requests");
        } else {
            $folderPath = app_path("Http/Requests/$modelName");
            $folder = app_path("Http/Requests");
        }
        if (!file_exists($folder)) {
            mkdir($folder, 7);
        }

        $path = $folderPath . '/' . $requestName . ".php";
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 7);
        }

        $myfile = fopen($path, "w");
        $txt = "<?php \n";

        if ($module) {
            $txt .= "namespace App\Modules\\$module\Http\Requests\\$modelName;";
        } else {
            $txt .= " namespace App\Http\Requests\\$modelName;";
        }

        $txt .= "
        use Illuminate\Foundation\Http\FormRequest;
        class " . $requestName . " extends FormRequest
        {
            /**
             * Determine if the user is authorized to make this request.
             *
             * @return bool
             */
            public function authorize()
            {
                return true;
            }
            /**
             * Get the validation rules that apply to the request.
             *
             * @return array
             */
            public function rules()
            {
                return [
                ];
            }
        }
        ";
        fwrite($myfile, $txt);
        fclose($myfile);

    }

    private function _createController($modelName, $type, $module = null)
    {
        $controllerName = $modelName . "Controller";
        $snakeModelName = Str::snake($modelName) ;

        $view = $module . "::" . $snakeModelName;
        if ($module) {
            $path = app_path("/Modules/$module/Http/Controllers/") . '/' . $controllerName . ".php";
        } else {
            $path = app_path("Http/Controllers/") . '/' . $controllerName . ".php";
        }

        $myfile = fopen($path, "w");
        $txt = "<?php \n";
        fwrite($myfile, $txt);

        if ($module) {
            $txt = "namespace App\Modules\\$module\Http\Controllers; \n \n";
            $txt .= "use Illuminate\Http\Request; \n";
            $txt .= "use Illuminate\Support\Facades\DB; \n";
            $txt .= "use App\Facades\\" . $modelName . "Facade; \n";
            $txt .= "use App\Models\\" . $modelName . "; \n";
            $txt .= "use App\Http\Controllers\Controller; \n";
            $txt .= "use App\Repositories\Facades\\" . $modelName . "Repository; \n";
            $txt .= "use App\Modules\\$module\Http\Resources\\$modelName\\" . $modelName . "Resource; \n";
            $txt .= "use App\Modules\\$module\Http\Resources\\$modelName\\" . $modelName . "Collection; \n";
            $txt .= "use App\Modules\\$module\Http\Requests\\$modelName\Create" . $modelName . "Request; \n";
            $txt .= "use App\Modules\\$module\Http\Requests\\$modelName\Update" . $modelName . "Request; \n";

        } else {
            $txt = "namespace App\Http\Controllers; \n \n";
            $txt .= "use Illuminate\Http\Request; \n";
            $txt .= "use Illuminate\Support\Facades\DB; \n";
            $txt .= "use App\Facades\\" . $modelName . "Facade; \n";
            $txt .= "use App\Repositories\Facades\\" . $modelName . "Repository; \n";
            $txt .= "use App\Http\Controllers\Controller; \n";
            $txt .= "use App\Http\Resources\\$modelName\\" . $modelName . "Resource; \n";
            $txt .= "use App\Http\Resources\\$modelName\\" . $modelName . "Collection; \n";
            $txt .= "use App\Http\Requests\\$modelName\Create" . $modelName . "Request; \n";
            $txt .= "use App\Http\Requests\\$modelName\Update" . $modelName . "Request; \n";
        }

        if ($type == 'api') {
            $txt .= "class $controllerName extends Controller \n { \n";
            $txt .= 'public function index(Request $request){  ';
            $txt .= '$res = ' . $modelName . 'Facade::filter($request->all()); ';
//            $txt .= '  return $this->successResponse(new ' . $modelName . 'Collection($res));  } ';
            $txt .= 'return $this->responseSuccessList($res, "'. $modelName .'"); }';

            $txt .= '
            public function options(Request $request)
            {
                try {
                    $data =  ' . $modelName . 'Repository::options($request->all());
                } catch (\Exception $e) {
                    $data = [];
                }
                return $this->successResponse($data);
            }
            ';
        } else {
            $txt .= "use Yajra\DataTables\Facades\DataTables;";
            $txt .= "class $controllerName extends Controller \n { \n";
            $txt .= 'public function index(Request $request){  ';

            $snakeModuleName = Str::snake($module);

            $snakeRouteModelName = Str::snake($modelName,'-') . "s";

            $route = $snakeModuleName . '.' . $snakeRouteModelName;
            $txt .= ' if ($request->ajax()) {
            $query = ' . $modelName . 'Repository::datatables($request->all())->withTrashed();
            return DataTables::of($query)
                ->addColumn("action", function ($model) {
                    $arrBtn = [];
                    $arrBtn["edit"] = route("' . $route . '.edit", $model->id);
                    if ($model->trashed()) {
                        $arrBtn["recovery"] = route("' . $route . '.recovery", $model->id);
                    } else {
                        $arrBtn["delete"] = route("' . $route . '.destroy", $model->id);
                    }
                    return view("' . $module . '::layouts.components.group-button", $arrBtn);
                })
                ->editColumn("status", function ($model) {
                    return view("' . $module . '::layouts.components.datatable-status", ["status" => $model->status]);
                })
                ->rawColumns(["status", "action"])
                ->make(true);
        }
        return view("' . $view . '.index"); }';

            $txt .= ' public function options(Request $request)
        {
            $response = ErrorFacade::options()->all());
            $response = Select2Helper::mapData($response, $request->page,"name");
            return $response;
        }';
            fwrite($myfile, $txt);

        }

        fwrite($myfile, $txt);

        $txt = 'public function store(Create' . $modelName . 'Request $request)
                {
                    DB::beginTransaction();
                    try {
                        $data = ' . $modelName . 'Facade::create($request->all());
                        DB::commit();
                    } catch (\Exception $ex) {
                        DB::rollBack();
                        throw $ex;
                    }
                    $data = ' . $modelName . 'Facade::find($data->id);
                    return $this->successResponse(new ' . $modelName . 'Resource($data));
                }';
        fwrite($myfile, $txt);

        if ($type == 'web') {
            $txt = 'public function create()
            {
                $model = new ' . $modelName . '();
                return view("' . $view . '.create", compact("model"));
            }';

            fwrite($myfile, $txt);


            $txt = 'public function edit($id)
                {
                    $model = ' . $modelName . 'Facade::find($id);
                    return view("' . $view . '.create", compact("model"));
                }';

            fwrite($myfile, $txt);
        }

        $txt = 'public function update(Update' . $modelName . 'Request $request, $id)
                {
                    DB::beginTransaction();
                    try {
                        $data = ' . $modelName . 'Facade::update($id, $request->all());
                        DB::commit();
                    } catch (\Exception $ex) {
                        DB::rollBack();
                        throw $ex;
                    }
                    $data = ' . $modelName . 'Facade::find($data->id);
                    return $this->successResponse(new ' . $modelName . 'Resource($data));
                }';
        fwrite($myfile, $txt);

        $txt = 'public function show($id)
            {
                $model = ' . $modelName . 'Facade::find($id);
                return $this->successResponse(new ' . $modelName . 'Resource($model));
            }';
        fwrite($myfile, $txt);

        $txt = '
            public function destroy($id)
            {
                DB::beginTransaction();
                try {
                    ' . $modelName . 'Facade::delete($id);
                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollBack();
                    throw $ex;
                }
                return $this->successResponse(true);
            }';
        fwrite($myfile, $txt);

        $txt = '
            public function recovery($id)
            {
                DB::beginTransaction();
                try {
                    ' . $modelName . 'Facade::recovery($id);
                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollBack();
                    throw $ex;
                }
                return $this->successResponse(true);
            }';
        fwrite($myfile, $txt);


        $txt = "  } \n";
        fwrite($myfile, $txt);

        fclose($myfile);
    }

}
