import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import ViewCart from "./../ManagerComponents/ViewCart"

const finalCart=()=>{
    const [val,getVal]=useState([])

    useEffect(()=>{
        axiosConfig.post("manager/medicine")
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
            <ViewCart/>
            Total = Tk.{val}
            <form onSubmit={handleQuantity}>
                <input type="submit" name="cart" value="Confirm Order"/>
            </form>
        </div>
    )
}
export default finalCart;