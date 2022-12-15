import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"

const ShowQuery=()=>{
    const [val,getVal]=useState([])
    const [Id,setId]=useState('')

    useEffect(()=>{
        axiosConfig.get("manager/query")
        .then((res) =>{
            debugger
            getVal(res.data)
        },
        (err) =>{
            debugger
            console.log(err)
        })

    },[])

    const declineQuery=(event)=>{
        event.preventDefault();
        const data={id:Id};
        debugger;
        axiosConfig.post("manager/declineQuery",data).then(
            (succ)=>{
                debugger;
                window.location.href="/manager/query";

            },(err)=>{
                debugger;
                console.log(err);
            }
        )}

        const acceptQuery=(event)=>{
            event.preventDefault();
            const data={id:Id};
            debugger;
            axiosConfig.post("manager/acceptQuery",data).then(
                (succ)=>{
                    debugger;
                    window.location.href="/manager/query";
    
                },(err)=>{
                    debugger;
                    console.log(err);
                }
            )}
    return(
        <div>
            <ManagerHome/>
            <h3>Contract List</h3>
            <table border="1">
                <tr>
                    <th>Order Id</th>
                    <th>Medicine Id</th>
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Return Status</th>
                </tr>
                    {
                        val.map((v) =>
                            <tr key={v.order_id}>
                                <td>{v.order_id}</td>
                                <td>{v.med_id}</td>
                                <td>{v.items}</td>
                                <td>{v.quantity}</td>
                                <td>{v.return_status}</td>
                                {
                                    v.return_status=="true"
                                    ?<td>
                                        {
                                        <form onSubmit={acceptQuery}>
                                            <input type="submit" onClick={(e)=>{setId(v.id)}} name="accept" value="Accept"/>
                                        </form>
                                        }
                                    </td>
                                    :<td></td>
                                }
                                {
                                    v.return_status=="true"
                                    ?<td>
                                        {
                                        <form onSubmit={declineQuery}>
                                            <input type="submit" onClick={(e)=>{setId(v.id)}} name="accept" value="Decline"/>
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
    )
}
export default ShowQuery;