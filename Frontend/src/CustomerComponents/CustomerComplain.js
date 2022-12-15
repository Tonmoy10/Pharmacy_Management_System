import {useState,useEffect} from 'react';
import axiosConfig from './../AllUserComponents/axiosConfig';
import CustomerTopBar from './CustomerTopBar';
import Logout from '../AllUserComponents/Logout';
const CustomerComplain=()=>{
    const[msg,setMsg] = useState("");
    const[msgs,setMsgs] = useState("");
    const [user,setUser] =useState([]);
    useEffect(()=>{
        axiosConfig.post("customer/account").then
        ((rsp)=>{
            setUser(rsp.data);
            debugger;
        },(err)=>{

        })
    },[])
    
    const sendComplain=(event)=>{
        event.preventDefault();
        const data={msg:msg,customer_id:user.customer_id}
        axiosConfig.post("customer/complain",data).then
        ((rsp)=>{
            debugger;
            setMsgs(rsp.data)
        },(err)=>{
            debugger;
        })
    }

    return(
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
            <center>
            <fieldset style={{width:"50%"}}>
                <legend style={{textAlign:"center"}}><h3>File a complain</h3></legend>
                <form onSubmit={sendComplain}>
                    Name: <input type="text" name="name" value={user.customer_name} readonly/> <br/> <br/>
                    UserId: <input type="text" name="id" value={user.u_id} readonly/><br/><br/>
                    CustomerId: <input type="text" name="customer_id" value={user.customer_id} readonly/><br/><br/>
                    Email from: <input type="text" name="email" size={30} value={user.customer_email} readonly/> <br/><br/>
                    Write your message here: <br/>
                    <textarea name="msg" id="" cols="40" onChange={(e)=>{setMsg(e.target.value)}} rows="10" placeholder="SPECIFY ORDER-ID#" value={msg}></textarea><br/><br/>
                    <input type="submit" name="submit" value="SEND"/>
                </form>
            </fieldset>
            <br/>
            {msgs.msg}
            </center>
        </div>
    )
}
export default CustomerComplain;