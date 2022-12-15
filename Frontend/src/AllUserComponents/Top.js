import TopBar from './TopBar';
import {Link} from 'react-router-dom';
const Top=()=>{
    return(
        <div>
            <TopBar url="/" value="Login || "/>
            <TopBar url="/Registration" value="Register"/>
        </div>
    )
}

export default Top;