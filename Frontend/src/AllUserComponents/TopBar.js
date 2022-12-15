// import {Link, useHref} from 'react-router-dom';
const TopBar=({url,value})=>{
    return(
        // <Link to={url}>{value}</Link>
        <a href={url}>{value}</a>
    )
}

export default TopBar;