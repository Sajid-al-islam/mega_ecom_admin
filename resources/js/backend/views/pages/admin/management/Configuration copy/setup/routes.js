import setup from ".";
import All from "../All.vue";
import Form from "../Form.vue";
import Layout from "./Layout.vue";

import Email from "../Email.vue";
import Sms from "../Sms.vue";
import PaymentGateway from "../PaymentGateway.vue";
import Telegram from "../Telegram.vue";
import Twilio from "../Twilio.vue";

let route_prefix_name  = setup.route_prefix_name;
let route_prefix  = setup.route_prefix;

const routes =
{
    path: route_prefix,
    component: Layout,
    children: [
        {
            path: '',
            name: "All" + route_prefix_name,
            component: All,
        },
        {
            path: "create",
            name: "Create" + route_prefix_name,
            component: Form,
        },
        {
            path: "email",
            name: "EmailConfig",
            component: Email,
        },
        {
            path: "sms",
            name: "SmsConfig",
            component: Sms,
        },
        {
            path: "payment-gateway",
            name: "PaymentGatewayConfig",
            component: PaymentGateway,
        },
        {
            path: "telegram-config",
            name: "TelegramConfig",
            component: Telegram,
        },
        {
            path: "twilio-config",
            name: "TwilioConfig",
            component: Twilio,
        },

    ]
};


export default routes;
