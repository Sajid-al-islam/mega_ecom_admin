import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'employee-resignation';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'employee-resignation',

    select_fields: ['id', 'user_id','resign_date','created_at'],
    sort_by_cols: ['id', 'user_id','resign_date','created_at'],

    module_name: 'Resignation',
    store_prefix: 'Resignation',
    route_prefix: `Resignation`,
    route_path: `employee-resignation`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
