import React,{useState,useEffect} from 'react'
import { useParams } from 'react-router-dom'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import Logout from "./../AllUserComponents/Logout"

const Profile=()=>{
    const [val,getVal]=useState([])


    useEffect(()=>{
        axiosConfig.post("manager/profile/view")
        .then((res) =>{
            debugger
            getVal(res.data)
        },
        (err) =>{
            debugger
            console.log(err)
        })
    },[])

    return(
        <div>
            <Logout/><br/>
            <button onClick={(e=>{window.location.href="/manager/Home";})}>Home</button>
            <center>
                <br/><br/><br/><br/><br/><br/><br/><br/>
                <fieldset style={{width:"50%"}}>
                    <b><center><u>Profile Information</u></center></b><br/>
                    <b>User ID : {val.u_id} </b><br/><br/>
                    <b>Name : {val.u_name} </b><br/><br/>
                    <b>Role : {val.u_type} </b><br/><br/>
                    <b>Email : {val.u_email} </b><br/><br/>
                </fieldset>
            </center>
        </div>
        
    )
}
export default Profile;