<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\Interfaces\SellerRepositoryInterface;
use App\Repositories\Interfaces\SaleRepositoryInterface;
use stdClass;
use App\Services\SellerService;
use Illuminate\Support\Str;

class SellerServiceTest extends TestCase
{
    private $seller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sellerRepositoryMock = $this->mock(SellerRepositoryInterface::class);

        $this->seller = new stdClass();
        $this->seller->id = 1;
        $this->seller->name = Str::random(10);
        $this->seller->email = fake()->unique()->email();
        $this->sellerRepositoryMock->shouldReceive('createSeller')->andReturn($this->seller);

        $this->saleRepositoryMock = $this->mock(SaleRepositoryInterface::class);
        $this->saleRepositoryMock->shouldReceive('getSellerAllSales')->andReturn([]);
    }

    public function testShouldReturnFalseWhenCreatingSellerWithNotStringName()
    {
        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock, $this->saleRepositoryMock);
        $input = new stdClass();
        $input->name = rand(100, 200);
        $input->email = fake()->unique()->email();

        $output = $simulateCreateSeller->create($input->name, $input->email);

        $this->assertFalse($output);
    }

    public function testShouldReturnFalseWhenCreatingSeelerWithNotValidEmail()
    {
        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock, $this->saleRepositoryMock);
        $input = new stdClass();
        $input->name = Str::random(10);
        $input->email = Str::random(10);

        $output = $simulateCreateSeller->create($input->name, $input->email);

        $this->assertFalse($output);
    }

    public function testShouldCreateSellerWithStringNameAndValidEmail()
    {
        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock, $this->saleRepositoryMock);
        $input = new stdClass();
        $input->name = Str::random(10);
        $input->email = fake()->unique()->email();

        $output = $simulateCreateSeller->create($input->name, $input->email);

        $this->assertEquals(
            $this->seller,
            $output
        );
    }

    public function testShouldReturnMessageInformingNoSellerResgistredWhenNoSellerRegistered()
    {
        $this->sellerRepositoryMock->shouldReceive('getAllSellers')->andReturn([]);

        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock, $this->saleRepositoryMock);

        $output = $simulateCreateSeller->getAllSellers();

        $this->assertEquals(
            $output,
            'Nenhum vendedor cadastrado.'
        );
    }

    public function testShouldShowAllSellersInfosWhenExistingSellers()
    {
        $this->sellerRepositoryMock->shouldReceive('getAllSellers')->andReturn([$this->seller]);

        $simulateCreateSeller = new SellerService($this->sellerRepositoryMock, $this->saleRepositoryMock);

        $output = $simulateCreateSeller->getAllSellers();


        $outputConstrutedToValidate = new stdClass();
        $outputConstrutedToValidate->id = $this->seller->id;
        $outputConstrutedToValidate->name = $this->seller->name;
        $outputConstrutedToValidate->email = $this->seller->email;
        $outputConstrutedToValidate->commission = "R$0";

        $this->assertEquals(
            [$outputConstrutedToValidate],
            $output
        );
    }
}
