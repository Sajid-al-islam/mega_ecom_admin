import axios from "axios";
import setup from "../..";

async function execute(){
    let url = `${setup.api_host}/${setup.api_version}/${setup.api_end_point}/get-all`;

    try {
        let response = await axios.get(url);
        return response;
    } catch (error) {
        if(error.response.status == 422){
            (window as any).s_alert('Fill the required input fields.','error');
        }
        return error.response;
    }
}

export default execute;
