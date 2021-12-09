<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorCode;
use App\Helpers\AuthHelper;
use App\Models\AdminPermission;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UnauthorizedException;

class CheckPermissionAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard(GUARD_ADMIN_API)->check()) {
            if($request->isMethod('GET')){
                return $next($request);
            }
            $user = AuthHelper::getUserApi(GUARD_ADMIN_API);
            $adminGroup = $user->adminGroup;
            if ($adminGroup->key === SUPER_ADMIN) {
                return $next($request);
            }
            $routeName = $request->route()->getName();

            $adminGroupId = $adminGroup->id;
            $permissionRoute = AdminPermission::query()
                ->where('route_name', 'ILIKE', "%$routeName::%")
                ->whereHas('adminGroups', function ($q) use ($adminGroupId) {
                    $q->where('admin_groups.id', $adminGroupId);
                })->exists();

            if ($permissionRoute) {
                return $next($request);
            }
        }
        throw new UnauthorizedException(__('Bạn không có quyền thực hiện thao tác này.'), 401, null, ErrorCode::USER_UNAUTHORIZED);
//        return redirect()->route('login');
    }
}
