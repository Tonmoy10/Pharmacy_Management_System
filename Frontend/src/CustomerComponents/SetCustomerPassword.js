import { useState } from "react";
import axiosConfig from "./../AllUserComponents/axiosConfig";
import { useParams } from "react-router-dom";
import Logout from "../AllUserComponents/Logout";
import CustomerTopBar from "./CustomerTopBar";

const SetCustomerPassword=()=>{
    const [errs,setErrs] = useState("");
    const [password,setPassword] = useState("");
    const [confirmpassword,setConfirmPassword] = useState("");
    const {email} = useParams();

    const changePass=(event)=>{
        event.preventDefault();
        const data={email:email,password:password,confirmpassword:confirmpassword};
        axiosConfig.post("/change/password",data).then
        ((rsp)=>{
            debugger;
            window.location.href="/customer/home";
        },(errs)=>{
            setErrs(errs.response.data);
            debugger;
        })
    }
    return(
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
            <center>
            <br/><br/><br/><br/>
            <fieldset style={{width:"30%"}}>
            <form onSubmit={changePass}>
                <br/>
                Email: <input type="email" size={30} name="email" value={email} readOnly/> <br/><br/>
                Password: <input onChange={(e)=>{setPassword(e.target.value)}} type="password" name="password" value={password}/> <br/>
                <span>{errs.password? errs.password[0]:''}</span><br/>
                Confirm Password: <input onChange={(e)=>{setConfirmPassword(e.target.value)}} type="password" name="confirmpassword" value={confirmpassword}/> <br/>
                <span>{errs.confirmpassword? errs.confirmpassword[0]:''}</span><br/>
                <input type="submit" value="CHANGE PASSWORD"/>
            </form>                 
            </fieldset>
            {errs.msg}
            </center>
        </div>
    )
}

export default SetCustomerPassword;