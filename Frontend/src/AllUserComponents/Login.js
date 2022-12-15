import axios from "axios";
import { useEffect, useState, useSyncExternalStore } from "react";
import { Navigate } from "react-router-dom";
import axiosConfig from  './axiosConfig';
import Top from "./Top";

function Login(){
    const [email,setEmail] = useState("");
    const [password,setPassword] = useState("");
    const [errs,setErrs] = useState("");
    const handleLogin=(event)=>{
        event.preventDefault();
        const data={u_email:email,u_pass:password};
        // debugger;
        axiosConfig.post("login",data).
        then((succ)=>{
            debugger
            var token=succ.data.token;
            localStorage.setItem("_authToken",token);
            debugger;
            axiosConfig.get(`user/get/${email}`)
            .then((rsp)=>{
                //debugger;
                if(rsp.data.u_type==="COURIER"){
                    window.location.href="/courier/home";
                }
                else if (rsp.data.u_type=="CUSTOMER"){
                    window.location.href="/customer/home";
                }
                else if (rsp.data.u_type=="MANAGER"){
                    window.location.href="/manager/home";
                }
            },(error)=>{
                setErrs(error.response.data);
                console.log(error);

                debugger;
            }
            )
        },(erros)=>{
            setErrs(erros.response.data);
            console.log(errs);
            debugger;
        })
        
    }
    return(
        <div>
        <h2><Top/></h2>
        <center>
                <br/>
            <fieldset style={{width:"50%"}}>
                <br/>
                <center>
                <form onSubmit={handleLogin}>
                    Email: <input onChange={(e)=>{setEmail(e.target.value)}} size={30} type="email" name="email" value={email}/> <br/>
                    <span>{errs.u_email? errs.u_email[0]:''}</span><br/>
                    Password: <input onChange={(e)=>{setPassword(e.target.value)}} type="password" name="password" value={password}/> <br/>
                    <span>{errs.u_pass? errs.u_pass[0]:''}</span><br/>
                    <input type="submit" value="Login"/>
                </form>
                </center>           
            </fieldset>
            {errs.msg}
            <br/><br/>
        <a href="/forgotpassword">FORGOT PASSWORD ?</a>
        </center>
        </div>
    )
}

export default Login;