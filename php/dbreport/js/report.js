/* globals ajaxURL, tableDef */

formatDate = function(el) {
    var newDate = new Date(el);
    el = newDate.toLocaleDateString();
    return el;
};

function CriteriaObj() {
    this.fields = [];
    this.displayFields = [];
    this.values = [];
    this.displays = [];
    this.fieldLabels = [];
}

CriteriaObj.prototype.pushField = function(critObj) {
    this.fieldLabels.push(critObj.field);
    this.fields.push(critObj.name);
    this.displayFields.push(critObj.criteriaDisplay);
    this.values.push([]);
    this.displays.push({});
};
CriteriaObj.prototype.addValues = function(dataEl) {
    for(var ndx=0; ndx < this.fields.length; ndx++) {
        var fldName = this.fields[ndx];
        var displayField = this.displayFields[ndx];
        var val = dataEl[fldName];
        if (typeof(val) === "undefined") {
            continue;
        }
        var displayVal = dataEl[displayField];
        if (this.values[ndx].indexOf(val) < 0) {
            this.values[ndx].push(val);
            this.displays[ndx][val] = displayVal;
        }
    }
};
CriteriaObj.prototype.clearValues = function() {
    for(var ndx=0;ndx < this.fields.length; ndx++) {
        this.values[ndx] = [];
        this.displays[ndx] = {};
        $("#"+this.fields[ndx]).html("");
    }
};
CriteriaObj.prototype.addBaseSelect = function(field) {
    if (field.criteria !== true) {
        return;
    }
    var el = document.createElement("select");
    var labelEl = document.createElement("label");
    el.setAttribute("id",field.name);
    labelEl.setAttribute("for",field.name);
    labelEl.setAttribute("id","lbl"+field.name);
    $(labelEl).text(field.field);
    $("#critBox")[0].appendChild(labelEl);
    $("#critBox")[0].appendChild(el);
    $("#critBox")[0].appendChild(document.createElement("br"));
};
CriteriaObj.prototype.createOptions = function() {
    for(var ndx=0; ndx < this.fields.length; ndx++) {
        this.values[ndx].sort();
        var selEl = $("#"+this.fields[ndx])[0];
        var opt;
        if (this.values[ndx].length > 1) {
            opt = document.createElement("option");
            opt.setAttribute("value","--");
            $(opt).text("All");
            selEl.appendChild(opt);
        }
        for(var valNdx = 0; valNdx < this.values[ndx].length; valNdx++) {
            var val = this.values[ndx][valNdx];
            var valDisplay = this.displays[ndx][val];
            opt = document.createElement("option");
            opt.setAttribute("value",val);
            $(opt).text(valDisplay);
            selEl.appendChild(opt);
        }
    }
};
CriteriaObj.prototype.criteriaExists = function() {
    return (this.fields.length > 0);
};
CriteriaObj.prototype.criteriaLength = function() {
    return this.fields.length;
};
CriteriaObj.prototype.getFieldName = function(ndx) {
    return this.fields[ndx];
};

// End of CriteriaObj declarations

var criteriaObj = new CriteriaObj();

