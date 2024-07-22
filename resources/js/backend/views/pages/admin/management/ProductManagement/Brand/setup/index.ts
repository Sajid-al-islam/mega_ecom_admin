import setup_type from './setup_type';

const prefix: string = 'Brand';
const setup: setup_type = {
    prefix,
    permission: [`admin`,`super_admin`],

    api_host: location.origin,
    api_version: 'api/v1',
    api_end_point: 'product-brands',

    module_name: 'brands',
    route_prefix: `Brand`,
    store_prefix: 'brands',

    select_fields: ['id', 'title', 'serial', 'is_featured', 'image','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'title', 'serial', 'is_featured', 'created_at', 'status'],

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
