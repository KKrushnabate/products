var baseUrl = $('#baseUrl').val();
var array = [
	{name: "form_login", value: baseUrl + "/user/login_process",redirect:baseUrl + "/dashboard/index"},
        {name: "register_user_login", value: baseUrl + "/user/adduser",redirect:baseUrl + "/user/login"},
        {name: "usermaster", value: baseUrl + "/user/adduser",redirect:baseUrl + "/user/userList"},
	{name: "currencymaster", value: baseUrl + "/currency/addCurrency",redirect:baseUrl + "/currency/currencyList"},
	{name: "equivalentprofile", value: baseUrl + "/eq_profile/addeq_profile",redirect:baseUrl + "/eq_profile/eq_profileList"},
	{name: "factormaster", value: baseUrl + "/factor/addfactor",redirect:baseUrl + "/factor/factorList"},
        {name: "materialformula", value: baseUrl + "/materialfarmula/addmaterialfarmula",redirect:baseUrl + "/materialfarmula/materialfarmulaList"},
        {name: "material", value: baseUrl + "/material/addmaterial",redirect:baseUrl + "/material/materialList"},
        {name: "metalplatemaster", value: baseUrl + "/metalplate/addmetalplate",redirect:baseUrl + "/metalplate/metalplateList"},
        {name: "metalthickness", value: baseUrl + "/metalthickness/addmetalthickness",redirect:baseUrl + "/metalthickness/metalthicknessList"},
        {name: "product", value: baseUrl + "/product/productMaster",redirect:baseUrl + "/product/productList"},
        {name: "ratechart", value: baseUrl + "/ratechart/addratechart",redirect:baseUrl + "/ratechart/ratechartList"},
        {name: "vproductmaster", value: baseUrl + "/vproduct/addvProduct",redirect:baseUrl + "/vproduct/vproductList"}
];

