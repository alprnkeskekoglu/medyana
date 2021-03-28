<?php

namespace App\Http\Controllers;

use App\Contracts\DataSource\ClinicDataSource;
use App\Contracts\Repositories\ClinicRepository;
use App\Contracts\DataSource\Output\JsonOutput;
use App\Http\Requests\ClinicRequest;
use App\Http\Resources\ClinicCollection;
use Illuminate\Http\Request;

/**
 * Class ClinicController
 * @package App\Http\Controllers
 */
class ClinicController extends Controller
{
    /**
     * @var ClinicRepository
     */
    private $clinicRepository;
    /**
     * @var ClinicDataSource
     */
    private $clinicDataSource;
    /**
     * @var JsonOutput
     */
    private $output;

    /**
     * ClinicController constructor.
     * @param ClinicRepository $clinicRepository
     * @param ClinicDataSource $clinicDataSource
     * @param JsonOutput $output
     */
    public function __construct(ClinicRepository $clinicRepository, ClinicDataSource $clinicDataSource, JsonOutput $output)
    {
        $this->clinicRepository = $clinicRepository;
        $this->clinicDataSource = $clinicDataSource;
        $this->output = $output;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.clinics.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.clinics.create');
    }

    /**
     * @param ClinicRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClinicRequest $request)
    {
        $response = $this->clinicRepository->store($request);

        return $this->output->output($response);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $clinic = $this->clinicRepository->getById($id);
        $clinic = $this->clinicDataSource->toArray($clinic);

        return view('pages.clinics.edit', compact('clinic'));
    }

    /**
     * @param ClinicRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ClinicRequest $request, int $id)
    {
        $clinic = $this->clinicRepository->getById($id);
        $response = $this->clinicRepository->update($clinic, $request);

        return $this->output->output($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clinic = $this->clinicRepository->getById($id);
        $response = $this->clinicRepository->delete($clinic);
        return $this->output->output($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClinics(Request $request)
    {
        $clinics = $this->clinicRepository->getByParameters($request);
        $response = $this->clinicDataSource->paginate($clinics);
        return $this->output->output($response);
    }
}
