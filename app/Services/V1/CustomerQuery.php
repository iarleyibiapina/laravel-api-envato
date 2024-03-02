<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery
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

    // now is possible apply filters on URL like
    // ?postalCode[gt]=3000

    public function transform(Request $request)
    {
        $eloQuery = [];
        foreach ($this->safeParms as $parm => $operators) {
            // query string of url
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