var reportApp = {
    grid: "",
    tableSettings: "",
    criteriaBoxVisible: true,
    tableFieldNames: [],
    gridData: "",
    criteria: criteriaObj,
    staticCriteria: {},
    gridHeight: 999,
    ajaxCallActive: false,
    init: function() {
        // Do stuff
        var me = reportApp;
        this.staticCriteria = new CriteriaObj();
        $("#critBox").html("");
        this.buildStaticCriteria();
        this.makeAjaxCall();
        $("#critFilter").click(function() {me.filterData();});
        $("#critHdr").click(function() { me.toggleCriteriaBox();});
        $("#printButton").click(function() { me.printTable(); });
        $(".staticcriteria").on("change", function(evt) { me.reInit(evt); });
    },
    makeAjaxCall: function() {
        var me = this;
        me.ajaxCallActive = true;
        var ajaxData = {
            "do": "get",
            "object": reportObject
        };
        if (initialCriteria !== null) {
            ajaxData.criteria_values = JSON.stringify(initialCriteria);
        }
        if (me.grid !== "") {
            me.grid.DataTable.settings[0].oLanguage.sEmptyTable = "Loading, please wait...";
            me.grid.fnDraw();
        }
        var dataCall = $.ajax({
            url: ajaxURL,
            dataType: "json",
            data: ajaxData
        });
        dataCall.then(
            function(data) {
                me.grid.DataTable.settings[0].oLanguage.sEmptyTable = "No data";
                me.grid.fnDraw();
                me.ajaxCallActive = false;
                me.showData(data);
            },
            function(resp) {
                me.ajaxCallActive = false;
                me.showError(resp);
            }
        );
        me.createTable();
    },
    reInit: function(event) {
        var me = this;
        var el = event.target.id;
        if (me.ajaxCallActive) {
            $("#"+el).val(initialCriteria[el]);
            return;
        }
        initialCriteria[el] = $("#"+el).val();
        // Clear the table
        // Clear the options
        me.grid.fnClearTable();
        for(var ndx=0; ndx < me.criteria.criteriaLength(); ndx++) {
            me.grid.fnFilter("", ndx);
        }
        me.grid.fnFilter("");
        me.criteria.clearValues();
        me.makeAjaxCall();
    },
    toggleCriteriaBox: function() {
        this.criteriaBoxVisible = !this.criteriaBoxVisible;
        $("#critBox").toggle();
        $("#critFooter").toggle();
        $("#critBoxInd").text( (this.criteriaBoxVisible ? "v" : ">") );
    },
    normalizeTableDef: function(def) {
        var fields = {
            "criteria": false,
            "width":"20",
            "datatype":"string",
            "criteriaDisplay": def.name,
            "visible":true
        };
        for(var prop in fields) {
            if (!fields.hasOwnProperty(prop)) {
                continue;
            }
            if (!def.hasOwnProperty(prop)) {
                def[prop] = fields[prop];
            }
        }
        if (!def.hasOwnProperty("criteria")) {
            def.criteria = false;
        }
        return def;
    },
    buildCriteria: function() {
        for(var prop in tableDef) {
            if (!tableDef.hasOwnProperty(prop)) {
                continue;
            }
            if (typeof(tableDef[prop])!=="object") {
                continue;
            }
            var curItem = this.normalizeTableDef(tableDef[prop]);
            if (curItem.criteria !== true) {
                continue;
            }
            this.criteria.pushField(curItem);
            this.criteria.addBaseSelect(curItem);
        }
    },
    buildStaticCriteria: function() {
        var initAr = [];
        for(var prop in staticCriteria) {
            if (!staticCriteria.hasOwnProperty(prop)) {
                continue;
            }
            var newFld = {
                criteria: true,
                name: staticCriteria[prop].name,
                values: staticCriteria[prop].values,
                criteriaDisplay: staticCriteria[prop].name,
                field: staticCriteria[prop].display
            };
            if (initialCriteria.hasOwnProperty(prop)) {
                initAr.push(prop);
            }
            this.staticCriteria.pushField(newFld);
            this.staticCriteria.addBaseSelect(newFld);
            for(var ndx=0; ndx < staticCriteria[prop].values.length; ndx++) {
                var tmpEl = {};
                tmpEl[newFld.name] = staticCriteria[prop].values[ndx];
                this.staticCriteria.addValues(tmpEl);
            }
            // Set a special attribute to identify this item
            $("#"+prop).addClass("staticcriteria");
        }
        this.staticCriteria.createOptions();
        // set the initial criteria = static
        for(var ndx=0; ndx < initAr.length; ndx++) {
            $("#"+initAr[ndx]).val(initialCriteria[initAr[ndx]]);
        }
    },
    createTable: function() {
        if (this.grid !== "") {
            return;
        }
        var colDefs = [];
        var colCount = 0;
        for(var prop in tableDef) {
            if (tableDef.hasOwnProperty(prop)) {
                var tmp = {};
                if (typeof(tableDef[prop]) === "object") {
                    var defObj = tableDef[prop];
                    tmp.sTitle = prop;
                    tmp.aTargets = [colCount];
                    tmp.mData = defObj.name;
                    if (defObj.hasOwnProperty("width")) {
                        tmp.sWidth = defObj.width;
                    }
                    if (defObj.hasOwnProperty("visible")) {
                        tmp.bVisible = defObj.visible;
                    }
                    if (defObj.hasOwnProperty("cssClass")) {
                        tmp.sClass = defObj.cssClass;
                    }
                    if (defObj.hasOwnProperty("datatype")) {
                        tmp.sType = defObj.datatype;
                        if (tmp.sType == 'number') {
                            tmp.sType = 'numeric';
                        }
                        if (defObj.datatype === "date") {
                            tmp.mRender = function(el) { return formatDate(el);};
                        }
                        if (defObj.datatype === "number") {
                            tmp.sClass += " tblNumber";
                            tmp.sClass = tmp.sClass.trim();
                        }
                    }
                    this.tableFieldNames.push(defObj.name);
                }
                else  {
                    tmp.sTitle = prop;
                    tmp.aTargets = [colCount];
                    tmp.mData = tableDef[prop];
                    this.tableFieldNames.push(tableDef[prop]);
                }
                colCount++;
                colDefs.push(tmp);
            }
        }
        this.gridHeight = Math.round(window.screen.height*0.50);
        this.tableSettings = {
            "aoColumnDefs" : colDefs,
            "sScrollY": this.gridHeight.toString()+"px",
            "iDisplayLength": -1,
            "oLanguage": {
                    "sEmptyTable": "Loading, please wait..."
            },
            "bInfo": true,
            "bPaginate": false
        };
        this.grid = $("#gridTbl").dataTable(this.tableSettings);
        this.buildCriteria();
    },
    showData: function(data) {
        if (this.grid !== "" && data.data.length > 0) {
            this.grid.fnAddData(data.data);
        }
        this.gridData = data.data;
        // Build Criteria
        if (this.criteria.criteriaExists()) {
            this.populateCriteria();
        }
    },
    populateCriteria: function() {
        for(var el in this.gridData) {
            this.criteria.addValues(this.gridData[el]);
        }
        this.criteria.createOptions();
    },
    filterData: function() {
        // Get the values
        this.grid.fnFilter("");
        for (var ndx = 0; ndx < this.criteria.criteriaLength(); ndx++) {
            var fldName = this.criteria.getFieldName(ndx);
            var val = $("#"+fldName).val();
            if (val === "--") {
                val = "";
            }
            this.grid.fnFilter(val, this.tableFieldNames.indexOf(fldName));
        }
    },
    showError: function(resp) {
        alert("There was an error.  Please contact IT. ");
        console.log(resp);
    },
    printTable: function() {
        var tblAr = this.grid[0].getElementsByTagName("tr");
        var tableContents="";
        // Get the Hdr Row
        tableContents = "<tr>"+$($("#gridTbl_wrapper table tr")[0]).html()+"</tr>";
        for(var ndx = 0; ndx < tblAr.length; ndx++) {
            var newRow = "<tr>"+$(tblAr[ndx]).html()+"</tr>";
            tableContents += newRow;
        }
        this.tblAr = tableContents;
        var newWin = window.open("?do=blank", "_newWin");
    },
    printTableContents: function(newWin) {
        var tblAr=this.tblAr;
        newWin.buildTable(tblAr);
        return;
    }

};

$(document).ready(function() {
    if (ajaxURL === "") {
        ajaxURL = "/dbprovidersvc/dbproxy.php";
    }
   reportApp.init();
});
