import { BrowserRouter,Routes,Route } from "react-router-dom";
import Login from "./AllUserComponents/Login";
import Registration from "./AllUserComponents/Registration";
import Home from "./AllUserComponents/Home";
import LoggedCourierHome from "./CourierComponents/LoggedCourierHome";
import ViewOrders from "./CourierComponents/ViewOrders";
import CustomerHome from "./CustomerComponents/CustomerHome";
import ShowMedicine from "./CustomerComponents/ShowMedicine";
import CustomerCart from "./CustomerComponents/CustomerCart";
import ShowMed from "./ManagerComponents/ShowMed";
import ShowUser from "./ManagerComponents/ShowUser";
import CustomerGrandtotal from "./CustomerComponents/CustomerGrandtotal";
import CustomerOrderPlaced from "./CustomerComponents/CustomerOrderPlaced";
import CustomerOrders from "./CustomerComponents/CustomerOrders";
import CustomerReturn from "./CustomerComponents/CustomerReturn";
import ManagerHome from "./ManagerComponents/ManagerHome";
import ShowOrders from "./ManagerComponents/ShowOrders";
import ShowSupply from "./ManagerComponents/ShowSupply";
import ShowCart from "./ManagerComponents/ShowCart";
import ViewCart from "./ManagerComponents/ViewCart";
import AcceptedOrders from "./CourierComponents/AcceptedOrders";
import CustomerProfile from "./CustomerComponents/CustomerProfile";
import CustomerProfileUpdate from "./CustomerComponents/CustomerProfileUpdate";
import ShowContract from "./ManagerComponents/ShowContract";
import ShowQuery from "./ManagerComponents/ShowQuery";
import ShowAccount from "./ManagerComponents/ShowAccount";
import SearchBar from "./ManagerComponents/SearchBar";
import ForgetPassword from "./AllUserComponents/ForgetPassword";
import VerifyOTP from "./AllUserComponents/VerifyOTP";
import SetPassword from "./AllUserComponents/SetPassword";
import SetCustomerPassword from "./CustomerComponents/SetCustomerPassword";
import CustomerComplain from "./CustomerComponents/CustomerComplain";
import CourierProfile from "./CourierComponents/CourierProfile";
import CourierProfileUpdate from "./CourierComponents/CourierProfileUpdate";
import CourierCashOut from "./CourierComponents/CourierCashOut";
import CustomerChart from "./CustomerComponents/CustomerChart";
import PassChange from "./ManagerComponents/PassChange";
import CustomerChartMonthly from "./CustomerComponents/CustomerChartMonthly";
import CustomerChartYearly from "./CustomerComponents/CustomerChartYearly";
import ProPic from "./ManagerComponents/ProPic";
import Profile from "./ManagerComponents/Profile";

const Main=()=>{
    return(
        <BrowserRouter>
        {/* <h2><Top/></h2> */}
        <Routes>
            <Route path="/" element={<Login/>}/>
            <Route path="/Registration" element={<Registration/>}/>
            <Route path="/home" element={<Home/>}/>
            <Route path="/forgotpassword" element={<ForgetPassword/>}/>
            <Route path="/send/otp/:email" element={<VerifyOTP/>}/>
            <Route path="/set/password/:email" element={<SetPassword/>}/>
            
            {/* COURIER--->TAHMID */}
            <Route path="/courier/home" element={<LoggedCourierHome/>}/>
            <Route path="/courier/ViewOrders" element={<ViewOrders/>}/>
            <Route path="/courier/AcceptedOrders" element={<AcceptedOrders/>}/>
            <Route path="/courier/profile" element={<CourierProfile/>}/>
            <Route path="/courier/profile/modify" element={<CourierProfileUpdate/>}/>
            <Route path="/courier/cashout" element={<CourierCashOut/>}/>

            {/* CUSTOMER ---> AYESHA */}
            <Route path="/customer/home" element={<CustomerHome/>}/>
            <Route path="/customer/profile" element={<CustomerProfile/>}/>
            <Route path="/customer/profile/update" element={<CustomerProfileUpdate/>}/>
            <Route path="/set/password/customer/:email" element={<SetCustomerPassword/>}/>
            <Route path="/customer/medlist" element={<ShowMedicine/>}/>
            <Route path="/customer/cart" element={<CustomerCart/>}/>
            <Route path="/customer/cart/grandtotal" element={<CustomerGrandtotal/>}/>
            <Route path="/customer/orderplaced" element={<CustomerOrderPlaced/>}/>
            <Route path="/customer/orders" element={<CustomerOrders/>}/>
            <Route path="/customer/return" element={<CustomerReturn/>}/>
            <Route path="/customer/complain" element={<CustomerComplain/>}/>
            <Route path="/customer/chart" element={<CustomerChart/>}/>
            <Route path="/customer/chart/monthly" element={<CustomerChartMonthly/>}/>
            <Route path="/customer/chart/yearly" element={<CustomerChartYearly/>}/>

            {/* MANAGER ---> MANAGER */}
            <Route path="/manager/medicine/:id" element={<ShowMed/>}/>
            <Route path="/manager/user/:id" element={<ShowUser/>}/>
            <Route path="/manager/home" element={<ManagerHome/>}/>
            <Route path="/manager/orders/:id" element={<ShowOrders/>}/>
            <Route path="/manager/supply/:id" element={<ShowSupply/>}/>
            <Route path="/manager/cart" element={<ShowCart/>}/>
            <Route path="/manager/cart/table" element={<ViewCart/>}/>
            <Route path="/manager/contract/:id" element={<ShowContract/>}/>
            <Route path="/manager/query" element={<ShowQuery/>}/>
            <Route path="/manager/account" element={<ShowAccount/>}/>
            <Route path="/manager/searching" element={<SearchBar/>}/>
            <Route path="/manager/change" element={<PassChange/>}/>
            <Route path="/manager/upload" element={<ProPic/>}/>
            <Route path="/manager/profile" element={<Profile/>}/>
        </Routes>
        {/* <Logout/> */}
        </BrowserRouter>
    )
}
export default Main;