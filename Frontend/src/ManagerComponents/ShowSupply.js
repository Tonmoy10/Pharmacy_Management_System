import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import { useParams } from 'react-router-dom'

const ShowSupply=()=>{
    const [val,getVal]=useState([])
    const [supplyId,setId]=useState('')
    const [flg,setFlag]=useState(false)
    const [detail,setDet]=useState([])
    const [error,setError]=useState('')
    const {id} = useParams();

    useEffect(()=>{
        if (id=="all")
        {
            axiosConfig.get("manager/supply")
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
            axiosConfig.post(`manager/supply/detail/${id}`)
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
        const data={s_id:supplyId}
        debugger
        axiosConfig.post(`manager/supply/detail/${supplyId}`,data)
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
            <h3>Supply List</h3>
            {error.msg 
            ? <h3>{error.msg}</h3>
            : <div>
            <table border="1">
                <tr>
                    <th>Vendor Id</th>
                    <th>Medicine Id</th>
                    <th>Medicine Name</th>
                    <th>Stock</th>
                    <th>Price per Unit</th>
                </tr>
                    {
                        val.map((v) =>
                            <tr key={v.supply_id}>
                                <td>{v.vendor_id}</td>
                                <td>{v.med_id}</td>
                                <td>{v.med_name}</td>
                                {
                                    v.stock==0 &&
                                    <td>Out of Stock</td>
                                }
                                {
                                    v.stock!=0 &&
                                    <td>{v.stock}</td>
                                }
                                <td>{v.price_perUnit}</td>
                                <td>
                                    {
                                    <form onSubmit={details}>
                                        <input type="submit" onClick={(e)=>{setId(v.supply_id);setFlag(true)}} name="details" value="Details"/>
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
                            <b><center><u>Supply Details</u></center></b>
                            <b>Vendor ID : {detail.vendor_id} </b><br/>
                            <b>Medicine ID : {detail.med_id} </b><br/>
                            <b>Unit Price : {detail.price_perUnit} </b><br/>
                            <b>Stock : {detail.stock} </b><br/>
                            <b>Manufacturing Date : {detail.manufacturingDate} </b><br/>
                            <b>Expiry Date : {detail.expiryDate} </b><br/>
                        </fieldset>
                    </div>
                : ""
            }  
            </div>
        </div>
    )
}
export default ShowSupply;