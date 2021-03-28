<?php

namespace App\Contracts\Interfaces;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface EquipmentInterface
 * @package App\Contracts\Interfaces
 */
interface EquipmentInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Equipment
     */
    public function getById(int $id): Equipment;

    /**
     * @param Request $request
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getByParameters(Request $request, int $perPage): LengthAwarePaginator;

    /**
     * @param EquipmentRequest $request
     * @return array
     */
    public function store(EquipmentRequest $request): array;

    /**
     * @param EquipmentRequest $request
     * @param Equipment $equipment
     * @return array
     */
    public function update(EquipmentRequest $request, Equipment $equipment): array;

    /**
     * @param Equipment $equipment
     * @return array
     */
    public function delete(Equipment $equipment): array;
}
