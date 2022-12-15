import LoggedCourierTop from "./LoggedCourierTop";
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";
import "../index.css"

const LoggedCourierHome=()=>{
    const [user,setUser]=useState([]);
    useEffect(()=>{
        axiosConfig.get("courier/orders").then((rsp)=>{
        setUser(rsp.data);
        debugger;
        },(err)=>{})
    },[]);
    return(
        <div className="">
            <h2>
            <LoggedCourierTop/>
            </h2>
            <h1 className="text-4xl text-center">hello</h1>
        </div>
    )
}

export default LoggedCourierHome;