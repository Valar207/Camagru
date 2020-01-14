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
		canvas1.drawImage(vivi, 0,0, 800, 480);
		var base64=document.getElementById('cvs').toDataURL("image/*");	//l'image au format base 64
		document.getElementById('tar').value='';
		document.getElementById('tar').value=base64;
	}