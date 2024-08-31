import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'Email-configurations';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'email-configurations',

    select_fields: ['id', 'type', 'email', 'user', 'host', 'port', 'is_active', 'slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'type', 'email', 'user', 'created_at', 'status'],

    module_name: 'email-configurations',
    store_prefix: 'email-configurations',
    route_prefix: `Email-configuration`,
    route_path: `email-configurations`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
