/**
 * Test task
 * Implement a financials ticker grid using the CSV data provided.
 */

var myClass=new MyClass(); //Create one instance


/**
 * MyClass
 * @constructor
 */
function MyClass(){
  this.data=null;
  this.delta=null;
  this.iteration=0;
  this.hInterval=null; //For stop interval
  this.new_interval=1000; //For change interval
  this.k=0;
}

/**
 * Check file read support
 */
MyClass.prototype.checkFileReadSupport=function(){
// Check for the various File API support.
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        return true;
    } else {
        alert('The File APIs are not fully supported by your browser.');
        return false;
    }
};

/**
 * Read single file
 * @param filename
 */
MyClass.prototype.readSingleFile=function(myClass,evt,dataOrnot) {
    var f = evt.target.files[0];
    if (f) {
        var r = new FileReader();
        r.onload = function(e) {
            var contents = e.target.result;
            if (dataOrnot)
                myClass.data=myClass.CSVToArray(contents);
            else
                myClass.delta=myClass.CSVToArray(contents);
        };
        r.readAsText(f);
    } else {
        alert("Failed to load file");
    }
};



/**
 * This will parse a delimited string into an array of
 * arrays. The default delimiter is the comma, but this
 * can be overriden in the second argument.
 */
MyClass.prototype.CSVToArray=function (strData, strDelimiter ){
    // Check to see if the delimiter is defined. If not,
    // then default to comma.
    strDelimiter = (strDelimiter || ",");
    // Create a regular expression to parse the CSV values.
    var objPattern = new RegExp(
        (
            // Delimiters.
            "(\\" + strDelimiter + "|\\r?\\n|\\r|^)" +
                // Quoted fields.
            "(?:\"([^\"]*(?:\"\"[^\"]*)*)\"|" +
                // Standard fields.
            "([^\"\\" + strDelimiter + "\\r\\n]*))"
        ),
        "gi"
    );
    // Create an array to hold our data. Give the array
    // a default empty first row.
    var arrData = [[]];
    // Create an array to hold our individual pattern
    // matching groups.
    var arrMatches = null;
    // Keep looping over the regular expression matches
    // until we can no longer find a match.
    while (arrMatches = objPattern.exec( strData )){
        // Get the delimiter that was found.
        var strMatchedDelimiter = arrMatches[ 1 ];
        // Check to see if the given delimiter has a length
        // (is not the start of string) and if it matches
        // field delimiter. If id does not, then we know
        // that this delimiter is a row delimiter.
        if (
            strMatchedDelimiter.length &&
            (strMatchedDelimiter != strDelimiter)
        ){
            // Since we have reached a new row of data,
            // add an empty row to our data array.
            arrData.push( [] );
        }
        // Now that we have our delimiter out of the way,
        // let's check to see which kind of value we
        // captured (quoted or unquoted).
        if (arrMatches[ 2 ]){
            // We found a quoted value. When we capture
            // this value, unescape any double quotes.
            var strMatchedValue = arrMatches[ 2 ].replace(
                new RegExp( "\"\"", "g" ),
                "\""
            );
        } else {
            // We found a non-quoted value.
            var strMatchedValue = arrMatches[ 3 ];
        }
        // Now that we have our value string, let's add
        // it to the data array.
        arrData[ arrData.length - 1 ].push( strMatchedValue );
    }
    // Return the parsed data.
    return( arrData );
};

/**
 * Create table function
 */
MyClass.prototype.CreateTable=function(){
    //body reference
    var body = document.getElementsByTagName("body")[0];

    // create elements <table> and a <tbody>
    var tbl     = document.createElement("table");
    var tblBody = document.createElement("tbody");
    tbl.setAttribute("id","myTable");
    // cells creation
    for (var j = 0; j < myClass.data.length-1; j++) {
        // table row creation
        var row = document.createElement("tr");

        for (var i = 0; i < myClass.data[0].length-1; i++) {
            // create element <td> and text node
            //Make text node the contents of <td> element
            // put <td> at end of the table row
            var cell = document.createElement("td");
            var cellText = document.createTextNode(myClass.data[j][i]);

            cell.appendChild(cellText);
            row.appendChild(cell);
        }

        //row added to end of table body
        tblBody.appendChild(row);
    }

    // append the <tbody> inside the <table>
    tbl.appendChild(tblBody);
    // put <table> in the <body>
    body.appendChild(tbl);
    // tbl border attribute to
    tbl.setAttribute("border", "2");
};

/**
 * Update table function
 */
MyClass.prototype.UpdateTable=function(){
    var myTable = document.getElementById('myTable');
    var j=1;
    var watch_dog=0;

    while(j<myTable.rows.length) {

        if (typeof(myClass.delta[myClass.k]) != "undefined") { //

            var startPos = 2; //In file we have broken data (some time 6 columns some time 5)
            if (myClass.delta[myClass.k].length == 5)
                startPos = 1;

            var valueAdded=0; //How much value changed
            for (var i = startPos; i < startPos + 3; i++) {

                var value = myClass.delta[myClass.k][i];
                //console.log("iteration=" + myClass.iteration +";k=" + myClass.k + ";j=" + j + "; i=" + i + "; value=" + value + "; delta=" + myClass.delta[myClass.k]);

                //Not change undefined values
                if (typeof(value) != "undefined") {
                    valueAdded++;
                    if (value.length > 0) {
                        if (startPos == 2)
                            myTable.rows[j].cells[i].innerHTML = value;
                        else
                            myTable.rows[j].cells[i + 1].innerHTML = value;
                    }
                }
            }
            if (valueAdded>0) //if some values changed we are increment j
             j++;

            myClass.k++; //Increment global row pointer

        } else {
            //Restart when we finished
            myClass.iteration=1;
            myClass.k=0;
            break;
        }
    }

    myClass.new_interval=myClass.delta[myClass.k][0]; //New interval after each ten rows

    if (myClass.hInterval!=null) {
        clearInterval(myClass.hInterval); //Clear interval
        //if (myClass.iteration<10)
        startProcess(); //Start process with new interval
    }

};

/**
 * Timer function
 */
MyClass.prototype.TimerFunction=function(){
   if (myClass.iteration==0){ //First start (create table)
       myClass.CreateTable();
       myClass.iteration++;
       //console.log(myClass.delta);
   } else {
       myClass.UpdateTable();
       myClass.iteration++;

   }
};


/**
 * Get bas data from csv
 */
function getDataFromCsv(evt){
    console.log(myClass);
    if (myClass.checkFileReadSupport()){
        myClass.readSingleFile(myClass,evt,true);
    }
}

/**
 * Get Delta data
 */
function getDeltaDataFromCsv(evt){
    console.log(myClass);
    if (myClass.checkFileReadSupport()){
        myClass.readSingleFile(myClass,evt,false);
    }
}

/**
 * Start process
 */
function startProcess() {
    if (myClass.data!=null&&myClass.delta!=null) {
        console.log("Start process with new interval=" + myClass.new_interval);
        myClass.hInterval = setInterval(myClass.TimerFunction, myClass.new_interval); //Timer function
    } else {
        alert("Please chose data and delta files");
    }
}

/**
 * Stop process
 */
function stopProcess(){
    if (myClass.hInterval!=null) {
        console.log("Stop process on " + myClass.k +" row in delta...");
        clearInterval(myClass.hInterval);
    }
}
