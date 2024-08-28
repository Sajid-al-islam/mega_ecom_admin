
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
Route::get('/ids', function () {
    $products = DB::table('products')->select('id')->get();
    $ids = collect($products)->map(function ($i) {
        return $i->id;
    })->toArray();
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
        return;
        $exist = DB::table('products')->where('id', $product->id)->first();
        $exist_medicine = DB::table('product_medicines')->where('product_id', $product->id)->first();
        $exist_varients = DB::table('product_medicine_varients')->where('product_id', $product->id)->first();

        if (!$exist || !$exist_medicine || !$exist_varients) {
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

            DB::table('products')->where('id', $data['id'])->delete();
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
                "p_product_tags_title",
                "p_product_internal_tags",
                "p_product_internal_tags_title",
                "category_id",
                "i",
                "p_product_keywords",
                "p_attribute",
            ]);

            // $product_medicines->p_attribute = json_encode($product_medicines->p_attribute);

            DB::table('product_medicines')->where('product_id', $product->id)->delete();
            DB::table('product_medicines')->insert($product_medicines->toArray());

            foreach ($product->pv as $product_varient) {
                $product_varient->product_id = $product->id;
                DB::table('product_medicine_varients')->where('product_id', $product->id)->delete();
                $product_varient = collect($product_varient)
                    ->except(['attachedFiles_pv_images']);
                $product_varient["pv_attribute"] = json_encode($product_varient["pv_attribute"]);
                DB::table('product_medicine_varients')->insert($product_varient->toArray());
            }

            return response()->json($product->id);
        } else {
            return ("exists");
        }
    }

    function update_product_image($product)
    {
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
                    $title = $image->title;
                    $title = str_replace('/', '-', $title);
                    $image_name = 'uploads/medicines/' .  $product->id . $title;
                    $image_name = check_image_name($image_name);
                    if (!file_exists(public_path($image_name))) {
                        DB::table('product_images')->insert([
                            "product_id" => $product->id,
                            "url" => $image_name,
                        ]);
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
            foreach ($product->pv[0]->attachedFiles_pv_images as $image) {
                try {
                    $title = $image->title;
                    $title = str_replace('/', '-', $title);
                    $image_name = 'uploads/medicines/' .  $product->id . $title;
                    $image_name = check_image_name($image_name);
                    if (file_exists(public_path($image_name))) {
                        DB::table('product_images')->insert([
                            "product_id" => $product->id,
                            "url" => $image_name,
                        ]);
                    }
                } catch (\Throwable $th) {
                    throw $th;
                    // file_put_contents(public_path('uploads/failed/' . $product->id . $image->title . '.json'), json_encode($image));
                }
            }
        }
        return;
    }

    $data = request()->all();
    $data = json_encode($data);
    $product = json_decode($data);
    // return upload_product($product);
    return update_product_image($product);
});

Route::get('/all_null_image', function () {
    $products = App\Modules\ProductManagement\Product\Models\Model::select('id')
        ->whereDoesntHave('product_image')->count();
        // ->whereHas('product_image')->count();
    // $ids = $products->filter(function ($item) {
    //     if (!$item->product_image()->count()) {
    //         return $item->id;
    //     }
    // });
    return $products;
});

Route::any('/up-product-image', function () {
    $id = request()->id;
    $products = file_get_contents(public_path('arogga/products.json'));
    $products = json_decode($products);
    $product = collect($products)->where('id', $id)->first();

    $count = DB::table('product_images')->where('product_id', $product->id)->count();
    if($count){
        return  response()->json($count);
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
                $title = $image->title;
                $title = str_replace('/', '-', $title);
                $image_name = 'uploads/medicines/' .  $product->id . $title;
                $image_name = check_image_name($image_name);
                if (!file_exists(public_path($image_name))) {
                    $image_file = file_get_contents($image->src);
                    file_put_contents(public_path($image_name), $image_file);
                }
                DB::table('product_images')->insert([
                    "product_id" => $product->id,
                    "url" => $image_name,
                ]);
            } catch (\Throwable $th) {
                // throw $th;
                // file_put_contents(public_path('uploads/failed/' . $product->id . $image->title . '.json'), json_encode($image));
            }
        }
        foreach ($product->pv[0]->attachedFiles_pv_images as $image) {
            try {
                $title = $image->title;
                $title = str_replace('/', '-', $title);
                $title = preg_replace("/[^a-zA-Z]/", "", $title);
                $image_name = 'uploads/medicines/' .  $product->id . $title;
                $image_name = check_image_name($image_name);
                if (!file_exists(public_path($image_name))) {
                    $image_file = file_get_contents($image->src);
                    file_put_contents(public_path($image_name), $image_file);
                }
                DB::table('product_images')->insert([
                    "product_id" => $product->id,
                    "url" => $image_name,
                ]);
            } catch (\Throwable $th) {
                // throw $th;
                // file_put_contents(public_path('uploads/failed/' . $product->id . $image->title . '.json'), json_encode($image));
            }
        }
        return 'ok';
    }

    return 'none';

    // dd($id, $product);
});

