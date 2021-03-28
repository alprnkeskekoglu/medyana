<?php

namespace App\Contracts\Interfaces;

use App\Http\Requests\ClinicRequest;
use App\Models\Clinic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface ClinicInterface
 * @package App\Contracts\Interfaces
 */
interface ClinicInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Clinic
     */
    public function getById(int $id): Clinic;

    /**
     * @param Request $request
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getByParameters(Request $request, int $perPage): LengthAwarePaginator;

    /**
     * @param ClinicRequest $request
     * @return array
     */
    public function store(ClinicRequest $request): array;

    /**
     * @param Clinic $clinic
     * @param ClinicRequest $request
     * @return arrray
     */
    public function update(Clinic $clinic, ClinicRequest $request): arrray;

    /**
     * @param Clinic $clinic
     * @return array
     */
    public function delete(Clinic $clinic): array;
}
