<?php

use Carbon\Carbon;

/**
 * ```js
  stockLogStore([
        "product_wearhouse_id" => int,
        "date" => date,
        "stock_type" => string,
        "product_id" => int,
        "qty" => int,
        "purchase_order_id" => int,
        "purchase_return_id" => int,
        "sales_order_id" => int,
        "sales_return_id" => int,
        "product_waste_id" => int,
    ])
 */
function stockLogStore($stockData = [])
{
    $producStockModel = \App\Modules\StockManagement\ProductStock\Models\StockLogModel::class;

    if (!count($stockData)) {
        return null;
    }

    $stockLog = $producStockModel::create([
        "product_wearhouse_id" => $stockData["product_wearhouse_id"],
        "date" => $stockData["date"],
        "stock_type" => $stockData["stock_type"],
        "product_id" => $stockData["product_id"],
        "qty" => $stockData["qty"],
        "purchase_order_id" => $stockData["purchase_order_id"],
        "purchase_return_id" => $stockData["purchase_return_id"],
        "sales_order_id" => $stockData["sales_order_id"],
        "sales_return_id" => $stockData["sales_return_id"],
        "product_waste_id" => $stockData["product_waste_id"],
    ]);

    return $stockLog;
    
}
