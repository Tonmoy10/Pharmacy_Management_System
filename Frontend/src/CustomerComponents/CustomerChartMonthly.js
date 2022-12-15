import Logout from "../AllUserComponents/Logout";
import CustomerTopBar from "./CustomerTopBar";
import ReactApexChart from "react-apexcharts"
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";

const CustomerChartMonthly=()=>{
    const [bill,setBill]=useState([]);
    const [month,setMonth]=useState([]);
    const [option,setOption]=useState("");

    useEffect(()=>{
      axiosConfig.post("customer/chart/monthly").then
      ((rsp)=>{
        setBill(rsp.data.bill);
        setMonth(rsp.data.month);
        debugger
      },(err)=>{
        debugger
      })
    },[])
      const series= [{
          data: bill
        }];
      const options= {
          chart: {
            height: 350,
            type: 'bar',
            events: {
              click: function(chart, w, e) {
                // console.log(chart, w, e)
              }
            }
          },
          // colors: colors,
          plotOptions: {
            bar: {
              columnWidth: '45%',
              distributed: true,
            }
          },
          dataLabels: {
            enabled: false
          },
          legend: {
            show: true
          },
          xaxis: {
            categories: month,
            labels: {
              style: {
              //   colors: colors,
                fontSize: '12px'
              }
            }
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
                <option value="monthly">MONTHLY EXPENSE</option>
                <option value="daily">DAILY EXPENSE</option>
                <option value="yearly">YEARLY EXPENSE</option>
            </select>

            <h4>MONTHLY EXPENSE</h4>
            <ReactApexChart options={options} series={series} type="bar" height={350} />
        </div>
    )
}

export default CustomerChartMonthly;