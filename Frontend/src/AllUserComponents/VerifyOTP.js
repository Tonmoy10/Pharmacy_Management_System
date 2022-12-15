import { useState, useEffect, useRef} from "react";
import axiosConfig from "./axiosConfig";
import { useParams } from "react-router-dom";
import Top from "./Top"
const VerifyOTP=()=>{
    const {email} = useParams();
    const [count,setCount] = useState(60);
    const counterRef = useRef(60);
    const [otp,setOtp] = useState();
    const [errs,setErrs] = useState("");

    useEffect(() => {
        counterRef.current = count;
      })
    
      useEffect(() => {
        const info = {email:email}

        setInterval(() => {
          setCount(counterRef.current - 1);
          if (counterRef.current==0)
          {
            alert("The OTP has expired. Request for a new OTP.")
            axiosConfig.post("otp/clear",info).then
            ((rsp)=>{
                    window.location.href="/forgotpassword";
            },(err)=>{
                debugger;
            })
          }
        }, 1000);
      }, []);
    

    const verify=(event)=>
    {
        event.preventDefault();
        const data = {email:email,code:otp};
        debugger;
        axiosConfig.post("otp/verify",data).then
        ((rsp)=>{
            debugger;
            window.location.href=`/set/password/${email}`
        },(err)=>{
            debugger;
            setErrs(err.response.data);
        })
    }
    return(
        <div>
            <h2><Top/></h2>

            <center>
            <br/><br/><br/><br/>
            <fieldset style={{width:"30%"}}>
            <form onSubmit={verify}>
                <br/>
                Email: <input type="email" size={30} name="email" value={email} readOnly/> <br/><br/>
                CODE : <input type="num" name="code" onChange={(e)=>{setOtp(e.target.value)}} maxLength={6} size="35" placeholder=" Enter the 6 digit code sent to your email " value={otp}/> <br/> <br/>

                <input type="submit" value="VERIFY OTP"/>
            </form>                 
            </fieldset>
            THE OTP WILL EXPIRE IN {count} SECONDS
            {errs.msg}
            </center>
        </div>
    )
}

export default VerifyOTP;