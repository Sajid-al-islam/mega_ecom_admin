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
                        <img src="https://files.etek.com.bd/images/icon_dashboard.png" alt="">
                    </div>
                    <div class="menu-title">Dashboard</div>
                </router-link>
            </li>

            <side-bar-drop-down-menus :icon="`fa fa-plus`"
                :icon_image="`https://files.etek.com.bd/images/icon_user.png`" :menu_title="`User Management`" :menus="[
                    {
                        route_name: `AllUser`,
                        title: `Users`,
                    },
                    {
                        route_name: `AllCustomer`,
                        title: `Customers`,
                    },
                    {
                        route_name: `AllSupplier`,
                        title: `Suppliers`,
                    },
                    {
                        route_name: `AllRetailer`,
                        title: `Retailers`,
                    },
                    {
                        route_name: `AllEmployer`,
                        title: `Employees`,
                    },

                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_accounting.png`"
                :icon="`fa fa-plus`" :menu_title="`Accounts`" :menus="[
                    {
                        route_name: `AllExpenditure_groups`,
                        title: `Expendeture Groups`,
                    },
                    {
                        route_name: `AllExpenditures`,
                        title: `Expendetures`,
                    },
                    {
                        route_name: `AllAccount-heads`,
                        title: `Account Heads`,
                    },
                    {
                        route_name: `AllAccounts`,
                        title: `Account`,
                    },
                    {
                        route_name: `AllAccount-numbers`,
                        title: `Account Numbers`,
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
                    {
                        route_name: `AllVat-groups`,
                        title: `Vat Groups`,
                    },
                    {
                        route_name: `AllVats`,
                        title: `Vat's`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_product_management.png`"
                :icon="`fa fa-plus`" :menu_title="`Products`" :menus="[
                    {
                        route_name: `CreateProduct`,
                        title: `Create Product`,
                    },
                    {
                        route_name: `AllProduct`,
                        title: `Products`,
                    },
                    {
                        route_name: `BarcodeGenerator`,
                        title: `Barcode Generate`,
                    },
                    {
                        route_name: `AllCategoryGroup`,
                        title: `Category Group`,
                    },
                    {
                        route_name: `AllCategory`,
                        title: `Category`,
                    },
                    {
                        route_name: `AllBrand`,
                        title: `Brand`,
                    },
                    {
                        route_name: `AllManufacture`,
                        title: `Manufacture`,
                    },
                    {
                        route_name: `AllVariantGroup`,
                        title: `Varient Groups`,
                    },
                    {
                        route_name: `AllVariant`,
                        title: `Varient`,
                    },
                    {
                        route_name: `AllVariantValue`,
                        title: `Varient Values`,
                    },
                    {
                        route_name: `AllUnitGroup`,
                        title: `Unit Group`,
                    },
                    {
                        route_name: `AllUnit`,
                        title: `Units`,
                    },
                    {
                        route_name: `AllProductTag`,
                        title: `Product Tags`,
                    },
                    {
                        route_name: `AllProductCategoryTag`,
                        title: `Product Category Tags`,
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
                        route_name: `AllWear-house-branches`,
                        title: `Wearhouse Braches`,
                    },
                    {
                        route_name: `AllWear-houses`,
                        title: `Wearhouse`,
                    },
                    {
                        route_name: `AllStocks`,
                        title: `Stocks`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_supplier.png`"
                :icon="`fa fa-plus`" :menu_title="`Supplier`" :menus="[
                    {
                        route_name: `AllSupplier_type`,
                        title: `Supplier Types`,
                    },
                    {
                        route_name: `AllSupplier`,
                        title: `Suppliers`,
                    },
                ]" />

            <side-bar-drop-down-menus :icon_image="`https://files.etek.com.bd/images/icon_retailer.png`"
                :icon="`fa fa-plus`" :menu_title="`Retailer`" :menus="[
                    {
                        route_name: `AllRetailer_type`,
                        title: `Retailer Types`,
                    },
                    {
                        route_name: `AllRetailer`,
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
                        route_name: `AllEmail-configuration`,
                        title: `Email`,
                    },
                    {
                        route_name: `AllSMS-configuration`,
                        title: `SMS`,
                    },
                    {
                        route_name: `AllWebsite-configuration`,
                        title: `Website`,
                    },
                    // {
                    //     route_name: `PaymentGatewayConfig`,
                    //     title: `Payment Gateway`,
                    // },
                    // {
                    //     route_name: `TelegramConfig`,
                    //     title: `Telegram`,
                    // },
                    // {
                    //     route_name: `TwilioConfig`,
                    //     title: `Twilio`,
                    // },
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
