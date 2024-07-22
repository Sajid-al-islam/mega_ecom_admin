<template>
    <!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper">
        <div class="brand-logo">
            <router-link :to="{ name: `adminDashboard` }" class="d-flex align-items-center">
                <!-- <img src="https://files.etek.com.bd/images/etek_logo.png" class="logo-icon" alt="logo icon"> -->
                <h5 class="logo-text">ETEK ADMIN</h5>
            </router-link>
            <div class="close-btn"><i class="zmdi zmdi-close"></i></div>
        </div>

        <ul class="metismenu" id="menu">
            <li>
                <router-link :to="{ name: `adminDashboard` }" class="" href="javascript:void();">
                    <div class="parent-icon">
                        <!-- <img src="https://files.etek.com.bd/images/icon_dashboard.png" alt=""> -->
                    </div>
                    <div class="menu-title">Dashboard</div>
                </router-link>
            </li>

            <side-bar-drop-down-menus :icon="`fa fa-plus`"
                :icon_image="`https://files.etek.com.bd/images/icon_user.png`" :menu_title="`User Management`" :menus="[
                    {
                        route_name: `AllUser`,
                        title: `Customers`,
                    },
                    {
                        route_name: `AllUser`,
                        title: `Suppliers`,
                    },
                    {
                        route_name: `AllUser`,
                        title: `Retailers`,
                    },
                    {
                        route_name: `AllUser`,
                        title: `Employees`,
                    },

                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_accounting.png`"
                :icon="`fa fa-plus`" :menu_title="`Accounts`" :menus="[
                    {
                        route_name: `AllCategory`,
                        title: `Expendeture Groups`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Expendetures`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Incomes`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Expenses`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Journals`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Ledger`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_product_management.png`"
                :icon="`fa fa-plus`" :menu_title="`Products`" :menus="[
                    {
                        route_name: `CreateProducts`,
                        title: `Create Product`,
                    },
                    {
                        route_name: `AllProducts`,
                        title: `Products`,
                    },
                    {
                        route_name: `AllCategories`,
                        title: `Category`,
                    },
                    {
                        route_name: `AllBrand`,
                        title: `Brand`,
                    },
                    {
                        route_name: `AllManufactures`,
                        title: `Manufacture`,
                    },
                    {
                        route_name: `AllVarients`,
                        title: `Varient`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_sales.png`"
                :icon="`fa fa-plus`" :menu_title="`Sales`" :menus="[
                    {
                        route_name: `AllCategory`,
                        title: `Orders`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Quotations`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Payments`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Refunds`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_ecommerce.png`"
                :icon="`fa fa-plus`" :menu_title="`e-Commerce`" :menus="[
                    {
                        route_name: `AllEcommerceOrders`,
                        title: `Orders`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Customers`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Customer Wishlist`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Banner`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Blog`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Contact Us`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Subscribers`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Terms and Condition`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Return Policy`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Shipping and Delivery`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Integrations`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `General SEO`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `FAQ`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Breaking News`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Promo Codes`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Offers`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Featured Products`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Featured Categories`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Hide Products`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Hide Categories`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_inventory.png`"
                :icon="`fa fa-plus`" :menu_title="`Inventory`" :menus="[
                    {
                        route_name: `AllCategory`,
                        title: `Wearhouse`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Stocks`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_supplier.png`"
                :icon="`fa fa-plus`" :menu_title="`Supplier`" :menus="[
                    {
                        route_name: `AllCategory`,
                        title: `Supplier Types`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Suppliers`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_retailer.png`"
                :icon="`fa fa-plus`" :menu_title="`Retailer`" :menus="[
                    {
                        route_name: `AllCategory`,
                        title: `Retailer Types`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Retailers`,
                    },
                ]" />


            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_purchase.png`"
                :icon="`fa fa-plus`" :menu_title="`Purchase`" :menus="[
                    {
                        route_name: `AllCategory`,
                        title: `Purchase Orders`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Purchase Payments`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `Refunds`,
                    },
                ]" />

            <side-bar-single-menu
                :menu_title="`Reports`"
                :route_name="`ReportList`"
                :icon_image="`https://files.etek.com.bd/images/icon_report.png`"
            />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_settings.png`"
                :icon="`fa fa-plus`" :menu_title="`Configuration`" :menus="[
                    {
                        route_name: `EmailConfig`,
                        title: `Email`,
                    },
                    {
                        route_name: `SmsConfig`,
                        title: `SMS`,
                    },
                    {
                        route_name: `PaymentGatewayConfig`,
                        title: `Payment Gateway`,
                    },
                    {
                        route_name: `TelegramConfig`,
                        title: `Telegram`,
                    },
                    {
                        route_name: `TwilioConfig`,
                        title: `Twilio`,
                    },
                ]" />



        </ul>
    </div>
</template>

<script>
import { mapActions } from 'pinia'
import { auth_store } from '../../../../store/auth_store';
import SideBarDropDownMenus from './SideBarDropDownMenus.vue';
import SideBarSingleMenu from './SideBarSingleMenu.vue';
export default {
    components: { SideBarDropDownMenus, SideBarSingleMenu },
    mounted: function(){
        $("#menu").metisMenu();
    },
    methods: {
        ...mapActions(auth_store, ['log_out']),
        logout_submit: function () {
            let confirm = window.confirm('logout');
            if (confirm) {
                this.log_out();
            }
        }
    }
}
</script>

<style></style>
