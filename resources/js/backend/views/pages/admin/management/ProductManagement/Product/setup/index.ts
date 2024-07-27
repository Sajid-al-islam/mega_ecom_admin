import app_config from '../../../../app_config';
import setup_type from './setup_type';

const prefix: string = 'Product';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'products',

    module_name: 'product',
    store_prefix: 'product',
    route_prefix: `Product`,
    route_path: `products`,

    select_fields: [
        'id', 'title', 'product_brand_id', 'sku', 'product_unit_id', 'alert_quantity',
        'is_new', 'is_featured', 'is_available', 'is_pre_order', 'is_up_coming','is_best_selling','is_trending',

        'purchase_price', 'customer_sales_price', 'retailer_sales_price', 'minimum_sale_price', 'maximum_sale_price',
        'profit_margin_percent', 'discount_type', 'discount_amount', 'tax_type', 'tax_amount',

        'expiration_days',
        'total_sold', 'barcode',
        'slug', 'created_at', 'status',
    ],
    sort_by_cols: ['id', 'title', 'is_featured', 'is_nav', 'created_at', 'status'],

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
