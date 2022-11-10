<?php

namespace Tests\Unit;

use App\Repositories\Interfaces\SaleRepositoryInterface;
use App\Repositories\Interfaces\SellerRepositoryInterface;
use Tests\TestCase;
use App\Services\SaleService;
use stdClass;
use Illuminate\Support\Str;

class SaleServiceTest extends TestCase
{
    private $sellerRepositoryMock;
    private $saleRepositoryMock;
    private $saleData;

    protected function setUp(): void
    {
        parent::setUp();


        $this->sellerRepositoryMock = $this->mock(SellerRepositoryInterface::class);

        $randomSellersIds = range(10, 15);
        $this->sellerRepositoryMock->shouldReceive('getAllSellersId')->andReturn($randomSellersIds);

        $seller = new stdClass();
        $seller->id = 1;
        $seller->name = Str::random(10);
        $seller->email = fake()->unique()->email();
        $this->sellerRepositoryMock->shouldReceive('getSellerById')->andReturn($seller);

        $this->saleRepositoryMock = $this->mock(SaleRepositoryInterface::class);

        $saleData = new stdClass();
        $saleData->id = 1;
        $saleData->name = $seller->name;
        $saleData->commission = 'R$ 8.5';
        $saleData->value = 'R$ 100';
        $saleData->saleCreation = '2022-11-08 19:50:00';
        $this->saleRepositoryMock->shouldReceive('createSale')->andReturn($this->saleData);
    }

    public function testShouldReturnFalseInCreateSaleWithInvalidSeller()
    {
        $simulateSaleRegister = new SaleService($this->saleRepositoryMock, $this->sellerRepositoryMock);
        $input = new stdClass();
        $input->sellerId = rand(1, 5);
        $input->value = rand(50, 100);

        $output = $simulateSaleRegister->create($input->sellerId, $input->value);

        $this->assertFalse($output);
    }

    public function testShouldReturnFalseWhenSaleValueIsNotNumber()
    {
        $simulateSaleRegister = new SaleService($this->saleRepositoryMock, $this->sellerRepositoryMock);
        $input = new stdClass();
        $input->sellerId = rand(10, 15);
        $input->value = Str::random(5);

        $output = $simulateSaleRegister->create($input->sellerId, $input->value);

        $this->assertFalse($output);
    }

    public function testShouldReturnFalseWhenSaleValueIsNegativeNumber()
    {
        $simulateSaleRegister = new SaleService($this->saleRepositoryMock, $this->sellerRepositoryMock);
        $input = new stdClass();
        $input->sellerId = rand(10, 15);
        $input->value = rand(-10, -50);

        $output = $simulateSaleRegister->create($input->sellerId, $input->value);

        $this->assertFalse($output);
    }

    public function testShouldCreateSaleWhenSellerExistsAndValuePositiveNumber()
    {
        $simulateSaleRegister = new SaleService($this->saleRepositoryMock, $this->sellerRepositoryMock);
        $input = new stdClass();
        $input->sellerId = rand(10, 15);
        $input->value = rand(10, 50);

        $output = $simulateSaleRegister->create($input->sellerId, $input->value);

        $this->assertEquals(
            $this->saleData,
            $output,
        );
    }

    public function testShouldReturnFalseInListSalesOfNotExistingSeller()
    {
        $simulateListSales = new SaleService($this->saleRepositoryMock, $this->sellerRepositoryMock);
        $input = new stdClass();
        $input->sellerId = rand(1, 5);

        $output = $simulateListSales->getSellerAllSales($input->sellerId);

        $this->assertFalse($output);
    }

    public function testShouldReturnMessageWarningEmptnessWhenSellerHasNoSales()
    {
        $this->saleRepositoryMock->shouldReceive('getSellerAllSales')->andReturn([]);

        $simulateListSales = new SaleService($this->saleRepositoryMock, $this->sellerRepositoryMock);
        $input = new stdClass();
        $input->sellerId = rand(10, 15);

        $output = $simulateListSales->getSellerAllSales($input->sellerId);

        $this->assertEquals(
            $output,
            'Nenhuma venda registrada.'
        );
    }

    public function testShouldListAllSalesWhenSellerExistsAndSalesExists()
    {
        $input = new stdClass();
        $input->sellerId = 10;

        $fakeSales = new stdClass();
        $fakeSales->sellerId = 10;
        $fakeSales->value = 350;
        $fakeSales = json_encode($fakeSales);

        $this->saleRepositoryMock->shouldReceive('getSellerAllSales')->andReturn($fakeSales);

        $simulateListSales = new SaleService($this->saleRepositoryMock, $this->sellerRepositoryMock);
        ;

        $output = $simulateListSales->getSellerAllSales($input->sellerId);

        $this->assertEquals(
            $output,
            $fakeSales
        );
    }
}
