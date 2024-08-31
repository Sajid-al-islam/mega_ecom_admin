import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'product-wear-houses';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'product-wear-houses',

    select_fields: ['id', 'title', 'image', 'product_wearhouse_branch_id', 'slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'title', 'product_wearhouse_branch_id', 'created_at', 'status'],

    module_name: 'wear-houses',
    store_prefix: 'wear-houses',
    route_prefix: `Wear-houses`,
    route_path: `wear-houses`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
