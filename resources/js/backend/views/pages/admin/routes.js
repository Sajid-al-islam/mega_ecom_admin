import Layout from "./partials/Layout.vue"
import Dashboard from "./Dashboard.vue"

//user management routes
import user_routes from "./management/UserManagement/users/setup/routes";
import user_supplier_routes from "./management/UserManagement/suppliers/setup/routes";
import user_supplier_type_routes from "./management/UserManagement/supplier_type/setup/routes";
import user_retailer_routes from "./management/UserManagement/retailers/setup/routes";
import user_retailer_type_routes from "./management/UserManagement/retailer_type/setup/routes";
import user_employer_routes from "./management/UserManagement/employees/setup/routes";
import user_customer_routes from "./management/UserManagement/customers/setup/routes";

//Configuration routes
import email_configuration_routes from "./management/Configuration/email/setup/routes"
import sms_configuration_routes from "./management/Configuration/sms/setup/routes"
import website_configuration_routes from "./management/Configuration/website/setup/routes"

//Inventory Management
import inventory_wearhouse__branch_routes from "./management/Inventory/wearhouse_branch/setup/routes"
import inventory_wearhouse_routes from "./management/Inventory/wearhouse/setup/routes"
import inventory_stocks_routes from "./management/Inventory/stocks/setup/routes"

//Accounting Management
import account_vat_routes from "./management/AccountManagement/vat/setup/routes"
import account_vat_group_routes from "./management/AccountManagement/vat_group/setup/routes"
import account_account_expenditure_routes from "./management/AccountManagement/accountExpenditure/setup/routes"
import account_account_expenditure_group_routes from "./management/AccountManagement/accountExpenditureGroup/setup/routes"
import account_account_heads_routes from "./management/AccountManagement/AccountHeads/setup/routes"
import account_account_routes from "./management/AccountManagement/Account/setup/routes"
import account_account_number_routes from "./management/AccountManagement/AccountNumber/setup/routes"

import product_brand_routes from "./management/ProductManagement/Brand/setup/routes"
import product_manufacture_routes from "./management/ProductManagement/Manufacture/setup/routes"
import product_category_routes from "./management/ProductManagement/Category/setup/routes"
import CategoryGroup from "./management/ProductManagement/CategoryGroup/setup/routes"
import product_varient_routes from "./management/ProductManagement/Variant/setup/routes"
import product_varient_group_routes from "./management/ProductManagement/VariantGroup/setup/routes"
import product_varient_value_routes from "./management/ProductManagement/VariantValue/setup/routes"
import product_color_routes from "./management/ProductManagement/Color/setup/routes"
import product_routes from "./management/ProductManagement/Product/setup/routes"
import product_unit_groups from "./management/ProductManagement/UnitGroup/setup/routes"
import product_units from "./management/ProductManagement/Unit/setup/routes"
import product_tags from "./management/ProductManagement/ProductTag/setup/routes"
import product_category_tags from "./management/ProductManagement/ProductCategoryTag/setup/routes"
import BarcodeGenerator from "./management/ProductManagement/Barcode/BarcodeGenerator.vue"

// import configuration_routes from "./management/Configuration/setup/routes"
import report_routes from "./management/Report/setup/routes"

import ecommer_order_routes from "./management/Ecommerce/Order/setup/routes";

// Sajid routes
import hrm_employee_routes from "./management/HRM/employees/setup/routes";
import job_title_routes from "./management/HRM/jobTitles/setup/routes";
import work_department_routes from "./management/HRM/WorkDepartment/setup/routes";
import attendence_routes from "./management/HRM/attendence/setup/routes";
import employee_type_routes from "./management/HRM/EmployeeType/setup/routes";

const routes = {
    path: '',
    component: Layout,
    children: [
        {
            path: 'dashboard',
            component: Dashboard,
            name: 'adminDashboard',
        },
        {
            path:'',
            name: 'AllCategory',
            component: Dashboard,
        },
        {
            path:'',
            name: 'AllBlog',
            component: Dashboard,
        },
        {
            path:'barcode-generate',
            name: 'BarcodeGenerator',
            component: BarcodeGenerator,
        },
        //blog management routes
        // blog_category_routes,
        // blog_routes,
        //user management routes
        user_routes,
        user_supplier_routes,
        user_retailer_routes,
        user_employer_routes,
        user_customer_routes,
        user_supplier_type_routes,
        user_retailer_type_routes,

        //Configuration routes
        email_configuration_routes,
        sms_configuration_routes,
        website_configuration_routes,

        //Inventory Management
        inventory_wearhouse__branch_routes,
        inventory_wearhouse_routes,
        inventory_stocks_routes,

        //Accounting Management
        account_vat_group_routes,
        account_vat_routes,
        account_account_expenditure_routes,
        account_account_expenditure_group_routes,
        account_account_heads_routes,
        account_account_routes,
        account_account_number_routes,

        // product management
        product_brand_routes,
        product_manufacture_routes,
        product_category_routes,
        CategoryGroup,
        product_varient_group_routes,
        product_varient_routes,
        product_varient_value_routes,
        product_color_routes,
        product_routes,
        product_unit_groups,
        product_units,
        product_tags,
        product_category_tags,

        // configuration_routes,
        report_routes,

        ecommer_order_routes,

        // sajid routes
        hrm_employee_routes,
        job_title_routes,
        work_department_routes,
        attendence_routes,
        employee_type_routes
    ]
};


export default routes;
