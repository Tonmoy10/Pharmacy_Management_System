import TopBar from '../AllUserComponents/TopBar';
import logout from "../AllUserComponents/Logout";
import {Link} from 'react-router-dom';
import Logout from '../AllUserComponents/Logout';
import axiosConfig from "./../AllUserComponents/axiosConfig"

const LoggedCourierTop=()=>{
    const logout=()=>{
        axiosConfig.post("logout").then
        ((rsp)=>{
            debugger;
            window.location.href="/";
        },(error)=>{
    
        })
        }
    return(
        <div>
            <ul>
                <div>
                <li><TopBar url="/courier/home" value="Home "/></li>
                <li><TopBar url="/courier/AcceptedOrders" value="Accepted Orders"/></li>
                <li><TopBar url="/courier/ViewOrders" value="Orders"/></li>
                <li><TopBar url="/courier/cashout" value="Cash Out"/></li>
                </div>
                <div>
                <li><TopBar url="/courier/Profile" value="Profile"/></li>
                <li><button onClick={logout} value={"LOGOUT"} className="button button1 ">LOGOUT</button></li>
                </div>
            </ul>
        </div>
    )
}

export default LoggedCourierTop;