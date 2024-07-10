import setup from ".";
import All from "../All.vue";
import Form from "../Form.vue";
import ReportList from "../ReportList.vue";
import Layout from "./Layout.vue";

let route_prefix_name  = setup.route_prefix_name;
let route_prefix  = setup.route_prefix;

const routes =
{
    path: route_prefix,
    component: Layout,
    children: [
        {
            path: '',
            name: "ReportList",
            component: ReportList,
        },
        {
            path: "create",
            name: "Create" + route_prefix_name,
            component: Form,
        },

    ]
};


export default routes;
