<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoiceFilter extends ApiFilter
{
    // equals to, greate than, less than, not equals
    protected $safeParms = [
        'customer_id'  => ['eq'],
        'amount'       => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'status'       => ['eq', 'ne'],
        'billed_date'  => ['eq'],
        'paid_date'    => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate'   => 'paid_date',
    ];

    protected $operatorMap = [
        'eq'  => '=',
        'lt'  => '<',
        'lte' => '<=',
        'gt'  => '>',
        'gte' => '=>',
        'ne' => '!=',
    ];
}
