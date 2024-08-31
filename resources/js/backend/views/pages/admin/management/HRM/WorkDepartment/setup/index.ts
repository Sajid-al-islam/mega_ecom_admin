import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'work-department';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'work-department',

    select_fields: ['id', 'title','description','created_at'],
    sort_by_cols: ['id', 'title', 'description','created_at'],

    module_name: 'WorkDepartMent',
    store_prefix: 'WorkDepartMent',
    route_prefix: `WorkDepartMent`,
    route_path: `work-department`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
