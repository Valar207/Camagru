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

var modal = document.getElementById('mymodal');
var modalImg = document.getElementById("imgmodal");
var closebtn = modal.querySelector(".closebtn");
var images = document.querySelectorAll(".modalimg");
var idc = document.getElementById('idc');
var valimg = document.getElementById('valimg');

closebtn.addEventListener('click', closemodal);
window.onclick = function(event) {
    if (event.target == modal)
        modal.style.display = "none";
}
    for (i = 0; i < images.length; i++) 
        images[i].addEventListener("click", openmodal);
    function openmodal()
    {
        modal.style.display = 'block';
        modalImg.src = this.src;
        modalImg.alt = this.alt;
        valimg.value = this.alt;
        var id_img = document.getElementById('imgmodal').alt;
        console.log(id_img);
    }
    function closemodal()
    {
        modal.style.display = 'none';
    }

