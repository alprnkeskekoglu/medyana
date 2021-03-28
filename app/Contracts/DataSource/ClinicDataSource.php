<?php

namespace App\Contracts\DataSource;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClinicDataSource
{
    /**
     * @param Clinic $clinic
     * @return array
     */
    public function toArray(Clinic $clinic): array
    {
        return [
            'id' => $clinic->id,
            'status' => $clinic->status,
            'name' => $clinic->name,
            'equipment_count' => $clinic->equipments()->count(),
            'created_at' => $clinic->created_at->format('d/m/Y'),
        ];
    }

    /**
     * @param Collection $models
     * @return array
     */
    public function collection(Collection $models): array
    {
        $hold = [];

        foreach ($models as $model) {
            $hold[] = $this->toArray($model);
        }
        return $hold;
    }

    /**
     * @param LengthAwarePaginator $paginator
     * @return array
     */
    public function paginate(LengthAwarePaginator $paginator): array
    {
        $hold['clinics'] = $this->collection($paginator->getCollection());
        $paginator = $paginator->withPath('/getClinics');
        $hold['links'] = [
            'first' => 1,
            'prev' => $paginator->currentPage() > 1 ? $paginator->currentPage() - 1 : null,
            'next' => $paginator->hasMorePages() ? $paginator->currentPage()+1 : null,
            'last' => $paginator->lastPage(),
        ];
        return $hold;
    }
}
