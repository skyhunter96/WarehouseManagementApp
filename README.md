# WarehouseManagementApp
 CakePHP v 2.x
	
#Info

This is a warehouse and material management MVC application. Warehouses have various addresses where all sorts of items are stored. Users can add new items. CRUD is available for all resources. Validation is done through CakePHP's Model Validation system. There are groups of users which have different access rights. This is regulated by Access Control Lists. Also, various external libraries were used such as: tcpdf, phpexcel and Select2. There is a AJAX Live Search of records inside a database. Live: in progress...

#General

Users can add items in a 'Items' section. They can choose some of the predetermined types and statuses for the item which is to be added. They can also search items by keyword. Warehouse management is done through 'Warehouses' section. Warehouse Place is a section inside a Warehouse. When adding, user can choose if it is active. Later, addresses inside places are added. Address cannot be added if place is not in active state. There is a custom validation for adding address (if the same row, partition combined exists). Barcode is generated for each address (if you click on it pdf with this address' barcode will be saved). Later, manager can add amount of items to a address - he will search items to add to address by AJAX Live Search (async request is generated on every keyUp, so function will search regarding user input and return into the Select2 field). Managers can add permits for certain users to move items from an address to address. He can choose to issue a Transition only for the user which have a Permit for this Place, and amount to be moved.

#ACL Details

There are three groups of users: Administrators, Managers (of the Warehouses) and (regular) Users. All of those needs to log in which is done via CakePHP's rapid deployed login system. Administrators have complete control over the app and can access and manage all resources. Managers have the same rights as administrators except they can't add users and groups, they can't delete certain resources in a 'Warehouses' group. Regular users cannot manage warehouses, but they can browse them and see list of resources, they can perform CRUD operations on a 'Items' group.

#PDF and EXCEL

Two libraries are used: tcpdf and phpexcel. All types of resources can be listed in a generated pdf file. Since adding more than 6k items would be pretty boring, I used phpexcel to import those items into the database (Materials -> Excel File).

#Select2

This library prettifies all input fields where there are more than a dozen of inputs to chose from (search-like).

