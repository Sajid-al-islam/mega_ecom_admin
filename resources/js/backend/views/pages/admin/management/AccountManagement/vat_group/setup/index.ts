import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'vat-groups';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'vat-groups',

    select_fields: ['id', 'title', 'slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'title', 'created_at', 'status'],

    module_name: 'vat-groups',
    store_prefix: 'vat-groups',
    route_prefix: `Vat-groups`,
    route_path: `vat-groups`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
