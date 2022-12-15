import Logout from "../AllUserComponents/Logout";
import ReactApexChart from "react-apexcharts"
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";

const Monthly=()=>{
    const [bill,setBill]=useState([]);
    const [exp,setExp]=useState([]);
    const [month,setMonth]=useState([]);

    useEffect(()=>{
        axiosConfig.get("manager/monthly")
        .then((resp)=>{
            setBill(resp.data.bill);
            setExp(resp.data.exp);
            setMonth(resp.data.month);
        },(err)=>{
            console.log(err)
        })
        },[])
        const series= [
            {
              name: "Revenue",
              data: bill
            },
            {
              name: "Expense",
              data: exp
            }
          ];
          const options= {
            chart: {
              height: 350,
              type: 'line',
              dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
              },
              toolbar: {
                show: false
              }
            },
            colors: ['#77B6EA', '#545454'],
            dataLabels: {
              enabled: true,
            },
            stroke: {
              curve: 'smooth'
            },
            title: {
              text: 'Monthly Record',
              align: 'left'
            },
            grid: {
              borderColor: '#e7e7e7',
              row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
              },
            },
            markers: {
              size: 1
            },
            xaxis: {
              categories: month,
              title: {
                text: 'Month'
              }
            },
            yaxis: {
              title: {
                text: 'Expense and Revenue'
              },
              min: -1000,
              max: 10000
            },
            legend: {
              position: 'top',
              horizontalAlign: 'right',
              floating: true,
              offsetY: -25,
              offsetX: -5
            }
          };
    return(
        <div>
            <ReactApexChart options={options} series={series} type="line" height={350} />
        </div>
    )

}
export default Monthly;