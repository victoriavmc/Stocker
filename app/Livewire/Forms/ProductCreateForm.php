<?php

namespace App\Livewire\Forms;

use App\Models\BaseProduct;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;
use App\Traits\CapitalizeFields;
use Exception;

class ProductCreateForm extends Form
{
    use CapitalizeFields;

    #BaseProducts
    #[Validate('required|string|max:50')]
    public $brand;

    #[Validate('required|string|max:50')]
    public $name;

    #Products
    #[Validate('required|integer')]
    public $code;

    #[Validate('required|integer|max:100')]
    public $measure;

    #[Validate('required|string')]
    public $measureUnit;

    #[Validate('required|string|max:100')]
    public $productType;

    #[Validate('nullable|image|max:1024')]
    public $photo;

    // Extra
    public $productTypes = [];

    #[Validate('nullable|string|max:255')]
    public $newProductType;

    public $newProductTypeCampo = false;
    public $createModal = false;

    // Personalizar nombres de campos en mensajes de error
    public function attributes()
    {
        return [
            'brand' => 'Marca',
            'name' => 'Nombre',
            'code' => 'Código',
            'measure' => 'Medida',
            'productType' => 'Tipo',
            'photo' => 'Foto',
            'newProductType' => 'Nuevo Tipo de Producto',
        ];
    }

    public function createBaseProduct(): int
    {
        return BaseProduct::create(
            $this->only(['brand', 'name'])
        )->idBaseProduct;
    }

    public function create()
    {
        $this->createModal = true;
    }

    // Cargar tipos de productos desde la base de datos

    public function loadProductTypes()
    {
        $this->productTypes = Product::distinct()
            ->orderBy('productType', 'asc')
            ->pluck('productType')
            ->toArray();

        // Si no hay tipos de producto, usa un array predeterminado
        if (empty($this->productTypes)) {
            $this->productTypes = ['Sin tipos disponibles'];
        }
    }

    public function save()
    {
        $this->validate();

        // Save data
        $fieldsToCapitalize = [
            'brand',
            'name',
            'productType',
            'photo',
            'statusLogic',
            'newProductType'
        ];

        $this->capitalizeFields($fieldsToCapitalize);

        // Si el usuario selecciona "Otro" y escribe un nuevo tipo de producto
        if ($this->productType === 'Other' && !empty($this->newProductType)) {
            $this->productType = $this->newProductType;
        }

        // Combinar measure y measureUnit
        $measureWithUnit = $this->measure . ' ' . $this->measureUnit;

        try {
            DB::beginTransaction();

            $idBaseProduct = $this->createBaseProduct();

            // Guardar datos Product
            $product = Product::create([
                'code' => $this->code,
                'measure' => $measureWithUnit,
                'productType' => $this->productType,
                'photo' => $this->photo,
                'statusLogic' => 'Activo',
                'idBaseProduct' => $idBaseProduct,
            ]);

            DB::commit();

            $this->createModal = false;
            $this->reset();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $product;
    }
}
