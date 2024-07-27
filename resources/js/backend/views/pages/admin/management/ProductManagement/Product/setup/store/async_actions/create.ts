import axios from "axios";
import setup from "../..";

async function execute(event){
    let form = event.target;
    let form_data = new FormData(form);

    let category_group = form.querySelector('[name="product_category_group_id"]');
    let is_nav = form.querySelector('[name="is_nav"]');
    let is_featured = form.querySelector('[name="is_featured"]');
    let serial = form.querySelector('[name="serial"]');

    form_data.delete('product_category_group_id');
    form_data.delete('is_nav');
    form_data.delete('is_featured');
    form_data.delete('serial');

    category_group = JSON.parse(category_group.value);
    if(category_group.length){
        form_data.append('product_category_group_id', category_group[0]);
    }else{
        form_data.append('product_category_group_id', "");
    }

    if(is_nav.checked){
        form_data.append('is_nav', "1");
    }else{
        form_data.append('is_nav', "0");
    }

    if(is_featured.checked){
        form_data.append('is_featured', "1");
    }else{
        form_data.append('is_featured', "0");
    }

    if(serial.vlaue){
        form_data.append('serial', serial.vlaue);
    }else{
        form_data.append('serial', '');
    }

    let url = `${setup.api_host}/${setup.api_version}/${setup.api_end_point}/store`;

    try {
        let response = await axios.post(url, form_data);
        return response;
    } catch (error) {
        if(error.response.status == 422){
            (window as any).s_alert('Fill the required input fields.','error');
        }
        return error.response;
    }
}

export default execute;
