<?php 
 namespace App\Http\Resources\Admin;
        use Illuminate\Http\Resources\Json\ResourceCollection;

        class AdminCollection extends ResourceCollection
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
                    "data" => AdminResource::collection($this->collection),
                    "current_page" => $this->currentPage(),
                    "last_page" => $this->lastPage(),
                    "total" => $this->total(),
                    "per_page" => $this->perPage(),
                ];
            }
        }
        