import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'employee-type';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'employee-type',

    select_fields: ['id', 'title','description','created_at'],
    sort_by_cols: ['id', 'title', 'description','created_at'],

    module_name: 'EmployeeType',
    store_prefix: 'EmployeeType',
    route_prefix: `EmployeeType`,
    route_path: `employee-type`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
