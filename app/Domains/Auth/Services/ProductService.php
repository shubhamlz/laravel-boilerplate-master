<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\Product;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductService.
 */ 
class ProductService extends BaseService
{
    /**
     * ProductService constructor.
     *
     * @param  Product  $Product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @param  array  $data
     * @return Product
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Product
    {
      
        DB::beginTransaction();
        $image = $data['image'];
        $imagename = time() . '.' . $image->getClientoriginalExtension();

        $path = Storage::disk('public')->putFileAs('images', $image, $imagename);
            try {
            $Product = $this->createProduct([
                'images' => $imagename,
                'name' => $data['name'],
                'price' => $data['price'],
                'inStock' => $data['inStock'],
                'category_id' =>$data['category_id'],
                'description' => $data['description'],
            ]);
            // dd($Product);
            // TODO: Handle Product roles and permissions here

        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating this Product. Please try again.'));
        }

        DB::commit();

        return $Product;
    }

    /**
     * @param  Product  $Product
     * @param  array  $data
     * @return Product
     *
     * @throws \Throwable
     */
    public function update(Product $Product, array $data = [], $tdata): Product
    {
        $old_image = $tdata->get('old_image');
        DB::beginTransaction();
        $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : $old_image;
        if (isset($data['image']) && !empty($data['image'])) {
            if (!empty($old_image)) {
                if (Storage::disk('public')->exists('images/' . $old_image)) {
                    Storage::disk('public')->delete('images/' . $old_image);
                }
            }
            $imagename = time() . '.' . $image->getClientoriginalExtension();
            $path = Storage::disk('public')->putFileAs('images', $image, $imagename);
        } else {
            $imagename = $image;

            // echo $image;die();
        }

        try {
            $ProductData = [
                'image' => $imagename,
                'name' => $data['name'],
                'price' => $data['price'],
                'inStock' => $data['inStock'],
                'category_id' =>$data['category_id'],
                'description' => $data['description'],
            ];

            // Update the Product
            
            $this->updateProduct($ProductData, $tdata->get('id'));
            // TODO: Handle Product roles and permissions here
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this Product. Please try again.'));
        }



        return $Product;
    }

    /**
     * @param  array  $data
     * @return Product
     */
    /**
     * @param  array  $data
     * @return Product
     */
    /**
     * @param  array  $data
     * @return Product
     */
    protected function updateProduct(array $data = [], $id): Product
    {   
        $Product = $this->model->where('id', $id)->firstOrFail();
        $Product->update([
            'img' => $data['image'],
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'available_from' => isset($data['available_from']) && $data['available_from'] != "" ? $data['available_from'] : now(),
            'designation' => $data['designation'],
            'available_till' => date('Y-m-d H:i:s', strtotime($data['available_from'] . ' + 2 hours')),
        ]);

        return $Product;
    }


    protected function createProduct(array $data = []): Product
    {
        // dd($this->model);
    return $this->model::create([
            'image' => $data['images'],
            'name' => $data['name'],
            'price' => $data['price'],
            'inStock' => $data['inStock'],
            'category_id' =>$data['category_id'],
            'description' => $data['description'],
        ]);
        // dd($query);die("Fsdfsdf");
    }
}
