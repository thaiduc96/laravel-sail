<?php 
 namespace App\Http\Resources\MenuPermission;
        use Illuminate\Http\Resources\Json\ResourceCollection;

        class MenuPermissionCollection extends ResourceCollection
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
                    "data" => MenuPermissionResource::collection($this->collection),
                    "current_page" => $this->currentPage(),
                    "last_page" => $this->lastPage(),
                    "total" => $this->total(),
                    "per_page" => $this->perPage(),
                ];
            }
        }
        