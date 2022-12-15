import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"

const SearchBar=()=>{
    const [val,setVal]=useState('')
    const [table,setTable]=useState('user')

    // useEffect(()=>{
    //     axiosConfig.get("manager/search")
    //     .then((res) =>{
    //         debugger
    //         getVal(res.data)
    //     },
    //     (err) =>{
    //         debugger
    //         console.log(err)
    //     })

    // },[])
    const search=(event)=>{
        event.preventDefault();
        const data={id:val}
        console.log(table)
        debugger;
            if (table=="medicine")
            {
                window.location.href=`/manager/medicine/${val}`;
            }
            else if (table=="contract")
            {
                window.location.href=`/manager/contract/${val}`;
            }
            else if (table=="supply")
            {
                window.location.href=`/manager/supply/${val}`;
            }
            else if (table=="order")
            {
                window.location.href=`/manager/order/${val}`;
            }
            else if (table=="user")
            {
                window.location.href=`/manager/user/${val}`;
            }
            // axiosConfig.post("manager/search/user",data)
            // .then((res)=>{
            //     debugger
            // },
            // (err)=>{
            //     debugger
            //     console.log(err)
            // })
        
    }
    return(
        <div>
            <form onSubmit={search}>
                <fieldset style={{width:"20%", position: 'absolute', right: 5, top: 5,}}>
                    <legend align="center"><b>Search Bar</b></legend>
                        Search in table: <br/>
                        <select name="search" placeholder="Search in table" onChange={(e)=>{setTable(e.target.value)}}>
                            <option value="user">User</option>
                            <option value="medicine">Medicine</option>
                            <option value="contract">Contract</option>
                            <option value="order">Order</option>
                            <option value="supply">Supply</option>
                        </select>
                        <br/>
                        Search Here:- <br/>
                        <input type="text" name="searchBar" onChange={(e)=>{setVal(e.target.value)}} placeholder="Search by id"/> <br/>
                        <input type="submit" name="action" value="Search"/>
                </fieldset>
            </form>
        </div>
    )
}
export default SearchBar;