import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"
import { useParams } from 'react-router-dom'

const ProPic=()=>{
    const [profilepic,setProfilePic] =useState("");


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
        var data = new FormData();
        data.append("profilepic",profilepic,profilepic.name);
        debugger
        axiosConfig.post("manager/upload/propic",data).
        then((succ)=>{
            console.log(succ);
            debugger;
            window.location.href="/manager/home";
        },(err)=>{
            //setErrs(err.response.data);
            console.log(err);
        })
    }
    return(
        <div>
            <form onSubmit={change}>
                <center>
                    <br/><br/><br/><br/><br/><br/><br/><br/>
                    <fieldset style={{width:"30%"}}>
                    <legend align="center"><b>Change Profile Picture</b></legend>
                    Choose Image : <input type="file" onChange={(e)=>{setProfilePic(e.target.files[0]);}} 
                    name="profilepic"></input><br/>
                    <input type="submit" name="submit" value="Confirm"/>
                    </fieldset>
                </center>
            </form>
        </div>
    )

}
export default ProPic;