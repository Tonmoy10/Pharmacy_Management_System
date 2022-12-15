import { useEffect, useState } from "react";
import Logout from "../AllUserComponents/Logout";
import CustomerTopBar from "./CustomerTopBar";
import axiosConfig from "./../AllUserComponents/axiosConfig"

const CustomerReturn = () => {
    const [items,setItems] = useState([]);
    const [errs,setErrs] = useState({});
    const [id,setId] = useState();

    useEffect(()=>{
        axiosConfig.post("customer/item/return").then
        ((rsp)=>{
            setItems(rsp.data);
            debugger;
        },(err)=>{
            console.log("NO ORDERS HAS BEEN PLACED");
            setErrs(err.response.data);
            debugger;
        }
        )
    },[])

    const ret = (event) =>{
        event.preventDefault();
        debugger;
        axiosConfig.get(`customer/item/return/${id}`).then(
            (succ)=>{
                debugger;
                window.location.href="/customer/return";

            },(err)=>{
                debugger;

            }
        )

    }
    return(
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
            <span><br/><br/>{
            errs.msg
            ?   <h3>{errs.msg}</h3>
            :   <div>
                    {
                        items.map((item)=>
                        <div key={item.id}>
                            {
                                <div>
                                    <br/>
                                    <fieldset style={{width:"20%"}}>
                                        ORDER ID : {item.order_id} <br/>
                                        <fieldset>
                                            <table>
                                                <tr>
                                                    <td>ITEMS: </td>
                                                </tr>
                                                <tr>
                                                    <td>{item.items}</td>
                                                    <td>
                                                    {
                                                        item.return_status=='true'
                                                        ? "#PROCESSING"
                                                        : " "
                                                    }
                                                    {
                                                        item.return_status=='accepted'
                                                        ? "#ACCEPTED"
                                                        : " "
                                                    }
                                                    {
                                                        item.return_status=='false'
                                                        ? <div>
                                                            <form onSubmit={ret}>
                                                                <input type="submit" onClick={(e)=>{setId(item.id)}} value="RETURN"></input>
                                                            </form>
                                                        </div>
                                                            
                                                        : " "
                                                    }
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </fieldset>
                                    <br/>
                                </div>
                               
                            }
                        </div>
                        )
                    }
                  </div>
            }</span>
            <br/><br/>

        </div>
    )
}

export default CustomerReturn;