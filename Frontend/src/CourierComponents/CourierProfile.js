import LoggedCourierTop from "./LoggedCourierTop";
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";
import "../index.css"

const CourierProfile=()=>{
    const [user,setUser]=useState([]);
    useEffect(()=>{
        axiosConfig.post("courier/profile").then((rsp)=>{
        setUser(rsp.data);
        debugger;
        },(err)=>{})
    },[]);
    return(
    <div>
        <br/>
        <h3><LoggedCourierTop/></h3>
            <div>
                {/* <button onClick={(e)=>{window.location.href=`/set/password/customer/${user.customer_email}`;}}>CHANGE PASSWORD</button> */}

                <center>
                    <div>
                    <fieldset style={{width:"50%"}}>
                        <legend style={{textAlign:"center"}}><b>PROFILE INFORMATION</b></legend>
                        <img width="200" height="250" src={`http://localhost:8000/storage/profilepictures/courier/${user.u_id}.jpg`}/> 
                        <br/><br/>
                        <h4>
                            User ID : {user.u_id} <br/>
                            Courier ID : {user.courier_id} <br/>
                            Email : {user.courier_email} <br/>
                            Name : {user.courier_name}<br/><br/>
                        </h4>
                    </fieldset>
                    </div>
                    <br/>
                    <button onClick={(e)=>{window.location.href="/courier/profile/modify"}}>Update Information</button>
                </center>    
            </div>
            <br/>
    </div>
    )
}

export default CourierProfile;