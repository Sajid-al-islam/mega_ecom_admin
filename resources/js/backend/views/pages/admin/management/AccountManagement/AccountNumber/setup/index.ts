import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'account numbers';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'account-numbers',

    select_fields: ['id', 'account_head_id', 'account_id','account_number','account_name','opening_balance','amount','account_transaction_id','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'account_id', 'account_number', 'account_name','created_at', 'status'],

    module_name: 'account-numbers',
    store_prefix: 'account-numbers',
    route_prefix: `Account-numbers`,
    route_path: `account-numbers`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
