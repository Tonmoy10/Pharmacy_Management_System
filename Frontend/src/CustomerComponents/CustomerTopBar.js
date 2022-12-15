import CustomerTop from "./CustomerTop";

const CustomerTopBar=()=>{
    return(
        <div>
            <CustomerTop url="/customer/home" value="Home || "/>
            <CustomerTop url="/customer/profile" value="Profile || "/>
            <CustomerTop url="/customer/medlist" value="Medicine List || "/>
            <CustomerTop url="/customer/cart" value="Cart || "/>
            <CustomerTop url="/customer/orders" value="Orders || "/>
            <CustomerTop url="/customer/return" value="Return || "/>
            <CustomerTop url="/customer/complain" value="File a Complain || " />
            <CustomerTop url="/customer/chart" value="Expenditure Graph" />
        </div>
    )
}

export default CustomerTopBar;