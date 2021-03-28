<?php

namespace Tests\Unit;

use App\Contracts\DataSource\ClinicDataSource;
use App\Contracts\Repositories\ClinicRepository;
use App\Http\Requests\ClinicRequest;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Tests\TestCase;

class ClinicTest extends TestCase
{
    /**
     * @test
     * @return void
     */

    public function dataSourceTest()
    {
        $dataSource = new ClinicDataSource();
        $fakeClinics = Clinic::factory()->count(3)->make();

        $this->assertIsArray($dataSource->collection($fakeClinics));
        $this->assertTrue(3 == count($dataSource->collection($fakeClinics)));
    }

    /**
     * @test
     * @return void
     */
    public function repositoryTest()
    {
        $repository = new ClinicRepository();

        $clinicRequest = new ClinicRequest();
        $clinicRequest->initialize(['status' => 1, 'name'=> 'Faker']);
        $repository->store($clinicRequest);

        $clinic = Clinic::where('name', 'Faker')->first();
        $this->assertEquals(1, $clinic->status);
        $this->assertEquals('Faker', $clinic->name);


        $clinicRequest->initialize(['status' => 2, 'name'=> 'Faker2']);
        $this->assertIsArray($repository->update($clinicRequest, $clinic));
        $this->assertEquals(2, $clinic->status);
        $this->assertEquals('Faker2', $clinic->name);

        $request = new Request();
        $request->initialize(['search' => 'Faker2']);
        $data = $repository->getByParameters($request);
        $this->assertTrue($data->count() > 0);


        $clinic->delete();
        $this->assertSoftDeleted($clinic);
    }
}
