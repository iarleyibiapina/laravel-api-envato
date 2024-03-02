<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter
{
    // equals to, greate than, less than
    protected $safeParms = [
        'name'       => ['eq'],
        'type'       => ['eq'],
        'email'      => ['eq'],
        'address'    => ['eq'],
        'city'       => ['eq'],
        'state'      => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap = [
        'eq'  => '=',
        'lt'  => '<',
        'lte' => '<=',
        'gt'  => '>',
        'gte' => '=>',
    ];
}
