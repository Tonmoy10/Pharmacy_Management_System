import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import Monthly from './Monthly'
import Yearly from './Yearly'

function ShowAccount(){
    const [val,getVal]=useState([])
    const [cat,setCat]=useState([])

    useEffect(()=>{
        axiosConfig.get("manager/account")
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
            <ManagerHome/>
            <h3>Account Details</h3>
            <table border="1">
                <tr>
                    <th>Serial</th>
                    <th>Date</th>
                    <th>Expense</th>
                    <th>Revenue</th>
                </tr>
                    {
                        val.map((v) =>
                            <tr key={v.serial}>
                                <td>{v.serial}</td>
                                <td>{v.date}</td>
                                <td>{v.expenses}</td>
                                <td>{v.revenue}</td>
                            </tr>
                        )
                    }
            </table>
            <select name="search" placeholder="Search in table" onChange={(e)=>{setCat(e.target.value)}}>
                <option value="select">Select</option>
                <option value="monthly">Monthly Record</option>
                <option value="yearly">Yearly Record</option>
            </select>
            {
                cat=="monthly" &&
                <Monthly/>
            }
            {
                cat=="yearly" &&
                <Yearly/>
            }
        </div>
    )
}
export default ShowAccount;