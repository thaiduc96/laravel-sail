<?php

namespace App\Modules\AdminApi\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Api\Http\Requests\Auth\RegisterRequest;
use App\Modules\Api\Http\Resources\UserResource;
use App\Repositories\Facades\UserRepository;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = UserRepository::create($request->all());
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            throw $th;
        }

        return $this->successResponse(new UserResource($user));
    }

}
