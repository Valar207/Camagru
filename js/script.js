function OpenCam() {
	navigator.mediaDevices.getUserMedia({ audio: false, video: { width: 800, height: 480 } }).then(function(mediaStream) {
		var video = document.getElementById('sourcevid');
		video.srcObject = mediaStream;
		video.onloadedmetadata = function(e) {
			video.play();
		};
	}).catch(function(err) { console.log(err.name + ": " + err.message); });
}
function capture(){
	var vivi = document.getElementById('sourcevid');
	var canvas1 = document.getElementById('cvs').getContext('2d');
	canvas1.drawImage(vivi, -160,0, 800, 480);
	var base64=document.getElementById('cvs').toDataURL("image/*");	//l'image au format base 64
	document.getElementById('tar').value='';
	document.getElementById('tar').value=base64;
}

//get modal elem
var modal = document.getElementById('simplemodal');
//get open modal button
var modalbtn = document.getElementById('modalbtn');
//get close btn
var closebtn = document.getElementsByClassName('closebtn')[0];
//listen open click
modalbtn.addEventListener('click', openmodal);
//listen close click
closebtn.addEventListener('click', closemodal);

//function open modal
function openmodal(){
	modal.style.display = 'block';
}

//function close modal
function closemodal(){
	modal.style.display = 'none';
}