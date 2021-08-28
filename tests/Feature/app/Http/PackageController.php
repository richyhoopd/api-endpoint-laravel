<?php

namespace Tests\Feature\app\Http;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PackageController extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user, 'api');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanCreatePackage()
    {
        $due = Carbon::parse('next friday');
        $formData = [
            'title' => 'sample test Package title',
            'description' => 'sample test Package description',
            'due' => $due,
        ];
        $this->withoutExceptionHandling();

        $response = $this->post(route('Packages.store'), $formData);
        $response->assertStatus(201)
            ->assertJson(['data' => $formData]);
    }

    public function testCanShowPackage()
    {
        $package = factory(Package::class)->create();
        $this->user->Packages()->save($package);
        $response = $this->get(route('Packages.show', $package->id));
        $response->assertStatus(200);
    }

    public function testUpdatePackage()
    {
        $package = factory(Package::class)->create();
        $this->user->Packages()->save($package);

        $due = Carbon::parse('next friday');

        $formData = [
            'title' => 'sample test Package title',
            'description' => 'sample test Package description',
            'due' => $due,
        ];
        $this->withoutExceptionHandling();

        $response = $this->put(route('Packages.update', $package->id), $formData);
        $response->assertStatus(200)
            ->assertJson(['data' => $formData]);
    }

    public function testDelete()
    {
        $package = factory(Package::class)->create();
        $this->user->Packages()->save($package);
        $response = $this->delete(route('Packages.destroy', $package));
        $response->assertStatus(200)->assertJson(['message' => 'Success deleted!']);
    }

    public function testShowAllPackages()
    {
        $packages = factory(Package::class, 3)->create();
        $this->user->Packages()->saveMany($packages);
        $response = $this->get(route('Packages.index'));
        $response->assertStatus(200)->assertJson($packages->toArray());
    }

}
