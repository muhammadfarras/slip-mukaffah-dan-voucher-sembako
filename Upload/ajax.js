
import { Collapse } from './bootstrap.esm.js';

var nodeProgressBar = document.getElementById("progressbar");
var nodeProgressBarDb = document.getElementById("progressbarDb");
var nodeProgressBarEmail = document.getElementById("progressbarEmail");
var nodePath = document.getElementById ("path").innerHTML;
var nodeFileName = document.getElementById ("file-name").innerHTML;
var nodePdfPath = document.getElementById ("dir_pdf_path").innerHTML;
var nodeBaseName = document.getElementById ("base_name").innerHTML;
var nodeBtnProses = document.getElementById ("btn_proses");
var nodeBtnProsesDb = document.getElementById("btn_proses_db");
var nodeBtnProsesEmail = document.getElementById("btn_proses_email");
var nodeBtnReUpload = document.getElementById("btn_reupload");
var nodeBtnProsesFinal = document.getElementById("btn_proses_final");

var nodeBtnAndProgress = document.getElementById("btn-and-progress");
var nodeBtnAndProgressDb = document.getElementById("btn-and-progress-db");
var nodeBtnAndProgressEmail = document.getElementById("btn-and-progress-email");
var nodeLog = document.getElementById("log");
var tempNodeLog;
var banyakDataGlobal;
var jumlahDataBerjalan = 0; // To find count pdf craeted
var jumlahDataBerjalanDb = 0; // To find count db created
var savedList;


var nodeAlertDenger = document.getElementById("alert-danger");
var nodeAlertInfo = document.getElementById ("alert-info");
var nodeAlertInfoDb = document.getElementById ("alert-info-db");
var nodeAlertInfoEmail = document.getElementById ("alert-info-email");
var nodeAlertInfoFinal = document.getElementById ("alert-info-final");
var nodeMuter = document.getElementById("muter");
var nodeMuterDb = document.getElementById("muterDb");
var nodeMuterEmail = document.getElementById("muterEmail");


var countEksekusi = 0;
var countEksis = 0;
var countTidakEksis = 0;
var countInsert = 0;
var countUpdate = 0;
var countTidakDimasukan = 0;

var countEksekusiEmail = 0;
var countEmailBerhasil = 0;
var countEmailGagal = 0;

// console.log(nodeBaseName);

let warning = new Collapse(nodeAlertDenger,{

	toggle: false

});

let info = new Collapse(nodeAlertInfo, {

	toggle: false

});

let collapseBtnProses = new Collapse (nodeBtnAndProgress,{

	toggle: false

});

let infoDb =  new Collapse(nodeAlertInfoDb, {

	toggle: false

});

let collapseBtnProsesDb = new Collapse (nodeBtnAndProgressDb, {
	toggle: false
})

let infoEmail = new Collapse (nodeAlertInfoEmail, {
	toggle: false
})

let infoFinal = new Collapse (nodeAlertInfoFinal , {
	toggle: false
})

let collapseBtnProsesEmail = new Collapse (nodeBtnAndProgressEmail, {
	toggle: false
})




// function sleep(ms) {
//   return new Promise(resolve => setTimeout(resolve, ms));
// }

// async function runProgress(){

// 	for (let i = 0 ; i<=100 ; i++){
// 	await sleep (3000);
// 		nodeProgressBar.style.width = i+"%";

// 		if (nodeProgressBar.style.width == '100%'){
// 			console.log ("Stop");
// 		}
// 	}
// }

function download(filename){
    window.location="http://192.168.1.25/sembako/aset/download.php?file="+filename;
}

function runAjaxCheckFileCsv(path,fileName){

	var xhttp = new XMLHttpRequest();

  	xhttp.onreadystatechange = function() {

	    if (this.readyState == 4 && this.status == 200) {

	   		// console.log (this.responseText);
	      	savedList =  JSON.parse(this.responseText);

	      	// console.log(savedList);

	      	// jika hasil status error
	      	if (savedList.status != "error"){

	      		setTimeout (function() {
					info.show();
				},1000);


	      		setTimeout (function(){
		      		// wait abour 3 secs to make sure return ajax is filled in variabel
		      		collapseBtnProses.show();

	      		},3000);
	      	}
	      	else {

	      		setTimeout (function() {
					warning.show();
					nodeLog.innerHTML = savedList.text;
				},1000);


	      	}




	    }
	  };
	  xhttp.open("GET", "../CheckCsv.php?path="+path+"&file-name="+fileName, true);
	  xhttp.send();
}
savedList = runAjaxCheckFileCsv(nodePath,nodeFileName);




