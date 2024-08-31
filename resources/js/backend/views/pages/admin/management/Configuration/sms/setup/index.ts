import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'SMS-configurations';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 's-m-s-configurations',

    select_fields: ['id', 'sms_provider', 'sms_gateway_url', 'api_key', 'secret_key', 'caller_id', 'user_name', 'caller_phone_number', 'password','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'sms_provider', 'user_name', 'caller_id', 'created_at', 'status'],

    module_name: 'sms-configurations',
    store_prefix: 'sms-configurations',
    route_prefix: `SMS-configuration`,
    route_path: `sms-configurations`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
