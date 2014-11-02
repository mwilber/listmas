var ggServices = angular.module('ggServices', []);

ggServices.service('ggActiveList', [
    function(){
        
        var activeList = 0;

        return {
            GetActiveList: function () {
                return activeList;
            },
            SetActiveList: function(value) {
                activeList = value;
                localStorage.setItem("activeList", activeList);
            }
        };
    }
]);

ggServices.service('ggActiveProd', [
    function(){
        
        var activeProd = {};

        return {
            GetActiveProd: function () {
                return activeProd;
            },
            SetActiveProd: function(value) {
                activeProd = value;
            }
        };
    }
]);

ggServices.service('ggDb', [
    function(){
        //alert('service start');
        this.SQL_CREATE_TABLE_PRODUCT = "CREATE TABLE IF NOT EXISTS tblProd (prodId INTEGER PRIMARY KEY, prodName TEXT, unitId INTEGER, prodSize REAL, prodUpc TEXT, prodDateAdded INTEGER)";
        this.SQL_DROP_TABLE_PRODUCT = "DROP TABLE IF EXISTS tblProd";
        this.SQL_INSERT_PRODUCT = "INSERT INTO tblProd (prodName) VALUES ( ?)";
        
        this.db = openDatabase('ggamer', '1.0', 'Mobile Client DB', 2 * 1024 * 1024);
        this.db.transaction(function (tx) {
            tx.executeSql(this.SQL_CREATE_TABLE_PRODUCT);
            //tx.executeSql('INSERT INTO tblProd (prodName) VALUES ( ?)', ['gisp3']);
        });
        
        this.ClearDb = function(){
            alert('clearing tblProd');
            this.db.transaction(function (tx) {
                tx.executeSql(this.SQL_DROP_TABLE_PRODUCT);
                //tx.executeSql(this.SQL_CREATE_TABLE_PRODUCT);
            });
        };
        
        this.TestInsert = function(){
            this.db.transaction(function (tx) {
                tx.executeSql('INSERT INTO tblProd (prodName) VALUES ( ?)', ['gisp4']);
            });
        };
        
        this.AddProd = function(pProd, pReturn){
            console.log('Adding Product');
            console.log(pProd);
            this.db.transaction(function (tx) {
                tx.executeSql('INSERT INTO tblProd (prodName) VALUES ( ?)', [pProd.name], pReturn);
            });
        };
        
        this.GetProds = function(pReturn){
            console.log('Getting Product List');
            this.db.transaction(function (tx) {
                tx.executeSql('SELECT * FROM tblProd', [], pReturn, function(result){alert('error'); console.log(result);});
            });
        };
    }
]);