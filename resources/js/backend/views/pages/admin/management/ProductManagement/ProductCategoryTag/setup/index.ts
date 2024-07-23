import app_config from '../../../../app_config';
import setup_type from './setup_type';

const prefix: string = 'Product Category Tag';
const setup: setup_type = {
    prefix,
    permission: [`admin`,`super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'product-category-tags',

    module_name: 'product_category_tag',
    store_prefix: 'product_category_tag',
    route_prefix: `ProductCategoryTag`,
    route_path: `product-category-tags`,

    select_fields: ['id', 'title','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'title', 'created_at', 'status'],

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
