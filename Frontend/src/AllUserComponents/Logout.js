import axiosConfig from './axiosConfig';
const Logout=()=>{
    const logout=()=>{
    axiosConfig.post("logout").then
    ((rsp)=>{
        debugger;
        window.location.href="/";
    },(error)=>{
        debugger
    })
    }
    return(
        <div>
            <button onClick={logout} value={"LOGOUT"}>LOGOUT</button>
        </div>
    )
}

export default Logout;