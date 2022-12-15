import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import { useParams } from 'react-router-dom'

const PassChange=()=>{
    const [pass,setPass]=useState('')
    const [n_pass,setNew]=useState('')
    const [con_pass,setCon]=useState('')
    const [errs,setErrs] = useState("");

    // useEffect(()=>{
    //     axiosConfig.get("manager/change").
    //     then((suc)=>{
    //         debugger;
            
    //     },(err)=>{
    //         debugger;
    //     }
    //     )
    // })

    const change=(event)=>{
        event.preventDefault();
        const data={new:n_pass,con:con_pass,pass:pass};
        debugger;
        axiosConfig.post("manager/change/pass",data).
        then((succ)=>{
            debugger;
            window.location.href="/manager/home";
            
        },(err)=>{
            //setErrs(err.response.data);
            setErrs(err.response.data);
            console.log(err);
            debugger;
        }

        )
    }
    return(
        <div>
            <form onSubmit={change}>
                <center>
                    <br/><br/><br/><br/><br/><br/><br/><br/>
                    <fieldset style={{width:"30%"}}>
                    <legend align="center"><b>Change Password</b></legend>
                    <input type="password" name="oldp" onChange={(e)=>{setPass(e.target.value)}} placeholder="Enter current password"/> <br/><br/>
                    <span>{errs.pass? errs.pass[0]:''}</span><br/>
                    <input type="password" name="newp" onChange={(e)=>{setNew(e.target.value)}} placeholder="Enter new password"/> <br/><br/>
                    <span>{errs.new? errs.new[0]:''}</span><br/>
                    <input type="password" name="confp" onChange={(e)=>{setCon(e.target.value)}} placeholder="Confirm new password"/> <br/><br/>
                    <span>{errs.con? errs.con[0]:''}</span><br/>
                    <input type="submit" name="submit" value="Confirm"/>
                    </fieldset>
                </center>
            </form>
        </div>
    )

}
export default PassChange;