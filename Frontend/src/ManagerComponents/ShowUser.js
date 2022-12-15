import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import { useParams } from 'react-router-dom'

function ShowUser(){
    const [val,getVal]=useState([])
    const [u_Id,setId]=useState('')
    const [flg,setFlag]=useState(false)
    const [detail,setDet]=useState([])
    const [error,setError]=useState('')
    const {id} = useParams();

    useEffect(()=>{
        if (id=="all")
        {
            axiosConfig.get("manager/user")
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
            axiosConfig.post(`manager/user/detail/${id}`)
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

    const deleteUser=(event)=>{
        event.preventDefault();
        const data={u_id:u_Id};
        debugger;
        axiosConfig.post("manager/deleteUser",data).then(
            (succ)=>{
                debugger;
                window.location.href="/manager/user/all";

            },(err)=>{
                debugger;
                console.log(err);
            }
        )}

    const details=(event)=>{
        event.preventDefault();
        const data={u_id:u_Id}
        debugger
        axiosConfig.post(`manager/user/detail/${u_Id}`,data)
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
            <h3>User List</h3>
            {error.msg 
            ? <h3>{error.msg}</h3>
            : <div>
                <table border="1">
                    <tr>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>User Type</th>
                    </tr>
                        {
                            val.map((v) =>
                                <tr key={v.u_id}>
                                    <td>{v.u_id}</td>
                                    <td>{v.u_name}</td>
                                    <td>{v.u_type}</td>
                                    <td>
                                        {
                                        <form onSubmit={details}>
                                            <input type="submit" onClick={(e)=>{setId(v.u_id);setFlag(true)}} name="details" value="Details"/>
                                        </form>
                                        }
                                    </td>
                                    <td>
                                        {
                                        <form onSubmit={deleteUser}>
                                            <input type="submit" onClick={(e)=>{setId(v.u_id)}} name="delete" value="Delete"/>
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
                            <b><center><u>User Details</u></center></b>
                            <b>User ID : {u_Id} </b><br/>
                            <b>User Name : {detail.u_name} </b><br/>
                            <b>Role : {detail.u_type} </b><br/>
                            <b>Email : {detail.u_email} </b><br/>
                        </fieldset>
                    </div>
                : ""
            }  
            </div>
        </div>
    )
}
export default ShowUser;