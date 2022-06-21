<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function withHeaderPagination(LengthAwarePaginator $paginator)
    {
        return response($paginator->items())->withHeaders([
            'X-Current-Page' => $paginator->currentPage(),
            'X-Per-Page' => $paginator->perPage(),
            'X-Total-Page' => $paginator->lastPage(),
        ]);
    }
}
