<?php 
 namespace App\Http\Resources\Menu;
        use Illuminate\Http\Resources\Json\JsonResource;

        class MenuResource extends JsonResource
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
        