import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import SearchBar from "./../ManagerComponents/SearchBar"
import Logout from "./../AllUserComponents/Logout"


const ManagerHome=()=>{
    const [val,getVal]=useState([])
    useEffect(()=>{
        axiosConfig.post("manager/propic")
        .then
        ((suc)=>{
            getVal(suc.data)
        },
        (err)=>{
            console.log(err)
        }
        )
    },[])
    return(
        <div>
            <Logout/>
            <button onClick={(e=>{window.location.href="/manager/profile";})}>View Profile</button>
            <button onClick={(e=>{window.location.href="/manager/Home";})}>Home</button>
            <center>
            <fieldset style={{width:"50%"}}>
                <center>
                    <button onClick={(e=>{window.location.href="/manager/user/all";})}>View User</button>
                    <button onClick={(e=>{window.location.href="/manager/medicine/all";})}>View Medicine</button>
                    <button onClick={(e=>{window.location.href="/manager/orders/all";})}>View Orders</button>
                    <button onClick={(e=>{window.location.href="/manager/contract/all";})}>View Contract</button>
                    <button onClick={(e=>{window.location.href="/manager/supply/all";})}>View Supply</button>
                    <button onClick={(e=>{window.location.href="/manager/query";})}>View Query</button>
                    <button onClick={(e=>{window.location.href="/manager/account";})}>View Account</button>
                    <button onClick={(e=>{window.location.href="/manager/cart";})}>Go to Cart</button>
                </center>           
            </fieldset>
            <SearchBar/>
            </center>
            <img width="275" height="250" src={`http://localhost:8000/storage/propics/${val.u_id}.jpg`} /><br/>
            <button onClick={(e=>{window.location.href="/manager/change";})}>Change Password</button>
            <button onClick={(e=>{window.location.href="/manager/upload";})}>Change Profile Picture</button>
        </div>
    )
}
export default ManagerHome