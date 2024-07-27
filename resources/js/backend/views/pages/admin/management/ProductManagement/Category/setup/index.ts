import app_config from '../../../../app_config';
import setup_type from './setup_type';

const prefix: string = 'Category';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'product-categories',

    module_name: 'category',
    store_prefix: 'category',
    route_prefix: `Category`,
    route_path: `categories`,

    select_fields: [
        'id', 'title', 'parent_id', 'product_category_group_id',
        'is_nav', 'is_featured', 'image', 'slug', 'created_at', 'status',
        'meta_title', 'meta_keywords', 'meta_description', 'search_keywords',
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
