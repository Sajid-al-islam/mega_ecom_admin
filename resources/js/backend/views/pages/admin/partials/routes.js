import Layout from "./Layout.vue"
import Dashboard from "../Dashboard.vue"

//user management routes
import user_routes from "../management/UserManagement/users/setup/routes";

import product_brand_routes from "../management/ProductManagement/Brand/setup/routes"
import product_manufacture_routes from "../management/ProductManagement/Manufacture/setup/routes"
import product_category_routes from "../management/ProductManagement/Category/setup/routes"
import product_varient_routes from "../management/ProductManagement/Variant/setup/routes"
import product_varient_group_routes from "../management/ProductManagement/VariantGroup/setup/routes"
import product_varient_value_routes from "../management/ProductManagement/VariantValue/setup/routes"
import product_color_routes from "../management/ProductManagement/Color/setup/routes"
import product_routes from "../management/ProductManagement/Product/setup/routes"
import product_unit_groups from "../management/ProductManagement/UnitGroup/setup/routes"
import product_units from "../management/ProductManagement/Unit/setup/routes"
import product_tags from "../management/ProductManagement/ProductTag/setup/routes"
import product_category_tags from "../management/ProductManagement/ProductCategoryTag/setup/routes"

import configuration_routes from "../management/Configuration/setup/routes"
import report_routes from "../management/Report/setup/routes"

import ecommer_order_routes from "../management/Ecommerce/Order/setup/routes"

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
        //blog management routes
        // blog_category_routes,
        // blog_routes,
        //user management routes
        user_routes,

        // product management
        product_brand_routes,
        product_manufacture_routes,
        product_category_routes,
        product_varient_group_routes,
        product_varient_routes,
        product_varient_value_routes,
        product_color_routes,
        product_routes,
        product_unit_groups,
        product_units,
        product_tags,
        product_category_tags,

        configuration_routes,
        report_routes,

        ecommer_order_routes,
    ]
};


export default routes;
