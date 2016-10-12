var baseUrl = $('#baseUrl').val();
var array = [
	{name: "form_login", value: baseUrl + "/user/login_process",redirect:baseUrl + "/dashboard/index"},
        {name: "register_user_login", value: baseUrl + "/user/adduser",redirect:baseUrl + "/user/login"},
        {name: "usermaster", value: baseUrl + "/user/adduser",redirect:baseUrl + "/user/userList"},
	{name: "currencymaster", value: baseUrl + "/currency/addCurrency",redirect:baseUrl + "/currency/currencyList"},
	{name: "equivalentprofile", value: baseUrl + "eq_profile/addeq_profile",redirect:baseUrl + "/eq_profile/eq_profileList"},
	{name: "factor", value: baseUrl + "factor/factorMaster",redirect:baseUrl + "/factor/factorList"},
        {name: "materialformula", value: baseUrl + "materialformula/materialformulaMaster",redirect:baseUrl + "/materialformula/materialformulaList"},
        {name: "material", value: baseUrl + "material/materialMaster",redirect:baseUrl + "/material/materialList"},
        {name: "metalplate", value: baseUrl + "metalplate/metalplateMaster",redirect:baseUrl + "/metalplate/metalplateList"},
        {name: "metalthickness", value: baseUrl + "metalthickness/metalthicknessMaster",redirect:baseUrl + "/metalthickness/metalthicknessList"},
        {name: "product", value: baseUrl + "product/productMaster",redirect:baseUrl + "/product/productList"},
        {name: "ratechart", value: baseUrl + "ratechart/ratechartMaster",redirect:baseUrl + "/ratechart/ratechartList"},
        {name: "vproduct", value: baseUrl + "vproduct/vproductMaster",redirect:baseUrl + "/vproduct/vproductList"}
];

