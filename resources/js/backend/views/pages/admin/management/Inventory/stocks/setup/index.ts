import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'product-stocks';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'product-stocks',

    select_fields: ['id', 'date', 'stock_type', 'product_id', 'qty', 'bill_receipt_no', 'product_wearhouse_id', 'purchase_order_id','purchase_return_id','sales_order_id', 'sales_return_id','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'date', 'stock_type', 'qty', 'created_at', 'status'],

    module_name: 'stocks',
    store_prefix: 'stocks',
    route_prefix: `Stocks`,
    route_path: `stocks`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
