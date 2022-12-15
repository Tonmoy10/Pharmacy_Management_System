import LoggedCourierTop from "./LoggedCourierTop";
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";
import "../index.css"

const CourierProfileUpdate=()=>{
    const [name,setName] = useState("");
    const [password,setPassword]=useState("");
    const [user,setUser] =useState([]);
    const [profilepic,setProfilePic] =useState("");
    const [flag,setFlag] = useState(false);
    const [errs,setErrs] = useState({});

    useEffect(()=>{
        axiosConfig.post("courier/profile").then
        ((rsp)=>{
            setUser(rsp.data);
            setName(rsp.data.courier_name);
            debugger;
        },(err)=>{

        })
    },[])

    const updateInfo=(event)=>{
        event.preventDefault();
        if (flag) {
            var data = new FormData();
            data.append("profilepic",profilepic,profilepic.name);
            data.append("name",name);
            data.append("password",password);
            debugger
        } else {
            var data ={name:name,password:password};
            debugger
        }
        //const data={name:name,password:password};

        axiosConfig.post("courier/modify/profile",data).
        then((rsp)=>{
            console.log(rsp);
            window.location.href="/courier/profile"
        },(err)=>{
            debugger
            setErrs(err.response.data);
        })
    }
    return(
        <div>
            <h3><LoggedCourierTop/></h3>
            <center>
            <form onSubmit={updateInfo}>
                <fieldset style={{width:"50%"}}>
                <legend style={{textAlign:"center"}}><b>PROFILE INFORMATION</b></legend>
                        <center>
                        USER ID : <input type="text" name="u_id" value={user.u_id} readOnly/> <br/> <br/>
                        Courier ID : <input type="text" name="c_id" value={user.courier_id} readOnly/> <br/> <br/>
                        Email : <input type="text" name="email" size={30} value={user.courier_email} readOnly/> <br/><br/>
                        Name: <input type="text" onChange={(e)=>{setName(e.target.value)}} name="name" value={name}/><br/><br/>
                        Password: <input type="text" onChange={(e)=>{setPassword(e.target.value)}} name="password" value={password}/><br/><br/>
                        <span>{errs.name? errs.name[0]:''}</span>
                        <br/>
                        Choose Image : <input type="file" onChange={(e)=>{setProfilePic(e.target.files[0]);setFlag(true);debugger}} name="profilepic"></input><br/>
                        <span>
                            {errs.profilepic? errs.profilepic[0]:''}
                        </span>
                        <br/>
                        </center>
                </fieldset>
                <br/>
            <input type="submit" name="submit" value="Update Information"/>
            </form>
            
            </center>

        </div>
    )
}

export default CourierProfileUpdate;