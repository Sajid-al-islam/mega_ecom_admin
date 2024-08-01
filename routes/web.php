<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::get('/cache/{file_name}', 'AssetController@cache')->where('file_name', '.*');
});

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
Auth::routes();

Route::get('/a-cats', function () {
    $arr_cats = file_get_contents(public_path('arogga/categories/categories.json'));
    $arr_cats = json_decode($arr_cats);

    $si = 1;
    // DB::table('product_categories')->truncate();
    foreach ($arr_cats as $cat) {
        $image = null;
        $image_alt = null;
        if (isset($cat->attachedFiles_mi_logo[0])) {
            $image = $cat->attachedFiles_mi_logo[0]->src;
            $image_alt = $cat->attachedFiles_mi_logo[0]->title;
        }
        $bc_id = count(explode('/', $cat->mi_url)) >= 4 ? explode('/', $cat->mi_url)[3] : null;
        $data = [
            "id" => $cat->id,
            "title" => $cat->mi_name,
            "parent_id" => $cat->mi_parent_mi_id,
            "product_category_group_id" => 1,
            "is_nav" => $cat->mi_parent_mi_id == 0 ? 1 : 0,
            "is_featured" => 0,
            "serial" => $cat->mi_parent_mi_id == 0 ? $si++ : null,
            "image" => $image,
            "image_alt" => $image_alt,
            "meta_title" => "",
            "meta_description" => "",
            "meta_keywords" => "",
            "search_keywords" => "",
            "page_header_title" => "",
            "page_header_description" => "",
            "page_full_description_title" => "",
            "page_full_description" => "",
            "related_product_title" => "",
            "bc_url" => $cat->mi_url,
            "bc_id" => $bc_id,
            "creator" => null,
            "slug" => Str::slug($cat->mi_name),
            "status" => "active",
            "created_at" => Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon::now()->toDateTimeString(),
        ];
        $exist = DB::table('product_categories')->where('id', $cat->id)->first();
        if (!$exist) {
            DB::table('product_categories')->insert($data);
        }
    }
    dd('ok');
});

