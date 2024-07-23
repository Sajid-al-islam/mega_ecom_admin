import app_config from '../../../../app_config';
import setup_type from './setup_type';

const prefix: string = 'Variant';
const setup: setup_type = {
    prefix,
    permission: [`admin`,`super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'product-varients',

    module_name: 'variant',
    store_prefix: 'variant',
    route_prefix: `Variant`,
    route_path: `variants`,

    select_fields: ['id', 'title', 'product_varient_group_id','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'title', 'created_at', 'status'],

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
