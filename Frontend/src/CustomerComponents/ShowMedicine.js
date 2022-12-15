import {useState,useEffect} from 'react';
import axiosConfig from './../AllUserComponents/axiosConfig';
import CustomerTopBar from './CustomerTopBar';
import Logout from '../AllUserComponents/Logout';
const ShowMedicine=()=>{
    const[med,setMed] = useState([]);
    const[med_id,setMed_id]=useState();
    const[stock,setStock]=useState();
    const[quantity,setQuantity] = useState([]);
    const [errs,setErrs] = useState({});
    const [succ,setSucc] = useState({});    
    const [search,setSearch]=useState("");
    const [filter,setfilter]=useState("Filter by");
    useEffect(()=>{
        axiosConfig.get("customer/medlist").then((rsp)=>{
        setMed(rsp.data);
        debugger;
        },(er)=>{

        })

    },[]);

    const searchmed=(event)=>{
        event.preventDefault();
        const data = {search:search,filter:filter}
    axiosConfig.post("customer/search",data).then
    ((rsp)=>{
        setMed(rsp.data);
        debugger
    },(err)=>{
        debugger
    })
    }

    const handleQuantity=(event)=>{
        // debugger;
        event.preventDefault();
        const data={med_id:med_id,quantity:parseInt(quantity),Stock:stock};
        debugger;
        axiosConfig.post("customer/add/cart",data).
        then((succ)=>{
            setSucc(succ.data);
            debugger;
            window.location.href="/customer/medlist";
        },(err)=>{
            setErrs(err.response.data);
            console.log(data);
            debugger;
        }

        )
    }
    return(
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
            <h3>MEDICINE LIST</h3>
            <fieldset>
                <form onSubmit={searchmed}>
                    Search by Name: <input type="text" onChange={(e)=>{setSearch(e.target.value)}} name="search" value={search}/> 
                    <input type="submit" name="add" value="SEARCH"/> &nbsp; &nbsp; 

                    <select name="filter" id="" onChange={(e)=>{setfilter(e.target.value)}} value={filter}>
                        <option value="">Filter</option>
                        <optgroup label="Price :">
                            <option value="ORDER BY PRICE HIGHEST TO LOWEST">High - Low</option>
                            <option value="ORDER BY PRICE LOWEST TO HIGHEST">Low - High</option>
                        </optgroup>
                    </select>
                </form>
            </fieldset>
            <span>{errs.quantity? errs.quantity[0]:''}</span><br/>
            <table border="1">
                <tr>
                    <th>Medicine Name</th>
                    <th>Price per Unit</th>
                    <th>Stock</th>
                    <th>Quantity</th>
                </tr>
                {
                    med.map((m)=>
                    <tr key={m.med_id}>
                    <td>{ m.med_name }</td>
                    {/* {setMed_id(m.med_id)} */}
                    <td>{ m.price_perUnit }</td>
                    {
                        m.Stock=='0' &&
                        <td>STOCK OUT</td>
                    }
                    {
                        m.Stock!='0' &&
                        <td>{m.Stock}</td>
                    }
                    <td>
                        {
                            <form onSubmit={handleQuantity}>
                                <input type="number" name="quantity" min={0} onChange={(e)=>{setQuantity(e.target.value);setMed_id(m.med_id);setStock(m.Stock);}} placeholder="Type quantity here" value={quantity[m.med_id]}/>
                                <input type="submit" name="cart" value="ADD TO CART"/> 
                            </form>

                        }
                    </td>
                    </tr>
                    )
                }

                    
            </table>
            <br/>
        </div>
    )
}
export default ShowMedicine;