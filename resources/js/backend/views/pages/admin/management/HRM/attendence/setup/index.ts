import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'Employee Attendence';
const setup: setup_type = {
    prefix,
    permission: [`admin`,`super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'employee-attendence',

    select_fields: ['id', 'in_time', 'out_time', 'grace_time', 'working_hours','status','late_time', 'over_time', 'early_out_time'],
    sort_by_cols: ['id', 'in_time', 'out_time', 'grace_time', 'working_hours','status','late_time', 'over_time', 'early_out_time'],

    module_name: 'attendence',
    store_prefix: 'attendence',
    route_prefix: `attendence`,
    route_path: `hrm-attendence`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
