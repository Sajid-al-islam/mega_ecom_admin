import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'accounts';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'accounts',

    select_fields: ['id', 'account_head_id', 'title','description','transaction_start_date','account_transaction_type','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'title', 'description', 'account_head_id','created_at', 'status'],

    module_name: 'accounts',
    store_prefix: 'accounts',
    route_prefix: `Accounts`,
    route_path: `accounts`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
