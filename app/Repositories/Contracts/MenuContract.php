<?php

namespace App\Repositories\Contracts;

interface MenuContract extends BaseContract
{
    public function getByAdminPermissionIds($adminPermissionIds);
}
