<?php

namespace App\Contracts\DataSource;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EquipmentDataSource
{
    public function toArray(Equipment $equipment): array
    {
        return [
            'id' => $equipment->id,
            'status' => $equipment->status,
            'clinic_id' => $equipment->clinic_id,
            'name' => $equipment->name,
            'supply_date' => $equipment->supply_date,
            'stock' => $equipment->stock,
            'unit_price' => $equipment->unit_price,
            'rate' => $equipment->rate,
            'created_at' => $equipment->created_at->format('d/m/Y'),
            'clinic' => (new ClinicDataSource())->toArray($equipment->clinic)
        ];
    }

    public function collection(Collection $models): array
    {
        $hold = [];

        foreach ($models as $model) {
            $hold[] = $this->toArray($model);
        }
        return $hold;
    }

    public function paginate(LengthAwarePaginator $paginator): array
    {
        $hold['equipments'] = $this->collection($paginator->getCollection());
        $paginator = $paginator->withPath('/getEquipments');
        $hold['links'] = [
            'first' => 1,
            'prev' => $paginator->currentPage() > 1 ? $paginator->currentPage() - 1 : null,
            'next' => $paginator->hasMorePages() ? $paginator->currentPage()+1 : null,
            'last' => $paginator->lastPage(),
        ];
        return $hold;
    }
}
