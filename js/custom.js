var baseUrl = $('#baseUrl').val();
var array = [
	{name: "form_login", value: baseUrl + "/user/login_process",redirect:baseUrl + "/dashboard/index"},
        {name: "register_user_login", value: baseUrl + "/user/adduser",redirect:baseUrl + "/user/login"},
        {name: "usermaster", value: baseUrl + "/user/adduser",redirect:baseUrl + "/user/userList"},
	{name: "currencymaster", value: baseUrl + "/currency/addCurrency",redirect:baseUrl + "/currency/currencyList"},
        
	{name: "vehicleList", value: baseUrl + "vehicle/vehicleDelete"},
	{name: "vehicle_update", value: baseUrl + "vehicle/vehicleUpdate"},
	{name: "drivermaster", value: baseUrl + "driver/driverMasterSubmit"},
	{name: "driverList", value: baseUrl + "driver/driverDelete"},
	{name: "driver_update", value: baseUrl + "driver/driverUpdate"},
	{name: "vendormaster", value: baseUrl + "vendor/addvendor"},
	{name: "vendorList", value: baseUrl + "vendor/vendorDelete"},
	{name: "vendor_update", value: baseUrl + "vendor/vendorUpdate"}
];

