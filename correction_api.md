/** 
    /all 
*/

1. model
    public function scopeInactive($q)
    {
        return $q->where('status', 'inactive');
    }

2. all
    $pageLimit = request()->input('limit') ?? 10;
    $orderByColumn = request()->input('sort_by_col') ?? 'id';
    $orderByType = request()->input('sort_type') ?? 'ASC';
    $status = request()->input('status') ?? 'active';
    $fields = request()->input('fields') ?? ['id', 'title', "status", 'slug','created_at'];

    if (request()->has('with')) {
        $with = array_merge($with, request()->with);
    }

    if (request()->has('condition')) {
        $condition = array_merge($condition, request()->condition);
    }

    $start_date = request()->input('start_date');
    $end_date = request()->input('end_date');
    if ($start_date && $end_date && $end_date > $start_date) {
        $data->where('created_at', '>=', $start_date);
        $data->where('created_at', '<=', $end_date);
    }

    return entityResponse([
        ...$data->toArray(),
        "active_data_count" => self::$model::active()->count(),
        "inactive_data_count" => self::$model::inactive()->count(),
    ]);

    search conditions

2. change delete method into post method
