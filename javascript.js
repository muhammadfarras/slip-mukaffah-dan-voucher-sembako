var nodeCsvContohSemiCollon = document.getElementById("dwn_csv_sc")
var nodeCsvContohComma = document.getElementById("dwn_csv_c")
var nodeBat = document.getElementById("dwn_bat")
var nodeServerName = document.getElementById("server-name").innerHTML
var nodeServerPort = document.getElementById("server-port").innerHTML
var nodeServerScheme = document.getElementById("request-scheme").innerHTML


// console.log (nodeCsvContoh);

function download(filename){
    window.location=nodeServerScheme+"://"+nodeServerName+":"+nodeServerPort+"/sembako/aset/download.php?file="+filename
	// "http://192.168.1.236:41062/sembako/aset/download.php?file="+filename;
}


nodeCsvContohSemiCollon.addEventListener ("click", function() {
	download("example-semicollon.csv")
});

// nodeCsvContohComma.addEventListener ("click", function() {
// 	download("example-comma.csv");
// });


nodeBat.addEventListener ("click", function() {
	download("SetRegional.bat")
});
