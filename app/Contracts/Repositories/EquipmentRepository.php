<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\EquipmentInterface;
use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class EquipmentRepository
 * @package App\Contracts\Repositories
 * @see EquipmentInterface
 */
class EquipmentRepository implements EquipmentInterface
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Equipment::all();
    }

    /**
     * @param int $id
     * @return Equipment
     */
    public function getById(int $id): Equipment
    {
        return Equipment::findOrFail($id);
    }

    /**
     * @param Request $request
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getByParameters(Request $request, int $perPage = 10): LengthAwarePaginator
    {
        $clinic_id = $request->get('clinic_id') ?: null;
        $search = $request->get('search') ?: null;
        $sort = $request->get('sort') ?: null;

        $equipments = Equipment::query();

        if ($clinic_id) {
            $equipments = $equipments->where('clinic_id', $clinic_id);
        }

        if ($search) {
            $equipments = $equipments->where('name', 'like', "%$search%");
        }

        if ($sort) {
            switch ($sort) {
                case 'a-z':
                    $equipments = $equipments->orderBy('name');
                    break;
                case 'z-a':
                    $equipments = $equipments->orderByDesc('name');
                    break;
                case 'rlh':
                    $equipments = $equipments->orderBy('rate');
                    break;
                case 'rhl':
                    $equipments = $equipments->orderByDesc('rate');
                    break;
                case 'plh':
                    $equipments = $equipments->orderBy('unit_price');
                    break;
                case 'phl':
                    $equipments = $equipments->orderByDesc('unit_price');
                    break;
            }
        }

        return $equipments->paginate($perPage);
    }

    /**
     * @param EquipmentRequest $request
     * @return string[]
     */
    public function store(EquipmentRequest $request): array
    {
        $data = $request->except('_token');

        $data['unit_price'] *= 1.0;
        $data['rate'] *= 1.0;

        Equipment::firstOrCreate($data);

        return ['message' => 'Success!'];
    }

    /**
     * @param EquipmentRequest $request
     * @param Equipment $equipment
     * @return string[]
     */
    public function update(EquipmentRequest $request, Equipment $equipment): array
    {
        $data = $request->only('status', 'clinic_id', 'name', 'supply_date', 'stock', 'unit_price', 'rate');

        $data['unit_price'] *= 1.0;
        $data['rate'] *= 1.0;

        $equipment->update($data);

        return ['message' => 'Success!'];
    }

    /**
     * @param Equipment $equipment
     * @return string[]
     * @throws \Exception
     */
    public function delete(Equipment $equipment): array
    {
        $equipment->delete();
        return ['message' => 'Success!'];
    }
}
