import { useEffect, useState } from "react";
import Logout from "../AllUserComponents/Logout"
import axiosConfig from "./../AllUserComponents/axiosConfig"
import CustomerTopBar from "./CustomerTopBar"

const CustomerProfileUpdate=()=>{
    const [user,setUser] =useState([]);
    const [name,setName] =useState("");
    const [errs,setErrs] = useState({});
    const [flag,setFlag] = useState(false);
    const [profilepic,setProfilePic] =useState("");
    useEffect(()=>{
        axiosConfig.post("customer/account").then
        ((rsp)=>{
            setUser(rsp.data);
            setName(rsp.data.customer_name);
            debugger;
        },(err)=>{

        })
    },[])

    const updateInfo=(event)=>{
        debugger
        event.preventDefault();
        if (flag) {
            var data = new FormData();
            data.append("profilepic",profilepic,profilepic.name);
            data.append("name",name);
            debugger
        } else {
            var data ={name:name};
            debugger
        }
        

        axiosConfig.post("customer/modify/account",data).
        then((succ)=>{
            console.log(succ);
            debugger;
            window.location.href="/customer/profile";
        },(err)=>{
            setErrs(err.response.data);
            console.log(err);

        })
    }
    return(
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
                <div>
                    <center>
                    <form onSubmit={updateInfo}>
                        <div>
                        <fieldset style={{width:"50%"}}>
                            <legend style={{textAlign:"center"}}><b>PROFILE INFORMATION</b></legend>
                            <img width="200" height="250" src={`http://localhost:8000/storage/profilepictures/${user.u_id}.jpg`}/> 
                            <br/><br/>
                            <h4>
                                USER ID : <input type="text" name="u_id" value={user.u_id} readOnly/> <br/> <br/>
                                Customer ID : <input type="text" name="c_id" value={user.customer_id} readOnly/> <br/> <br/>
                                Email : <input type="text" name="email" size={30} value={user.customer_email} readOnly/> <br/><br/>
                                Name : <input type="text" name="name" onChange={(e)=>{setName(e.target.value)}} value={name} /><br/>
                                <span>{errs.name? errs.name[0]:''}</span><br/>
                                Choose Image : <input type="file" onChange={(e)=>{setProfilePic(e.target.files[0]);setFlag(true);debugger}} name="profilepic"></input><br/>
                                <span>{errs.profilepic? errs.profilepic[0]:''}</span><br/>

                            </h4> 
                        </fieldset>
                        </div>
                        <br/>
                        <input type="submit" value="Update Information"></input>
                        </form>
                    </center>    
                </div>
                <br/>
        </div>
    )
}
export default CustomerProfileUpdate