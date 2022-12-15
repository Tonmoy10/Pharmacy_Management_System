import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import { useParams } from 'react-router-dom'

const ShowContract=()=>{
    const [val,getVal]=useState([])
    const [cont_Id,setId]=useState('')
    const [flg,setFlag]=useState(false)
    const [detail,setDet]=useState([])
    const [error,setError]=useState('')
    const {id} = useParams();

    useEffect(()=>{
        if (id=="all")
        {
            axiosConfig.get("manager/contract")
            .then((res) =>{
                debugger
                getVal(res.data)
            },
            (err) =>{
                debugger
                console.log(err)
            })
        }
        else
        {
            axiosConfig.post(`manager/contract/detail/${id}`)
            .then((res) =>{
                debugger
                getVal(res.data)
            },
            (err) =>{
                debugger
                console.log(err)
                setError(err.response.data);

            })
        }

    },[])

    const deleteContract=(event)=>{
        event.preventDefault();
        const data={c_id:cont_Id};
        debugger;
        axiosConfig.post("manager/deleteContract",data).then(
            (succ)=>{
                debugger;
                window.location.href="/manager/contract/all";

            },(err)=>{
                debugger;
                console.log(err);
            }
        )}

    const details=(event)=>{
        event.preventDefault();
        const data={c_id:cont_Id}
        debugger
        axiosConfig.post(`manager/contract/detail/${cont_Id}`,data)
        .then((suc)=>{
            debugger
            setDet(suc.data[0])
            //setDet(suc.data)
            // window.location.href="/manager/medicine"
        },(er)=>{
            debugger
            console.log(er)
        })
    }
    return(
        <div>
            <ManagerHome/>
            <h3>Contract List</h3>
            {error.msg 
            ? <h3>{error.msg}</h3>
            : <div>
                <table border="1">
                    <tr>
                        <th>Contract Id</th>
                        <th>Vendor Id</th>
                        <th>Contract Status</th>
                        <th>Medicine Name</th>
                    </tr>
                        {
                            val.map((v) =>
                                <tr key={v.contract_id}>
                                    <td>{v.contract_id}</td>
                                    <td>{v.vendor_id}</td>
                                    <td>{v.contract_status}</td>
                                    <td>{v.med_name}</td>
                                    <td>{v.price_perUnit}</td>
                                    <td>
                                        {
                                        <form onSubmit={details}>
                                            <input type="submit" onClick={(e)=>{setId(v.contract_id);setFlag(true)}} name="details" value="Details"/>
                                        </form>
                                        }
                                    </td>
                                        {
                                            v.contract_status=="Pending" 
                                            ?<td>
                                                {
                                                    <form onSubmit={deleteContract}>
                                                        <input type="submit" onClick={(e)=>{setId(v.contract_id)}} 
                                                        name="delete" value="Cancel"/>
                                                    </form>
                                                }
                                            </td>
                                            :<td></td>
                                        }
                                </tr>
                            )
                        }
                </table>
            </div>
            }
            <br/><br/>
            <div>
            {
                flg
                ?   <div>
                        <fieldset style={{width:"15%"}}>
                            <b><center><u>Contract Details</u></center></b>
                            <b>Contract ID : {cont_Id} </b><br/>
                            <b>Vendor ID : {detail.vendor_id} </b><br/>
                            <b>Quantity : {detail.quantity} </b><br/>
                            <b>Total Price : {detail.total_price} </b><br/>
                            <b>Accepted Time : {detail.accepted_time} </b><br/>
                            <b>Delivery Time : {detail.delivery_time} </b><br/>
                            <b>Contract Status : {detail.contract_status} </b><br/>
                        </fieldset>
                    </div>
                : ""
            }  
            </div>
        </div>
    )
}
export default ShowContract;