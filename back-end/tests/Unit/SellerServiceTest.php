<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\Interfaces\SellerRepositoryInterface;
use stdClass;
use App\Services\SellerService;
use Illuminate\Support\Str;

class SellerServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->sellerRepositoryMock = $this->mock(SellerRepositoryInterface::class);
        $this->sellerRepositoryMock->shouldReceive('createSeller')->andReturn(true);
    }

    public function testShouldReturnFalseWhenCreatingSellerWithNotStringName()
    {
        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock);
        $input = new stdClass();
        $input->name = rand(100, 200);
        $input->email = fake()->unique()->email();

        $output = $simulateCreateSeller->create($input->name, $input->email);

        $this->assertFalse($output);
    }

    public function testShouldReturnFalseWhenCreatingSeelerWithNotValidEmail()
    {
        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock);
        $input = new stdClass();
        $input->name = Str::random(10);
        $input->email = Str::random(10);

        $output = $simulateCreateSeller->create($input->name, $input->email);

        $this->assertFalse($output);
    }

    public function testShouldCreateSellerWithStringNameAndValidEmail()
    {
        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock);
        $input = new stdClass();
        $input->name = Str::random(10);
        $input->email = fake()->unique()->email();

        $output = $simulateCreateSeller->create($input->name, $input->email);

        $this->assertEquals(
            $output,
            'Vendedor cadastrado com sucesso.'
        );
    }

    public function testShouldReturnMessageInformingNoSellerResgistredWhenNoSellerRegistered()
    {
        $this->sellerRepositoryMock->shouldReceive('getAllSellers')->andReturn([]);

        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock);

        $output = $simulateCreateSeller->getAllSellers();

        $this->assertEquals(
            $output,
            'Nenhum vendedor cadastrado.'
        );
    }

    public function testShouldShowAllSellersInfosWhenExistingSellers()
    {
        $fakeSellers = new stdClass();
        $fakeSellers->name = Str::random(10);
        $fakeSellers->email = fake()->unique()->email();
        $fakeSellers = json_encode($fakeSellers);

        $this->sellerRepositoryMock->shouldReceive('getAllSellers')->andReturn($fakeSellers);

        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock);

        $output = $simulateCreateSeller->getAllSellers();

        $this->assertEquals(
            $output,
            $fakeSellers
        );
    }
}
