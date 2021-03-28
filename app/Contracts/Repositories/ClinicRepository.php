<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ClinicInterface;
use App\Http\Requests\ClinicRequest;
use App\Models\Clinic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ClinicRepository
 * @package App\Contracts\Repositories
 * @see ClinicInterface
 */
class ClinicRepository implements ClinicInterface
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Clinic::all();
    }

    /**
     * @param int $id
     * @return Clinic
     */
    public function getById(int $id): Clinic
    {
        return Clinic::findOrFail($id);
    }

    /**
     * @param Request $request
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getByParameters(Request $request, int $perPage = 12): LengthAwarePaginator
    {
        $search = $request->get('search') ?: null;
        $sort = $request->get('sort') ?: null;

        $clinics = Clinic::query();

        if ($search) {
            $clinics = $clinics->where('name', 'like', "%$search%");
        }

        if ($sort) {
            switch ($sort) {
                case 'a-z':
                    $clinics = $clinics->orderBy('name');
                    break;
                case 'z-a':
                    $clinics = $clinics->orderByDesc('name');
                    break;
                case 'l-h':
                    $clinics = $clinics->withCount('equipments')->orderBy('equipments_count');
                    break;
                case 'h-l':
                    $clinics = $clinics->withCount('equipments')->orderByDesc('equipments_count');
                    break;
            }
        }

        if ($search || $sort) {
            $page = 1;
        } else {
            $page = $request->get('page');
        }

        return $clinics->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * @param ClinicRequest $request
     * @return string[]
     */
    public function store(ClinicRequest $request): array
    {
        $data = $request->except('_token');

        Clinic::firstOrCreate($data);

        return ['message' => 'Success!'];
    }

    /**
     * @param Clinic $clinic
     * @param ClinicRequest $request
     * @return string[]
     */
    public function update(Clinic $clinic, ClinicRequest $request): array
    {
        $data = $request->except('_token');

        $clinic->update($data);

        return ['message' => 'Success!'];
    }

    /**
     * @param Clinic $clinic
     * @return string[]
     * @throws \Exception
     */
    public function delete(Clinic $clinic): array
    {
        $clinic->delete();
        return ['message' => 'Success!'];
    }
}
