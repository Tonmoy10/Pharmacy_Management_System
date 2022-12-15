import axios from "axios";
import { useState } from "react";
import axiosConfig from "./axiosConfig";
import Top from "./Top";

const Registration=()=>{

    const [name,setName] = useState("");
    const [password,setPassword] = useState("");
    const [confirmpassword,setConfirmPassword] = useState("");
    const [email,setEmail] = useState("");
    const [type,setType] = useState("");
    const [errs,setErrs] = useState({});
    const [succ,setSucc] = useState({});
    const handleRegistration=(event)=>{
        // debugger;
        event.preventDefault();
        const data={name:name,email:email,password:password,type:type,confirmpassword:confirmpassword};
        axiosConfig.post("user/create",data).
        then((succ)=>{
            setSucc(succ.data);
            debugger;
            window.location.href="/";
        },(err)=>{
            setErrs(err.response.data);
            console.log(data);
            debugger;
        }

        )
    }
    return(

        <div>
        <h2><Top/></h2>
        <center>
                <br/>
            <fieldset style={{width:"50%"}}>
                <br/>
                <center>
                    <div className="space-x-3">
                        <button onClick={()=>{setType("CUSTOMER")}} value={"CUSTOMER"}>Customer</button>
                        <button onClick={()=>{setType("VENDOR")}} value={"VENDOR"}>Vendor</button>
                        <button onClick={()=>{setType("MANAGER")}} value={"MANAGER"}>Manager</button>
                        <button onClick={()=>{setType("COURIER")}} value={"COURIER"}>Courier</button>   
                    </div>
                    <form onSubmit={handleRegistration}>     
                        <br/>
                        Register As : <input onChange={(e)=>{setType(e.target.value)}} type="text" name="type" value={type} readOnly/> <br/>
                        <span>{errs.type? errs.type[0]:''}</span><br/>
                        Name: <input onChange={(e)=>{setName(e.target.value)}} type="text" name="name" value={name}/> <br/>
                        <span>{errs.name? errs.name[0]:''}</span><br/>
                        Email: <input onChange={(e)=>{setEmail(e.target.value)}} size={30} type="email" name="email" value={email}/> <br/>
                        <span>{errs.email? errs.email[0]:''}</span><br/>
                        Password: <input onChange={(e)=>{setPassword(e.target.value)}} type="password" name="password" value={password}/> <br/>
                        <span>{errs.password? errs.password[0]:''}</span><br/>
                        Confirm Password: <input onChange={(e)=>{setConfirmPassword(e.target.value)}} type="password" name="confirmpassword" value={confirmpassword}/> <br/>
                        <span>{errs.confirmpassword? errs.confirmpassword[0]:''}</span><br/>
                        <input type="submit" value="Register"/>
                    </form>
                    {succ.msg}
                </center>           
            </fieldset>
        </center>
        </div>

    )
}

export default Registration;    