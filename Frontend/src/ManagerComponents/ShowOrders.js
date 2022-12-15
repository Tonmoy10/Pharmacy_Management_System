import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import { useParams } from 'react-router-dom'

const ShowOrders=()=>{
    const [val,getVal]=useState([])
    const [orderId,setId]=useState('')
    const [flg,setFlag]=useState(false)
    const [detail,setDet]=useState([])
    const [error,setError]=useState('')
    const {id} = useParams();

    useEffect(()=>{
        if (id=="all")
        {
            axiosConfig.get("manager/orders")
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
            axiosConfig.post(`manager/orders/detail/${id}`)
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

    const details=(event)=>{
        event.preventDefault();
        const data={o_id:orderId}
        debugger
        axiosConfig.post(`manager/orders/detail/${orderId}`,data)
        .then((suc)=>{
            debugger
            setDet(suc.data[0])
           // window.location.href="/manager/medicine"
        },(er)=>{
            debugger
            console.log(er)
        })
    }
    return(
        <div>
            <ManagerHome/>
            <h3>Order List</h3>
            {error.msg 
            ? <h3>{error.msg}</h3>
            : <div>
            <table border="1">
                <tr>
                    <th>Order Id</th>
                    <th>Customer Id</th>
                    <th>Total Price</th>
                    <th>Order Status</th>
                </tr>
                    {
                        val.map((v) =>
                            <tr key={v.order_id}>
                                <td>{v.order_id}</td>
                                <td>{v.customer_id}</td>
                                <td>{v.totalbill}</td>
                                <td>{v.order_status}</td>
                                <td>
                                    {
                                    <form onSubmit={details}>
                                        <input type="submit" onClick={(e)=>{setId(v.order_id);setFlag(true)}} name="details" value="Details"/>
                                    </form>
                                    }
                                </td>
                            </tr>
                        )
                    }
            </table>
            </div>
            }
            <div>
            {
                flg
                ?   <div>
                        <fieldset style={{width:"15%"}}>
                            <b><center><u>Order Details</u></center></b>
                            <b>Order ID : {orderId} </b><br/>
                            <b>Customer ID : {detail.customer_id} </b><br/>
                            <b>Total Price : {detail.totalbill} </b><br/>
                            <b>Order Status : {detail.order_status} </b><br/>
                            <b>Accepted Time : {detail.accepted_time} </b><br/>
                            <b>Delivery Time : {detail.delivery_time} </b><br/>
                        </fieldset>
                    </div>
                : ""
            }  
            </div>
        </div>
    )
}
export default ShowOrders;