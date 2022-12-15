import React,{useState,useEffect} from 'react'
import { useParams } from 'react-router-dom'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"

const ShowMed=()=>{
    const [val,getVal]=useState([])
    const [medId,setId]=useState('')
    const [error,setError]=useState('')
    const [flg,setFlag]=useState(false)
    const [detail,setDet]=useState([])
    const {id} = useParams();


    useEffect(()=>{
        if (id=="all")
        {
            axiosConfig.get("manager/medicine")
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
            axiosConfig.post(`manager/med/detail/${id}`)
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

    const deleteMed=(event)=>{
        event.preventDefault();
        const data={m_id:medId};
        debugger;
        axiosConfig.post("manager/deleteMed",data).then(
            (succ)=>{
                debugger;
                window.location.href="/manager/medicine/all";

            },(err)=>{
                debugger;
                console.log(err);
            }
        )}

    const details=(event)=>{
        event.preventDefault();
        const data={m_id:medId}
        debugger
        axiosConfig.post(`manager/med/detail/${medId}`,data)
        .then((suc)=>{
            debugger
            setDet(suc.data[0])
            console.log(detail.med_name)
           // window.location.href="/manager/medicine"
        },(er)=>{
            debugger
            console.log(er)
        })
    }
    return(
        <div>
            <ManagerHome/>
            <h3>Medicine List</h3>
            {error.msg 
            ? <h3>{error.msg}</h3>
            : <div>
                <table border="1">
                <tr>
                    <th>Medicine Id</th>
                    <th>Medicine Name</th>
                    <th>Price per Unit</th>
                    <th>Stock</th>
                    <th>Expiry Date</th>
                </tr>
                    {
                        val.map((v) =>
                            <tr key={v.med_id}>
                                <td>{v.med_id}</td>
                                <td>{v.med_name}</td>
                                <td>{v.price_perUnit}</td>
                                    {
                                        v.Stock==0 &&
                                        <td>Out of Stock</td>
                                    }
                                    {
                                        v.Stock!=0 &&
                                        <td>{v.Stock}</td>
                                    }
                                <td>{v.expiryDate}</td>
                                <td>
                                    {
                                    <form onSubmit={details}>
                                        <input type="submit" onClick={(e)=>{setId(v.med_id);setFlag(true)}} name="details" value="Details"/>
                                    </form>
                                    }
                                </td>
                                <td>
                                    {
                                    <form onSubmit={deleteMed}>
                                        <input type="submit" onClick={(e)=>{setId(v.med_id)}} name="delete" value="Delete"/>
                                    </form>
                                    }
                                </td>
                                
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
                        <b><center><u>Medicine Details</u></center></b>
                            <b>Medicine ID : {medId} </b><br/>
                            <b>Medicine Name : {detail.med_name} </b><br/>
                            <b>Unit Price : {detail.price_perUnit} </b><br/>
                            <b>Stock : {detail.Stock} </b><br/>
                            <b>Manufacturing Date : {detail.manufacturingDate} </b><br/>
                            <b>Expiry Date : {detail.expiryDate} </b><br/>
                            <b>Vendor ID : {detail.vendor_id} </b><br/>
                            <b>Vendor Name : {detail.vendor_name} </b><br/>
                            <b>Contract ID : {detail.contract_id} </b><br/>
                        </fieldset>
                    </div>
                : ""
            }  
            </div>
        </div>
        
    )
}
export default ShowMed;