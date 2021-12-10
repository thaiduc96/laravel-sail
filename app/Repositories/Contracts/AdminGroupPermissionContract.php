<?php

namespace App\Repositories\Contracts;

interface AdminGroupPermissionContract extends BaseContract
{
    public function getPermissionIds($groupId);
}