Route::get('/a-products', function () {
    set_time_limit(0);
    ini_set('max_execution_time', 0);

    function save_band($brand)
    {
        $exist = DB::table('product_brands')->where('id', $brand->id)->first();
        if (!$exist && $brand->id) {
            DB::table('product_brands')->insert([
                "id" => $brand->id,
                "title" => $brand->name,
                "slug" => Str::slug($brand->name),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function save_manufacturer($p_manufacturer)
    {
        $exist = DB::table('product_menufacturers')->where('id', $p_manufacturer->id)->first();
        if (!$exist && $p_manufacturer->id) {
            DB::table('product_menufacturers')->insert([
                "id" => $p_manufacturer->id,
                "title" => $p_manufacturer->name,
                "slug" => Str::slug($p_manufacturer->name),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function save_unit($unit)
    {
        $exist = DB::table('product_units')->where('id', $unit->id)->first();
        if (!$exist && $unit->id) {
            DB::table('product_units')->insert([
                "id" => $unit->id,
                "product_unit_group_id" => 4,
                "title" => $unit->name,
                "multiplier" => $unit->multiplier,
                "slug" => Str::slug($unit->name),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function save_generic($generic)
    {
        $exist = DB::table('product_medicine_generics')->where('id', $generic->id)->first();
        if (!$exist && $generic->id) {
            DB::table('product_medicine_generics')->insert([
                "id" => $generic->id,
                "title" => $generic->name,
                "multiplier" => $generic->multiplier,
                "slug" => Str::slug($generic->name),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function upload_product($i)
    {
        $products = file_get_contents(public_path("arogga/category_products/$i.json"));
        $products = json_decode($products);

        if (isset($products->filters->_brand_id)) {
            // DB::table('product_brands')->truncate();
            foreach ($products->filters->_brand_id as $brand) {
                save_band($brand);
            }
        }

        if (isset($products->filters->_brand_id)) {
            // DB::table('product_forms')->truncate();
            foreach ($products->filters->_form as $form => $count) {
                $exist = DB::table('product_medicine_forms')->where('title', $form)->first();
                if (!$exist) {
                    DB::table('product_medicine_forms')->insert([
                        "title" => $form,
                        "slug" => Str::slug($form),
                        "created_at" => Carbon::now()->toDateTimeString(),
                    ]);
                }
            }
        }

        if (isset($products->data) && count($products->data)) {
            // DB::table('products')->truncate();
            foreach ($products->data as $product) {
                $exist = DB::table('products')->where('id', $product->id)->first();

                save_band((object) [
                    "id" => $product->p_brand_id,
                    "title" => $product->p_brand,
                ]);

                save_manufacturer((object) [
                    "id" => $product->p_manufacturer_id,
                    "name" => $product->p_manufacturer,
                ]);

                save_generic((object) [
                    "id" => $product->p_generic_id,
                    "name" => $product->p_generic_name,
                ]);

                foreach ($product->pu as $pv) {
                    save_unit((object)[
                        "id" => $pv->id,
                        "name" => $pv->pu_label,
                        "multiplier" => $pv->pu_multiplier,
                    ]);
                }

                $category = DB::table('product_categories')
                    ->where('bc_id', $product->p_product_category_id)
                    ->first();

                if ($category) {
                    DB::table('product_category_products')->where('product_id', $product->id)->delete();
                    DB::table('product_category_products')
                        ->insert([
                            "product_id" => $product->id,
                            "product_category_id" => $category->id,
                            "product_category_group_id" => 1,
                        ]);
                }

                if ($product->haveImage) {
                    DB::table('product_images')->where('product_id', $product->id)->delete();
                    foreach ($product->attachedFiles_p_images as $image) {
                        try {
                            $image_file = file_get_contents($image->src);
                            $image_name = 'uploads/medicines/' .  $product->id . $image->title;
                            if (!file_exists(public_path($image_name))) {
                                file_put_contents(public_path($image_name), $image_file);
                                DB::table('product_images')->insert([
                                    "product_id" => $product->id,
                                    "url" => $image_name,
                                ]);
                            }
                        } catch (\Throwable $th) {
                            file_put_contents(public_path('uploads/failed/' . $product->id . $image->title . '.json'), json_encode($image));
                            echo "<br/> image failed: product:" . $product->id . " - file: " . $i;
                        }
                    }
                    foreach ($product->pv[0]->attachedFiles_pv_images as $image) {
                        try {
                            $image_file = file_get_contents($image->src);
                            $image_name = 'uploads/medicines/' .  $product->id . $image->title;
                            if (!file_exists(public_path($image_name))) {
                                file_put_contents(public_path($image_name), $image_file);
                                DB::table('product_images')->insert([
                                    "product_id" => $product->id,
                                    "url" => $image_name,
                                ]);
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                            file_put_contents(public_path('uploads/failed/' . $product->id . $image->title . '.json'), json_encode($image));
                            echo "<br/> image failed: product:" . $product->id . " - " . $image->title . "" . " - file: " . $i;
                        }
                    }
                }

                if (!$exist) {
                    $data = [
                        "id" => $product->id,
                        "product_category_group_id" => 1,
                        "type" => "medicine",
                        "title" => $product->p_name,

                        "product_brand_id" => $product->p_brand_id,
                        "product_menufecturer_id" => $product->p_manufacturer_id,
                        "product_unit_id" => $product->pu[0]->id ?? null,

                        "slug" => Str::slug($product->p_name) . '-' . rand(1000, 9999),
                        "created_at" => now(),
                    ];

                    DB::table('products')->insert($data);

                    $product->product_id = $product->id;
                    $product_medicines = collect((array) $product)->except([
                        "id",
                        "pv",
                        "p_vendor_local_ids",
                        "p_vendor_company_ids",
                        "p_vendor_foreign_ids",
                        "pu",
                        "attachedFiles_p_images",
                        "p_product_tags",
                        "p_product_internal_tags",
                        "p_product_internal_tags_title",
                        "p_product_tags_title",
                    ]);

                    DB::table('product_medicines')->where('product_id', $product->id)->delete();
                    DB::table('product_medicines')->insert($product_medicines->toArray());

                    foreach ($product->pv as $product_medicines) {
                        $product_medicines->product_id = $product->id;
                        DB::table('product_medicine_varients')->where('product_id', $product->id)->delete();
                        $product_medicines = collect($product_medicines)->except(['attachedFiles_pv_images']);
                        DB::table('product_medicine_varients')->insert($product_medicines->toArray());
                    }
                }
            }
        }
    }
    for ($i = 5988; $i <= 10542; $i++) {
        try {
            upload_product($i);
        } catch (\Throwable $th) {
            echo $i . " " . $th->getMessage() . "<br/>";
        }
    }

    dd('ok');
});
Route::get('/ids',function(){
    $products = DB::table('products')->select('id')->get();
    $ids = collect($products)->map(function($i){return $i->id;})->toArray();
    file_put_contents(public_path('arogga/uploaded_ids.json'), json_encode($ids));
    dd('asdf');
});

Route::view('up', "up");
Route::post('/up-product', function () {
    /** functionalities */
    set_time_limit(0);
    ini_set('max_execution_time', 0);

    function save_band($brand)
    {
        $exist = DB::table('product_brands')->where('id', $brand->id)->first();
        if (!$exist && $brand->id) {
            DB::table('product_brands')->insert([
                "id" => $brand->id,
                "title" => $brand->title,
                "slug" => Str::slug($brand->title),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function save_manufacturer($p_manufacturer)
    {
        $exist = DB::table('product_menufacturers')->where('id', $p_manufacturer->id)->first();
        if (!$exist && $p_manufacturer->id) {
            DB::table('product_menufacturers')->insert([
                "id" => $p_manufacturer->id,
                "title" => $p_manufacturer->name,
                "slug" => Str::slug($p_manufacturer->name),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function save_unit($unit)
    {
        $exist = DB::table('product_units')->where('id', $unit->id)->first();
        if (!$exist && $unit->id) {
            DB::table('product_units')->insert([
                "id" => $unit->id,
                "product_unit_group_id" => 4,
                "title" => $unit->name,
                "multiplier" => $unit->multiplier,
                "slug" => Str::slug($unit->name),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function save_generic($generic)
    {
        $exist = DB::table('product_medicine_generics')->where('id', $generic->id)->first();
        if (!$exist && $generic->id) {
            DB::table('product_medicine_generics')->insert([
                "id" => $generic->id,
                "title" => $generic->name,
                "slug" => Str::slug($generic->name),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function upload_product($product)
    {
        $exist = DB::table('products')->where('id', $product->id)->first();

        if (!$exist) {
            save_band((object) [
                "id" => $product->p_brand_id,
                "title" => $product->p_brand,
            ]);

            save_manufacturer((object) [
                "id" => $product->p_manufacturer_id,
                "name" => $product->p_manufacturer,
            ]);

            save_generic((object) [
                "id" => $product->p_generic_id,
                "name" => $product->p_generic_name,
            ]);

            foreach ($product->pu as $pv) {
                save_unit((object)[
                    "id" => $pv->id,
                    "name" => $pv->pu_label,
                    "multiplier" => $pv->pu_multiplier,
                ]);
            }

            $category = DB::table('product_categories')
                ->where('bc_id', $product->p_product_category_id)
                ->first();

            if ($category) {
                DB::table('product_category_products')->where('product_id', $product->id)->delete();
                DB::table('product_category_products')
                    ->insert([
                        "product_id" => $product->id,
                        "product_category_id" => $category->id,
                        "product_category_group_id" => 1,
                    ]);
            }

            if ($product->haveImage) {
                DB::table('product_images')->where('product_id', $product->id)->delete();
                function check_image_name($image_name)
                {
                    $extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                    if (!in_array($extension, array('jpg', 'webp', 'jpeg', 'png', 'gif', 'bmp', 'tif', 'tiff', 'svg'))) {
                        $image_name .= '.jpeg';
                    }
                    return $image_name;
                }
                foreach ($product->attachedFiles_p_images as $image) {
                    try {
                        $image_file = file_get_contents($image->src);
                        $title = $image->title;
                        $title = str_replace('/', '-', $title);
                        $image_name = 'uploads/medicines/' .  $product->id . $title;
                        $image_name = check_image_name($image_name);
                        if (!file_exists(public_path($image_name))) {
                            file_put_contents(public_path($image_name), $image_file);
                            DB::table('product_images')->insert([
                                "product_id" => $product->id,
                                "url" => $image_name,
                            ]);
                        }
                    } catch (\Throwable $th) {
                        file_put_contents(public_path('uploads/failed/' . $product->id . $image->title . '.json'), json_encode($image));
                    }
                }
                foreach ($product->pv[0]->attachedFiles_pv_images as $image) {
                    try {
                        $image_file = file_get_contents($image->src);
                        $title = $image->title;
                        $title = str_replace('/', '-', $title);
                        $image_name = 'uploads/medicines/' .  $product->id . $title;
                        $image_name = check_image_name($image_name);
                        if (!file_exists(public_path($image_name))) {
                            file_put_contents(public_path($image_name), $image_file);
                            DB::table('product_images')->insert([
                                "product_id" => $product->id,
                                "url" => $image_name,
                            ]);
                        }
                    } catch (\Throwable $th) {
                        // file_put_contents(public_path('uploads/failed/' . $product->id . $image->title . '.json'), json_encode($image));
                    }
                }
            }

            $data = [
                "id" => $product->id,
                "product_category_group_id" => 1,
                "type" => "medicine",
                "title" => $product->p_name,

                "product_brand_id" => $product->p_brand_id,
                "product_menufecturer_id" => $product->p_manufacturer_id,
                "product_unit_id" => $product->pu[0]->id ?? null,

                "slug" => Str::slug($product->p_name) . '-' . rand(1000, 9999),
                "created_at" => now(),
            ];

            DB::table('products')->insert($data);

            $product->product_id = $product->id;
            $product_medicines = collect((array) $product)->except([
                "id",
                "pv",
                "p_vendor_local_ids",
                "p_vendor_company_ids",
                "p_vendor_foreign_ids",
                "pu",
                "attachedFiles_p_images",
                "p_product_tags",
                "p_product_internal_tags",
                "p_product_internal_tags_title",
                "p_product_tags_title",
                "category_id",
            ]);

            DB::table('product_medicines')->where('product_id', $product->id)->delete();
            DB::table('product_medicines')->insert($product_medicines->toArray());

            foreach ($product->pv as $product_varient) {
                $product_varient->product_id = $product->id;
                DB::table('product_medicine_varients')->where('product_id', $product->id)->delete();
                $product_varient = collect($product_varient)->except(['attachedFiles_pv_images']);
                DB::table('product_medicine_varients')->insert($product_varient->toArray());
            }

            return response()->json($product->id);
        }

        else{
            return ("exists");
        }

    }

    $data = request()->all();
    $data = json_encode($data);
    $product = json_decode($data);
    return upload_product($product);
});

Route::get('/all-list', function () {
    // file_put_contents(public_path('arogga/products.json'), "[".PHP_EOL , FILE_APPEND | LOCK_EX);
    // for ($i = 5988; $i <= 10542; $i++) {
    //     try {
    //         $products = file_get_contents(public_path("arogga/category_products/$i.json"));
    //         $products = json_decode($products);

    //         foreach ($products->data as $product) {
    //             $product->category_id = $i;
    //             file_put_contents(public_path('arogga/products.json'), (json_encode($product).",").PHP_EOL , FILE_APPEND | LOCK_EX);
    //         }

    //     } catch (\Throwable $th) {
    //         echo $th->getMessage().  "<br/>";
    //     }
    // }
    // file_put_contents(public_path('arogga/products.json'), "]".PHP_EOL , FILE_APPEND | LOCK_EX);

});

/**
 "is_featured" => "",
                    "is_new" => "",
                    "is_available" => "",
                    "is_pre_order" => "",
                    "is_up_coming" => "",
                    "is_emi_support" => "",
                    "is_best_selling" => "",
                    "is_trending" => "",
                    "total_sold" => "",
                    "barcode" => "",
                    "short_description" => "",
                    "specification" => "",
                    "description" => "",
                    "video_url" => "",

                    "sku" => "",
                    "alert_quantity" => "",
                    "seller_points" => "",
                    "is_returnable" => "",
                    "expiration_days" => "",
                    "product_warranty" => "",
                    "warranty_policy" => "",
                    "guarenty_policy" => "",
                    "price_type" => "",
                    "tax_type" => "",
                    "tax_amount" => "",
                    "purchase_price" => "",
                    "customer_sales_price" => "",
                    "retailer_sales_price" => "",
                    "minimum_sale_price" => "",
                    "maximum_sale_price" => "",
                    "profit_margin_percent" => "",
                    "discount_type" => "", //enum('off','percent','flat')
                    "discount_amount" => "",
                    "meta_title" => "",
                    "meta_description" => "",
                    "meta_keywords" => "",
                    "search_keywords" => "",
                    "creator" => "",
                    "slug" => "",
                    "is_hide" => "",
                    "status" => "", //enum('active','inactive')
                    "created_at" => "",
                    "updated_at " => "",
 */
