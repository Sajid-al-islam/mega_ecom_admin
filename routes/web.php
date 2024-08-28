<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::get('/cache/{file_name}', 'AssetController@cache')->where('file_name', '.*');
    Route::get('/resize/cache/{file_name}', 'AssetController@cache_resize')->where('file_name', '.*');
});

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
Auth::routes();

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

/** start from id 67022 */
function get_product_json()
{
    $products = json_decode(file_get_contents('all_electric_products.json'));
    return $products;
}

/**
 * Insert a new product into the 'products' table.
 *
 * Example usage:
 *
 * ```php
 * insertProduct([
 *     'product_category_group_id' => 1,
 *     'is_featured' => 1,
 *     'is_new' => 1,
 *     'is_available' => 1,
 *     'is_pre_order' => 0,
 *     'is_up_coming' => 0,
 *     'is_emi_support' => 1,
 *     'is_best_selling' => 1,
 *     'is_trending' => 1,
 *     'total_sold' => 100,
 *     'barcode' => '123456789',
 *     'type' => 'product',
 *     'title' => 'Sample Product Title',
 *     'short_description' => 'This is a short description.',
 *     'specification' => ['key1' => 'value1', 'key2' => 'value2'],
 *     'description' => 'This is a long description of the product.',
 *     'video_url' => 'http://example.com/video',
 *     'product_menufecturer_id' => 1,
 *     'product_brand_id' => 1,
 *     'sku' => 'SKU12345',
 *     'product_unit_id' => 1,
 *     'alert_quantity' => 10,
 *     'seller_points' => 'Some seller points',
 *     'is_returnable' => 1,
 *     'expiration_days' => '365',
 *     'product_warranty' => 12,
 *     'warranty_policy' => 'This is the warranty policy.',
 *     'guarenty_policy' => 'This is the guarantee policy.',
 *     'price_type' => 'single',
 *     'tax_type' => 'inclusive',
 *     'tax_amount' => 15.00,
 *     'purchase_price' => 100.00,
 *     'customer_sales_price' => 150.00,
 *     'retailer_sales_price' => 140.00,
 *     'minimum_sale_price' => 130.00,
 *     'maximum_sale_price' => 160.00,
 *     'profit_margin_percent' => 20.00,
 *     'discount_type' => 'percent',
 *     'discount_amount' => 10.00,
 *     'meta_title' => 'SEO Meta Title',
 *     'meta_description' => 'SEO Meta Description',
 *     'meta_keywords' => 'keyword1, keyword2, keyword3',
 *     'search_keywords' => 'search, keywords',
 *     'creator' => 1,
 *     'slug' => 'sample-product-title',
 *     'is_hide' => 0,
 *     'status' => 'active',
 * ]);
 * ```
 */
function insertProduct($data)
{
    $product = DB::table('products')->where('id', $data['id'])->first();
    if ($product) {
        return $product->id;
    } else {
        return DB::table('products')->insertGetId($data);
    }
}

function create_slug($url)
{
    $path = parse_url($url, PHP_URL_PATH);
    $transformedPath = str_replace('/', '-', trim($path, '/'));
    return $transformedPath;
}

function replaceCompanyName($text)
{
    $patterns = [
        '/Star Tach/i',
        '/star Tech/i',
        '/Star Tech/i',
        '/star tech/i',
        '/startech/i',
    ];
    $replacement = 'Etek Enterprise';
    return preg_replace($patterns, $replacement, $text);
}

Route::get('/up-products', function () {
    dd(count(get_product_json()));
});

function insert_categories($product)
{
    $product_category_ids = [];
    foreach ($product->categories as $key => $category) {
        $check = DB::table('product_categories')->where('title', $category)->first();
        $parent_id = null;
        if (!$check) {
            if ($key > 0) {
                $parent_id = DB::table('product_categories')->where('title', $product->categories[$key - 1])->first()->id;
            }
            $cat_id = DB::table('product_categories')->insertGetId([
                'title' => $category,
                'parent_id' => $parent_id,
                'product_category_group_id' => 3,

                'is_nav' => 0,
                'is_featured' => 0,
                'serial' => null,
                'weight' => null,

                'image' => null,
                'image_alt' => null,

                'meta_title' => replaceCompanyName($product->cat_seo_title ?? ""),
                'meta_description' => replaceCompanyName($product->cat_seo_description ?? ""),
                'meta_keywords' => replaceCompanyName($product->cat_seo_keywords ?? ""),
                'search_keywords' => $category . " " . Str::slug($category ?? ""),

                'page_header_title' => replaceCompanyName($product->category_intro_h1 ?? ""),
                'page_header_description' => replaceCompanyName($product->category_intro_p ?? ""),
                'page_full_description_title' => replaceCompanyName($product->cat_seo_title ?? ""),
                'page_full_description' => replaceCompanyName($product->category_description ?? ""),
                'related_product_title' => "Latest " . $category . " Price List in BD",

                'bc_url' => $product->category_url,
                'bc_id' => null,
                'creator' => 1,
                'slug' => Str::slug($category),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $product_category_ids[] = $cat_id;
        } else {
            $product_category_ids[] = $check->id;
        }
    }
    return $product_category_ids;
}

function insert_brand($brand)
{
    $brand = DB::table('product_brands')->where('title', $brand)->first();
    if ($brand) {
        return $brand->id;
    } else {
        return DB::table('product_brands')->insertGetId([
            'title' => $brand,
            'slug' => Str::slug($brand),
        ]);
    }
}

// Route::view('up', "up");
// Route::view('up-image', "up-image");
Route::view('up-image-s3', "up-image-s3");

Route::post('/up-product-image-s3', function () {
    $files = json_decode(file_get_contents(public_path("all_electric_uploadeds.json")));

    $file = $files[request()->si];
    $product_id = explode("/", $file)[8];
    $image_name = explode("/", $file)[9];

    $url = "https://etek-ecom.s3.amazonaws.com/uploads/products/$product_id/$image_name";
    $headers = @get_headers($url);

    if ($headers && strpos($headers[0], '200')) {

    } else {
        $s3_image = Storage::disk('s3')->putFileAs("uploads/products/$product_id", $file, $image_name, 'public');
        // dd($product_id, explode("/", $file));
    }

    return $product_id;
});