// createing function that run ajax multiple time to create pdf and store to database
function ProsessPdf(items, path){

	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {

	    if ((this.readyState == 4) && (this.status == 200)){
				// console.log (this.responseText);
	    	jumlahDataBerjalan += parseInt(this.responseText);
	    	// console.log (jumlahDataBerjalan);
	    	nodeLog.innerHTML = jumlahDataBerjalan+" file telah terbuat.";

	    	var prosentase  = ((jumlahDataBerjalan/banyakDataGlobal)*100)+"%";

	    	// console.log (prosentase);
	    	nodeProgressBar.style.width = prosentase;

	    	if (jumlahDataBerjalan == banyakDataGlobal){
	    		nodeMuter.classList.add("d-none");
	    		nodeLog.innerHTML += "<br>Alhamdulillah Seluruh file berhasil digenerate"

	    		//  tutup lagi hasil donwloadnya jika sudah berhasil generate semua file pdf
	      		collapseBtnProses.hide();

	      		// Buat zip dan download zip
	      		zipJson(nodeBaseName);

	      		// Hide info generate pdf
	      		setTimeout (function() {
					info.hide();
				},1000);


				// show info run db and send email
	      		setTimeout (function() {
					infoDb.show();
				},1000);

				// show button and progres for running proses
	      		setTimeout (function() {
					collapseBtnProsesDb.show();
				},3000);


				tempNodeLog = nodeLog.innerHTML;
	    	}
	    }
	  };
	  xhttp.open("GET", "createpdf.php?data="+items+"&path="+path, true);
	  xhttp.send();
}

function zipJson (path){

	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {

	    if ((this.readyState == 4) && (this.status == 200)){
	    	var hasilZip = JSON.parse (this.responseText);
	    	// console.log (hasilZip);

	    	// Buat zip
	    	if (hasilZip.status == "correct"){
	    		console.log ("Donwload ZIP");

	    		// Jika berhasil download zip-nya
	    		window.location="http://192.168.1.25/sembako/upload/downloadZip.php?path="+hasilZip.values;
	    	}
	    }
	  };
	  xhttp.open("GET", "createZip.php?path="+path, true);
	  xhttp.send();
}

function RunAllList (items,path){

	var banyakData = items.values.length;

	// loading purpose
	banyakDataGlobal = banyakData;
	// console.log (banyakDataGlobal);

	for (var i = 0 ; i < banyakData ; i++){

		// console.log (JSON.stringify (items.values[i]));
		ProsessPdf (JSON.stringify (items.values[i]),path);
	}
}


function RunnAllListDb (items){
	var banyakData = items.values.length;

	// loading purpose
	banyakDataGlobal = banyakData;
	// console.log (banyakDataGlobal);

	for (var i = 0 ; i < banyakData ; i++){

		// console.log (JSON.stringify (items.values[i]));
		ProsessDb (JSON.stringify (items.values[i]),path);
	}
}

function runAllListEmail (items,path){
	var banyakData = items.values.length;

	// loading purpose
	banyakDataGlobal = banyakData;
	// console.log (banyakDataGlobal);

	for (var i = 0 ; i < banyakData ; i++){

		// console.log (items.values[i]);
		ProsessEmail (JSON.stringify (items.values[i]),path,i);
	
	}
}


