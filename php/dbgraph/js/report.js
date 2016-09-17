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
        if (typeof(val) == 'undefined') {
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
//        if (this.values[ndx].length > 1) {
//            opt = document.createElement("option");
//            opt.setAttribute("value","--");
//            $(opt).text("All");
//            //selEl.appendChild(opt);
//        }
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
        $("#chart_div").html("Loading...");
        var dataCall = $.ajax({
            url: ajaxURL,
            dataType: "json",
            data: ajaxData
        });
        dataCall.then(
            function(data) {
                me.ajaxCallActive = false;
                me.showData(data);
            },
            function(resp) {
                me.ajaxCallActive = false;
                me.showError(resp);
            }
        );
    },
    reInit: function(event) {
        var me = this;
        var el = event.target.id;
        if (me.ajaxCallActive) {
            $("#"+el).val(initialCriteria[el]);
            return;
        }
        initialCriteria[el] = $("#"+el).val();
        for(var ndx=0; ndx < me.criteria.criteriaLength(); ndx++) {
            me.grid.fnFilter("", ndx);
        }
        me.gridData = "";
        me.criteria.clearValues();
        me.makeAjaxCall();
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
    showData: function(data) {
        this.gridData = data.data;
        // Check on a custom report Object
        if (typeof(custRepObj) != 'undefined') {
            console.log("there is a customer report object");
            custRepObj.init();
        }
        this.buildGraph();
    },
    buildGraph: function() {
        // Get the report Data
        var me = this;
        this.data = me.gridData;
        // OK... now to make a 2d version google will consume properly
        var googAr = [];
        // add the column titles
        var titleAr = [];
        for(var ndx = 0; ndx < dataDef.length; ndx++) {
            titleAr.push(dataDef[ndx].display);
        }
        googAr.push(titleAr);
        var trends = {};
        for (var ndx =0; ndx < this.data.length; ndx++) {
            var tmpAr = [];
            for (var fldNdx =0; fldNdx < dataDef.length; fldNdx++) {
                var dataEl = null;
                if (this.data[ndx].hasOwnProperty([dataDef[fldNdx].name])) {
                    dataEl = this.data[ndx][dataDef[fldNdx].name];
                }
                switch (dataDef[fldNdx].type) {
                    case 'index':
                        dataEl = googAr.length-1;
                        break;
                    case 'float':
                        dataEl = parseFloat(dataEl);
                        break;
                    case "trend":
                        dataEl = parseFloat(dataEl);
                        // Get the trend number
                        var trndNbr = dataDef[fldNdx].trendNbr;
                        var trndCount = dataDef[fldNdx].count;
                        if (!trends.hasOwnProperty(trndNbr)) {
                            trends[trndNbr] = [];
                        }
                        trends[trndNbr].push(dataEl);
                        if (trends[trndNbr].length == trndCount) {
                            dataEl = trends[trndNbr].reduce(
                                function(sum, val) {
                                    sum += val;
                                    return sum;
                                },
                                0
                            ) / trndCount;
                            trends[trndNbr].shift();
                        }
                        else {
                            dataEl = null;
                        }
                        break;
                    case "date":
                        var tmpDate  = new Date()
                        var dtAr = dataEl.split("-");
                        tmpDate.setTime(Date.parse(dtAr[1]+"/"+dtAr[2]+"/"+dtAr[0]+" 08:0:0"));

                        dataEl = tmpDate.toLocaleDateString();
                        break;
                    default:
                        // do nothing
                }
                tmpAr.push(dataEl)
            }
            googAr.push(tmpAr);
        }
        if (googAr.length == 1) {
            $("#chart_div").html("<br>No data found!</br>");
            return;
        }
        this.graphData = googAr;
        $("#chart_div").html("");
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        this.graphOpts = graphOptions;
        chart.draw(
                google.visualization.arrayToDataTable(googAr),
            this.graphOpts
        );

    },
    showError: function(resp) {
        alert("There was an error.  Please contact IT. ");
        console.log(resp);
    }

};

$(document).ready(function() {
    if (ajaxURL === "") {
        ajaxURL = "/dbprovidersvc/dbproxy.php";
    }
   reportApp.init();

});
