<?php

namespace App\Exceptions;

class ErrorCode
{
    const SERVER_ERROR = 'server_error';
    const NOT_FOUND = 'not_found';
    const VALIDATION_ERROR = 'validation_error';
    const USER_TOKEN_EXPIRED = 'user_token_expired';
    const USER_UNAUTHORIZED = 'user_unauthorized';
    const CLIENT_UNAUTHORIZED = 'client_unauthorized';
    const ACTION_UNAUTHORIZED = 'action_unauthorized';
    const FORBIDDEN = 'forbidden';
    const CODE_UNIQUE = 'code_unique';

    const APARTMENT_NOT_FOUND = 'apartment_not_found';
    const PRODUCT_NOT_FOUND = 'product_not_found';
    const WAREHOUSE_NOT_FOUND = 'warehouse_not_found';
    const PROVIDER_NOT_FOUND = 'provider_not_found';
    const DATE_IS_REQUIRED = 'date_is_required';
    const METER_NOT_FOUND = 'meter_not_found';
    const TIME_IMPORT_INVALID = 'time_invalid';
    const QUOTA_TYPE_INVALID = 'quota_type_invalid';
    const METER_EXISTS = 'meter_exist';
    const VALUE_NOT_VALID = 'value_not_valid';
    const METER_FEE_ALREADY_IMPORTED = 'meter_fee_already_imported';

}
