import setup_type from './setup_type';

const prefix: string = 'User';
const setup: setup_type = {
    prefix,
    permission: [`admin`,`super_admin`],

    api_host: location.origin,
    api_version: 'api/v1',
    api_end_point: 'users',

    select_fields: ['id', 'name', 'email', 'photo', 'phone_number','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'name', 'email', 'phone_number', 'created_at', 'status'],

    module_name: 'users',
    route_prefix: `User`,
    store_prefix: 'users',

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
