<?php

namespace App\Filters;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProjectFilter
{
    // Predefined operations as per the request
    protected array $allowedOperators = ['=', '>', '<', 'LIKE'];

    protected array $projectFields = ['name', 'status', 'created_at'];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $query): Builder
    {
        foreach ($this->request->input('filters', []) as $key => $value) {

            if (is_array($value) && isset($value['operation'], $value['value'])) {
                $operator = strtoupper($value['operation']);
                $this->applyFilter($query, $key, $value['value'], $operator);
            } else {
                $this->applyFilter($query, $key, $value, '=');
            }
        }

        return $query;
    }

    private function isDateField(string $field): bool
    {
        return in_array($field, ['created_at', 'updated_at']);
    }


    private function applyFilter(Builder $query, $field, $value, $operator): void
    {
        // Only allowed the predefined operations
        if (!in_array($operator, $this->allowedOperators, true)) {
            return;
        }

        if (in_array($field, $this->projectFields)) {
            if ($this->isDateField($field)) {
                try {
                    // Convert the date value in to string
                    $value = Carbon::parse($value)->toDateString();
                } catch (\Exception $e) {
                    return;
                }
            }

            // These query only will work for the Project fields
            $query->where($field, $operator, $operator === 'LIKE' ? "%{$value}%" : $value);
        } else {
            // Here the query will do on the attributes
            $query->whereHas('attributeValues', function ($subQuery) use ($field, $value, $operator) {
                $subQuery->where(function ($subQuery) use ($field, $value, $operator) {
                    try {
                        // Convert the date value in to string
                        $value = Carbon::parse($value)->toDateString();
                    } catch (\Exception $e) {
                        return;
                    }

                    $subQuery->whereHas('attribute', function ($subQuery) use ($field, $value, $operator) {
                        $subQuery->where('name', $field)->where('type', 'date');
                    })->where('value', $operator, $value);

                })->orWhere(function ($subQuery) use ($field, $value, $operator) {
                    $subQuery->whereHas('attribute', function ($subQuery) use ($field, $value, $operator) {
                        $subQuery->where('name', $field);
                    })->where('value', $operator, $operator === 'LIKE' ? "%{$value}%" : $value);
                });

            });
        }
    }
}
