import Logout from "../AllUserComponents/Logout";
import CustomerTopBar from "./CustomerTopBar";
import ReactApexChart from "react-apexcharts"
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";

const CustomerChartYearly=()=>{
    const [bill,setBill]=useState([]);
    const [yearly,setYear]=useState([]);
    const [option,setOption]=useState("");

    useEffect(()=>{
      axiosConfig.post("customer/chart/yearly").then
      ((rsp)=>{
        setBill(rsp.data.bill);
        setYear(rsp.data.year);
        debugger
      },(err)=>{
        debugger
      })
    },[])
    const series= [{
        name: "Expense",
        data: bill
    }];
    const options= {
      chart: {
        height: 350,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      title: {
        text: 'Year trends',
        align: 'left'
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: yearly,
      }
    };
  


    const change=(e)=>
    {
        setOption(e.target.value);
        console.log(option)
        debugger
        if (e.target.value==="daily")
        {
            debugger  
            window.location.href="/customer/chart";
        }
        else if (e.target.value==="monthly")
        {
            window.location.href="/customer/chart/monthly";
        }
        else if (e.target.value==="yearly")
        {
            window.location.href="/customer/chart/yearly";
        }
    }
    return(
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
            <select name="search" onChange={(e)=>{change(e)}}>
                <option value="yearly">YEARLY EXPENSE</option>
                <option value="monthly">MONTHLY EXPENSE</option>
                <option value="daily">DAILY EXPENSE</option>
            </select>

            <h4>YEARLY EXPENSE</h4>
            <ReactApexChart options={options} series={series} type="line" height={350} />
        </div>
    )
}

export default CustomerChartYearly;