import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'job-titles';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'job-titles',

    select_fields: ['id', 'title','description','created_at'],
    sort_by_cols: ['id', 'title', 'description','created_at'],

    module_name: 'jobTitle',
    store_prefix: 'jobTitle',
    route_prefix: `jobTitle`,
    route_path: `job-title`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
