var nodeCsvContohSemiCollon = document.getElementById("dwn_csv_sc");
var nodeCsvContohComma = document.getElementById("dwn_csv_c");
var nodeBat = document.getElementById("dwn_bat");


// console.log (nodeCsvContoh);

function download(filename){
    window.location="http://192.168.1.25/sembako/aset/download.php?file="+filename;
}


nodeCsvContohSemiCollon.addEventListener ("click", function() {
	download("example-semicollon.csv");
});

// nodeCsvContohComma.addEventListener ("click", function() {
// 	download("example-comma.csv");
// });


nodeBat.addEventListener ("click", function() {
	download("SetRegional.bat");
});