function ProsessDb (items, path){

	var data = (items);
	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {

	    if ((this.readyState == 4) && (this.status == 200)){
	    	// console.log (this.responseText);

	    	var result =  JSON.parse (this.responseText);

	    	countEksekusi += result.eksekusi;
	    	countUpdate += result.diupdate;
	    	countInsert += result.dimasukan;
	    	countTidakEksis += result.tidak_eksis;
	    	countEksis += result.eksis;
	    	countTidakDimasukan += result.tidak_dimasukan;


	    	var prosentase  = ((countEksekusi/banyakDataGlobal)*100)+"%";

	    	// console.log (prosentase);
	    	nodeProgressBarDb.style.width = prosentase;
	    	nodeLog.innerHTML = tempNodeLog + "<br>Data sedang dimasukan kedalam server "+countEksekusi;




	    	if (countEksekusi == banyakDataGlobal){

	    		// Tutup jika sudah selesai dari db
	    		collapseBtnProsesDb.hide();


	    		// show info run db and send email
	      		setTimeout (function() {
					infoDb.hide();
				},1000);

				// show button and progres for running proses
	      		setTimeout (function() {
					collapseBtnProsesDb.hide();
				},3000);

				// show info run db and send email
	      		setTimeout (function() {
					infoEmail.show();
				},1000);

				// show button and progres for running proses
	      		setTimeout (function() {
					collapseBtnProsesEmail.show();
				},3000);


	    		// jalankan proses kirim email
	    		nodeLog.innerHTML += "<div class='p-3 mb-2 bg-info text-dark'>"+

	    		"Data baru sebanyak : "+countInsert+

	    		"<br>Data diubah sebanyak : "+countUpdate+

	    		"<br>Data tidak sembako : "+countTidakDimasukan+
	    		
	    		"</div>";

	    		tempNodeLog = nodeLog.innerHTML;
	    	}
	    	// console.log (countEksekusi);
	    	// console.log ("Banyak data semua "+banyakDataGlobal);
	    	// // JSON Pars First

	    }
	  };
	  xhttp.open("GET", "CheckDataBase.php?data="+data+"&path="+path+"&time="+Math.random(), true);
	  xhttp.send();

}

function ProsessEmail (items, path, secondSleep){

	// var data = (items);
	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {

	    if ((this.readyState == 4) && (this.status == 200)){
	    	console.log (this.responseText);

	    	var result =  JSON.parse (this.responseText);

	    	countEksekusiEmail += result.count;
	    	countEmailBerhasil += result.send;
	    	countEmailGagal += result.fail;
	    	


	    	var prosentase  = ((countEksekusiEmail/banyakDataGlobal)*100)+"%";

	    	// console.log (prosentase);
	    	nodeProgressBarEmail.style.width = prosentase;
	    	nodeLog.innerHTML = tempNodeLog + "<br>Email diproses sebanyak : "+countEksekusiEmail;

	    	if (countEksekusiEmail == banyakDataGlobal){
	    		// jalankan proses kirim email
	    		nodeLog.innerHTML += "<div class='p-3 mb-2 bg-success text-dark'>"+
	    		"<br>Email diproses: "+countEksekusiEmail+
	    		"<br>Email terkirim: "+countEmailBerhasil+
	    		"<br>Email gagal: "+countEmailGagal+
	    		"</div>";


	    		// show info run db and send email
	      		setTimeout (function() {
					infoEmail.hide();
				},1000);

				// show button and progres for running proses
	      		setTimeout (function() {
					collapseBtnProsesEmail.hide();
				},1000);


				setTimeout (function () {
					infoFinal.show();
				},2000)



	    	}

	    	// Jika return dari eksekusi = 1 maka jalankan yg lainnya
	    	// Saling tunggu
	    	// console.log (countEksekusi);
	    	

	    }
	  };
	  xhttp.open("GET", "email.php?data="+items+"&path="+path+"&time="+secondSleep, true);
	  xhttp.send();

}


nodeBtnProses.addEventListener ("click",function (){
	// console.log (savedList.values[0][2]);
	RunAllList(savedList,nodePdfPath);
	nodeBtnProses.disabled = true;
	nodeMuter.classList.remove ("d-none");
});

nodeBtnProsesDb.addEventListener ("click",function(){
	RunnAllListDb(savedList,nodePdfPath);
	nodeBtnProsesDb.disabled = true;
	nodeMuterDb.classList.remove ("d-none");
});

nodeBtnProsesEmail.addEventListener ("click",function(){
	runAllListEmail(savedList,nodePdfPath);
	nodeBtnProsesEmail.disabled = true;
	nodeMuterEmail.classList.remove ("d-none")
})

nodeBtnReUpload.addEventListener ("click",function () {
	window.location.replace("../");
});
nodeBtnProsesFinal.addEventListener ("click",function (){
	window.location.replace("../");
})