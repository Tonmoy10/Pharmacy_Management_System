import axios from 'axios'
import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"

const ShowCart=()=>{
    const [val,getVal]=useState([])
    const [insert,getInsert]=useState([])
    const [quantity,setQuantity]=useState([])
    const [medId,setMedId]=useState('')
    const [supId,setSupId]=useState('')
    const [errs,setErrs] = useState("");


    useEffect(()=>{
        axiosConfig.get("manager/cart")
        .then((res) =>{
            debugger
            getVal(res.data)
        },
        (err) =>{
            debugger
            console.log(err)
        })

    },[])
    const handleQuantity=(event)=>{
        // debugger;
        event.preventDefault();
        const data={med_id:medId,supply_id:supId,quantity:parseInt(quantity)};
        debugger;
        axiosConfig.post("manager/addItem",data).
        then((resp)=>{
            getInsert(resp.data);
            debugger;
            window.location.href="/manager/cart";
        },(err)=>{
            setErrs(err.response.data);
            console.log(err);
            debugger;
        }

        )
    }
    const viewPage=(event)=>{
        event.preventDefault();
        window.location.href="/manager/cart/table"
    }
    return(
        <div>
            <ManagerHome/>
            <h3>Item List</h3>
            <table border="1">
                <tbody>
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
                                {
                                    v.stock!=0 &&
                                    <td>
                                        {
                                            <form onSubmit={handleQuantity}>
                                                <input type="number" name="quantity" min={0} 
                                                onChange={(e)=>{setQuantity(e.target.value);setSupId(v.supply_id);
                                                setMedId(v.med_id);}} 
                                                placeholder="Type quantity here" value={quantity[v.supply_id]}/>
                                                <input type="submit" name="cart" value="ADD TO CART"/> 
                                            </form>
                                        }
                                    </td>
                                }
                                {
                                    v.stock==0 &&
                                    <td>
                                        {
                                            <form onSubmit={handleQuantity}>
                                                <input type="number" readOnly placeholder="Sorry Out of Stock!" 
                                                value={quantity[v.med_id]}/>
                                                <input type="submit" readOnly name="cart" value="ADD TO CART"/> 
                                            </form>
                                        }
                                    </td>
                                }
                            </tr>
                        )
                    }
                    </tbody>
            </table>
            {errs.msg}
            {errs.quantity}
            <form onSubmit={viewPage}>
                <br/><br/>
                <input type="submit" name="confirm" value="Show Cart"/>
            </form>
        </div>
    )
}
export default ShowCart;