Route::get('/tte',function(){
    $images = DB::table('product_images')->where('url','LIKE','%uploadsmedicines%')->delete();
    dd($images);
});

Route::get('/all-list', function () {
    file_put_contents(public_path('arogga/brands.json'), "[" . PHP_EOL, FILE_APPEND | LOCK_EX);
    for ($i = 5988; $i <= 10542; $i++) {
        try {
            $products = file_get_contents(public_path("arogga/category_products/$i.json"));
            $products = json_decode($products);

            foreach ($products->filters->_brand_id as $brand) {
                file_put_contents(public_path('arogga/brands.json'), (json_encode($brand) . ",") . PHP_EOL, FILE_APPEND | LOCK_EX);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage() .  "<br/>";
        }
    }
    file_put_contents(public_path('arogga/brands.json'), "]" . PHP_EOL, FILE_APPEND | LOCK_EX);
});

Route::get('/all-form-list', function () {
    file_put_contents(public_path('arogga/forms.json'), "[" . PHP_EOL, FILE_APPEND | LOCK_EX);
    for ($i = 5988; $i <= 10542; $i++) {
        try {
            $products = file_get_contents(public_path("arogga/category_products/$i.json"));
            $products = json_decode($products);

            foreach ($products->filters->_form as $form => $count) {
                file_put_contents(public_path('arogga/forms.json'), (json_encode($form) . ",") . PHP_EOL, FILE_APPEND | LOCK_EX);
            }
        } catch (\Throwable $th) {
            // echo $th->getMessage() .  "<br/>";
        }
    }
    file_put_contents(public_path('arogga/forms.json'), "]" . PHP_EOL, FILE_APPEND | LOCK_EX);
});

Route::get('/up-forms', function () {
    $forms = file_get_contents(public_path('arogga/forms.json'));
    $forms = json_decode($forms);

    function save_form($title)
    {
        $exist = DB::table('product_medicine_forms')->where('title', $title)->first();
        if (!$exist) {
            DB::table('product_medicine_forms')->insert([
                "title" => $title,
                "slug" => Str::slug($title),
                "created_at" => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
    foreach ($forms as $form) {
        save_form($form);
    }
});

Route::get('/up-brands', function () {
    $brands = file_get_contents(public_path('arogga/brands.json'));
    $brands = json_decode($brands);

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
    foreach ($brands as $brand) {
        save_band($brand);
    }
});


function readAllFilesFromFolder($directory)
{
    $files = [];

    // Create a recursive iterator to loop through the directory and its subdirectories
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    foreach ($iterator as $file) {
        // Skip directories
        if ($file->isDir()) {
            continue;
        }

        // Add the relative file path to the array
        $files[] = str_replace('\\', '/', $file->getPathname());
    }

    return $files;
}

//$directory = public_path('products');
//$fileList = readAllFilesFromFolder($directory);

//return ($fileList);


Route::get('/set-all-form-list', function () {
    $files = file_get_contents(public_path('all_electric_product_files.json'));
    $files = json_decode($files);
    $all_products = [];
    $id_start = 67022;
    function processFilePath($filePath)
    {
        $baseDir = "F:/workspace/solution/projects/mega_ecom_admin/public/products/";
        $relativePath = str_replace($baseDir, '', $filePath);
        $relativePath = preg_replace('/\.json$/', '', $relativePath);
        $pathParts = explode('/', $relativePath);
        foreach ($pathParts as $key => $value) {
            $value = str_replace('_', '', $value);
            $value = str_replace('-', ' ', $value);
            $value = strtolower($value);
            $pathParts[$key] = $value;
        }
        $pathParts = array_unique($pathParts);
        return $pathParts;
    }
    foreach ($files as $file) {
        $products = json_decode(file_get_contents($file));
        $categories = processFilePath($file);
        foreach ($products as $key => $product) {
            $products[$key]->categories = $categories;
            $products[$key]->id = $id_start++;
        }
        // dd($file, $categories, $products[2]);
        $all_products = array_merge($all_products, $products);
    }
    file_put_contents(public_path('all_electric_products.json'), json_encode($all_products));
});

Route::get('/set-all-form-listsss', function () {
    $files = file_get_contents(public_path('all_electric_product_files.json'));
    $files = json_decode($files);
    $all_products = [];
    $id_start = 67022;
    function processFilePath($filePath)
    {
        $baseDir = "F:/workspace/solution/projects/mega_ecom_admin/public/products/";
        $relativePath = str_replace($baseDir, '', $filePath);
        $relativePath = preg_replace('/\.json$/', '', $relativePath);
        $pathParts = explode('/', $relativePath);
        foreach ($pathParts as $key => $value) {
            $value = str_replace('_', '', $value);
            $value = str_replace('-', ' ', $value);
            $value = strtolower($value);
            $pathParts[$key] = $value;
        }
        $pathParts = array_unique($pathParts);
        return $pathParts;
    }

    function get_category_url($filePath)
    {
        $fileName = basename($filePath, '.json');
        $transformedName = str_replace('_', '', $fileName);
        return $transformedName;
    }

    foreach ($files as $file) {
        $products = json_decode(file_get_contents($file));
        $categories = processFilePath($file);
        foreach ($products as $key => $product) {
            $products[$key]->categories = $categories;
            $products[$key]->id = $id_start++;
            $products[$key]->category_url = "https://www.startech.com.bd/" . get_category_url($file);
        }
        // dd($file, $categories, $products[2]);
        $all_products = array_merge($all_products, $products);
    }
    file_put_contents(public_path('all_electric_products.json'), json_encode($all_products));
});

Route::get('/make-image-list', function () {
    $products = json_decode(file_get_contents(public_path("all_electric_products.json")));
    $product_images = [];
    foreach ($products as $key => $product) {
        $product_image = [
            "id" => $product->id,
            "url" => $product->url,
            "thumb" => $product->img,
            "images" => [],
        ];

        if(isset($product->images) && count($product->images)){
            foreach ($product->images as $image) {
                $product_image["images"][] = $image;
            }
        }

        $product_images[] = $product_image;
    }

    file_put_contents(public_path('all_electric_images.json'),json_encode($product_images));

    dd(count($products));
    // dd($product_images[0]);
});

Route::post('/up-product', function () {
    /** functionalities */
    set_time_limit(0);
    ini_set('max_execution_time', 0);

    $index = request()->si;
    $products = get_product_json();
    $product = $products[$index];
    $p = DB::table('products')->where('id', $product->id)->first(); if($p){ echo "done"; return 0;};
    // dd($index, $product);

    $slug = create_slug($product->url);
    $product_category_ids = insert_categories($product);

    // dd($index, $product);
    $brand_id = null;
    if (isset($product->brand)) {
        $brand_id = insert_brand($product->brand);
    }
    $price = $product->price_single > 0 ? $product->price_single : 0;

    $product_id = insertProduct([
        'id' => $product->id,
        'product_category_group_id' => 3,
        'is_featured' => 0,
        'is_new' => 0,
        'is_available' => isset($product->status) && $product->status  == "In Stock" ? 1 : 0,
        'is_pre_order' => 0,
        'is_up_coming' => 0,
        'is_emi_support' => 0,
        'is_best_selling' => 0,
        'is_trending' => 0,
        'total_sold' => 0,
        'barcode' => $product->code ?? null,
        'type' => 'product',

        'title' => $product->title,
        'short_description' => json_encode($product->product_page_short_description ?? []),
        'specification' => json_encode($product->specifications ?? []),
        'description' => replaceCompanyName($product->full_description ?? ""),
        'video_url' => null,
        'product_menufecturer_id' => null,
        'product_brand_id' => $brand_id,
        'sku' => $product->code ?? null,
        'product_unit_id' => 68838,

        'alert_quantity' => 10,
        'seller_points' => 5,
        'is_returnable' => 0,

        'expiration_days' => '365',
        'product_warranty' => 12,
        'warranty_policy' => null,
        'guarenty_policy' => null,

        'price_type' => 'single',
        'tax_type' => 'inclusive',
        'tax_amount' => 0.00,
        'purchase_price' => $price > 100 ? $product->price_single - 100 : 0,
        'customer_sales_price' => $price,
        'retailer_sales_price' => $price,
        'minimum_sale_price' => $price,
        'maximum_sale_price' => $price,
        'profit_margin_percent' => 5,

        'discount_type' => 'percent',
        'discount_amount' => 0.00,

        'meta_title' => replaceCompanyName($product->product_seo_title ?? ""),
        'meta_description' => replaceCompanyName($product->product_seo_description ?? ""),
        'meta_keywords' => replaceCompanyName($product->product_seo_keywords ?? ""),
        'search_keywords' => $product->title . " " . replaceCompanyName($product->product_seo_keywords ?? ""),

        'creator' => 1,
        'slug' => $slug,
        'is_hide' => 0,
        'status' => 'active',

        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('product_category_products')->where('product_id', $product_id)->delete();
    foreach ($product_category_ids as $cat_id) {
        DB::table('product_category_products')->insert([
            'product_category_id' => $cat_id,
            'product_id' => $product_id,
            'product_category_group_id' => 3,
        ]);
    }

    return $product_id;
    // dd($index, $product);
    // return upload_product($product);
    // return update_product_image($product);
});
Route::post('/up-product', function () {
    set_time_limit(0);
    ini_set('max_execution_time', 0);

    $index = request()->si;
    $products = file_get_contents(public_path('all_electric_images.json'));
    $products = json_decode($products);
    $product = $products[$index];

    $product_id = $product->id;

    $image_name = basename($product->thumb);;
    $directory = public_path('uploads/products/' . $product_id);
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
    $image_name = $directory . "/$image_name";
    if (!file_exists($image_name)) {
        $image_file = file_get_contents($product->thumb);
        file_put_contents($image_name, $image_file);
    }

    if (isset($product->images) && count($product->images)) {
        foreach ($product->images as $key => $image) {
            $image_name = basename($image);;
            $directory = public_path('uploads/products/' . $product_id);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $image_name = $directory . "/$image_name";
            if (!file_exists($image_name)) {
                $image_file = file_get_contents($image);
                file_put_contents($image_name, $image_file);
            }
        }
    }

    return "ok";
});


Route::get('/up-image-single', function () {
    function extractPathFromUploads($filePath)
    {
        $baseDir = 'uploads';
        $position = strpos($filePath, $baseDir);
        if ($position !== false) {
            return substr($filePath, $position);
        }
        return '';
    }

    $paths = json_decode(file_get_contents(public_path('all_electric_uploaded.json')));

    foreach ($paths as $path) {
        // $path = "F:/workspace/solution/projects/mega_ecom_admin/public/uploads/products/67022/i62-228x228.jpg";
        $product_id = explode("/", $path)[8];
        $image_name = explode("/", $path)[9];
        $db_path = extractPathFromUploads($path);
        $is_thumb = strpos($image_name, '228x228') !== false ? 1 : 0;
        // Storage::disk('s3')->putFileAs("s3uploads/products/$product_id",$path, $image_name);

        // starts from 69780
        $check = DB::table('product_images')
            ->where('product_id', $product_id)
            ->where('url', $db_path)
            ->first();
        if (!$check) {
            DB::table('product_images')
                ->insert([
                    "product_id" => $product_id,
                    "caption" => null,
                    "url" => $db_path,
                    "alt" => null,
                    "is_thumb" => $is_thumb,
                    "is_primary" => $is_thumb,
                    "is_secondary" => 0,
                    "creator" => 1,
                    "slug" => $product_id . rand(100, 999),
                    "created_at" => now(),
                ]);
            // dd($product_id, $image_name, $db_path);
        }
    }
});

Route::get('/get-electric-images-from-uploads', function () {
    function readAllFilesFromFolder($directory)
    {
        $files = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                continue;
            }
            $files[] = str_replace('\\', '/', $file->getPathname());
        }
        return $files;
    }
    $directory = public_path('uploads/products');
    $directories =  readAllFilesFromFolder($directory);
    file_put_contents(public_path("all_electric_uploaded.json"), json_encode($directories));
    return $directories[5];
});
