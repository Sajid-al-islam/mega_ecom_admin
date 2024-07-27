import setup from ".";
import All from "../All.vue";
import Form from "../Form.vue";
import Details from "../Details.vue";
import Layout from "../Layout.vue";
import CatList from "../CatList.vue";

let route_prefix = setup.route_prefix;

const routes =
{
    path: setup.route_path,
    component: Layout,
    children: [
        {
            path: '',
            name: "All" + route_prefix,
            component: All,
        },
        {
            path: 'all-tree',
            name: "AllCategories",
            component: CatList,
        },
        {
            path: "create",
            name: "Create" + route_prefix,
            component: Form,
        },
        {
            path: ":id",
            name: "Details" + route_prefix,
            component: Details,
        },
        {
            path: "edit/:id",
            name: "Edit" + route_prefix,
            component: Form,
        },

    ]
};


export default routes;
