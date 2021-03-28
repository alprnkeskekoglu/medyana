<?php

namespace Tests\Unit;

use App\Contracts\DataSource\EquipmentDataSource;
use App\Contracts\Repositories\ClinicRepository;
use App\Contracts\Repositories\EquipmentRepository;
use App\Http\Requests\ClinicRequest;
use App\Http\Requests\EquipmentRequest;
use App\Models\Clinic;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Tests\TestCase;

class EquipmentTest extends TestCase
{
    /**
     * @test
     * @return void
     */

    public function dataSourceTest()
    {
        $dataSource = new EquipmentDataSource();
        $fakeEquipments = Equipment::factory()->count(3)->make();

        $this->assertIsArray($dataSource->collection($fakeEquipments));
        $this->assertTrue(3 == count($dataSource->collection($fakeEquipments)));
    }

    /**
     * @test
     * @return void
     */
    public function repositoryTest()
    {
        $repository = new ClinicRepository();

        $clinicRequest = new ClinicRequest();
        $clinicRequest->initialize(['status' => 1, 'name'=> 'Faker Clinic']);
        $repository->store($clinicRequest);
        $clinic = Clinic::where('name', 'Faker Clinic')->first();

        $repository = new EquipmentRepository();

        $equipmentRequest = new EquipmentRequest();
        $equipmentRequest->initialize(['clinic_id'=>$clinic->id, 'status' => 1, 'name'=> 'Faker', 'stock' => 1, 'unit_price' => 0.01, 'rate' => 15.5]);
        $repository->store($equipmentRequest);

        $equipment = Equipment::where('name', 'Faker')->first();
        $this->assertEquals(1, $equipment->status);
        $this->assertEquals('Faker', $equipment->name);


        $equipmentRequest->initialize(['status' => 2, 'name'=> 'Faker2', 'stock' => 1, 'unit_price' => 12, 'rate' => 24.5]);
        $this->assertIsArray($repository->update($equipmentRequest, $equipment));
        $this->assertEquals(2, $equipment->status);
        $this->assertEquals('Faker2', $equipment->name);

        $request = new Request();
        $request->initialize(['search' => 'Faker2', 'clinic_id' => $clinic->id]);
        $data = $repository->getByParameters($request);
        $this->assertTrue($data->count() > 0);


        $equipment->delete();
        $this->assertSoftDeleted($equipment);
    }
}
