<?php

namespace App\Http\Controllers;

use App\Contracts\DataSource\EquipmentDataSource;
use App\Contracts\Repositories\EquipmentRepository;
use App\Contracts\DataSource\Output\JsonOutput;
use App\Http\Requests\EquipmentRequest;
use Illuminate\Http\Request;

/**
 * Class EquipmentController
 * @package App\Http\Controllers
 */
class EquipmentController extends Controller
{
    /**
     * @var EquipmentRepository
     */
    private $equipmentRepository;
    /**
     * @var EquipmentDataSource
     */
    private $equipmentDataSource;
    /**
     * @var JsonOutput
     */
    private $output;

    /**
     * EquipmentController constructor.
     * @param EquipmentRepository $equipmentRepository
     * @param EquipmentDataSource $equipmentDataSource
     * @param JsonOutput $output
     */
    public function __construct(EquipmentRepository $equipmentRepository, EquipmentDataSource $equipmentDataSource, JsonOutput $output)
    {
        $this->equipmentRepository = $equipmentRepository;
        $this->equipmentDataSource = $equipmentDataSource;
        $this->output = $output;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.equipments.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.equipments.create');
    }

    /**
     * @param EquipmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EquipmentRequest $request)
    {
        $response = $this->equipmentRepository->store($request);

        return $this->output->output($response);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $equipment = $this->equipmentRepository->getById($id);
        $equipment = $this->equipmentDataSource->toArray($equipment);

        return view('pages.equipments.edit', compact('equipment'));
    }

    /**
     * @param EquipmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EquipmentRequest $request, int $id)
    {
        $equipment = $this->equipmentRepository->getById($id);
        $response = $this->equipmentRepository->update($request, $equipment);

        return $this->output->output($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $equipment = $this->equipmentRepository->getById($id);
        $response = $this->equipmentRepository->delete($equipment);
        return $this->output->output($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEquipments(Request $request)
    {
        $equipments = $this->equipmentRepository->getByParameters($request);
        $response = $this->equipmentDataSource->paginate($equipments);
        return $this->output->output($response);
    }
}
