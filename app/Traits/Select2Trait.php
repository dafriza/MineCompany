<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Select2Trait
{
    /**
     * Reusable Select2 response with optional query customization
     *
     * @param \Illuminate\Http\Request $request
     * @param string $modelClass
     * @param string $searchColumn
     * @param string[] $selectColumns
     * @param int $perPage
     * @param \Closure|null $customQuery
     * @return \Illuminate\Http\JsonResponse
     */
    public function select2Response(Request $request, string $modelClass, string $searchColumn = 'name', array $selectColumns = ['id', 'name'], int $perPage = 10, \Closure $customQuery = null)
    {
        $term = (string) $request->get('q', '');
        $page = max((int) $request->get('page', 1), 1);

        $query = $modelClass
            ::query()
            ->select($selectColumns)
            ->when($term !== '', function ($q) use ($term, $searchColumn) {
                $q->where($searchColumn, 'like', "%{$term}%");
            });

        // Apply custom query filter if provided
        if ($customQuery) {
            $customQuery($query);
        }

        $query->orderBy($searchColumn);

        $offset = ($page - 1) * $perPage;
        $items = $query
            ->skip($offset)
            ->take($perPage + 1)
            ->get();
        $hasMore = $items->count() > $perPage;

        $results = $items->take($perPage)->map(function ($row) use ($searchColumn) {
            return [
                'id' => $row->id,
                'text' => $row->{$searchColumn},
            ];
        });

        return response()->json([
            'results' => $results,
            'pagination' => ['more' => $hasMore],
        ]);
    }
}
