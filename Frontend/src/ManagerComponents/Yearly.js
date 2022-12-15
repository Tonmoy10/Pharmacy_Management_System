import Logout from "../AllUserComponents/Logout";
import ReactApexChart from "react-apexcharts"
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";

const Yearly=()=>{
    const [bill,setBill]=useState([]);
    const [exp,setExp]=useState([]);
    const [year,setYear]=useState([]);

    useEffect(()=>{
        axiosConfig.get("manager/yearly")
        .then((resp)=>{
            setBill(resp.data.bill);
            setExp(resp.data.exp);
            setYear(resp.data.year);
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
              text: 'Yearly Record',
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
              categories: year,
              title: {
                text: 'Year'
              }
            },
            yaxis: {
              title: {
                text: 'Expenses and Revenue'
              },
              min: -10000,
              max: 50000
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
export default Yearly;