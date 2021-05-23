// disabling upload btn when it is on same page
uploadBtn.classList.add('disable');
// preview parents
const previewVideoParent = document.querySelector('.upload-video');
const previewImageParent = document.querySelector('.upload-image');

const submitbtn = document.querySelector('.upload-btn');

// files parent
const thumnailFileParent = document.querySelector('.file-thumnail');
const videoFileParent = document.querySelector('.file-video');

// file names

const imageName = thumnailFileParent.querySelector('.file-name');
const videoName = videoFileParent.querySelector('.file-name');

// files
const previewImageFile = thumnailFileParent.querySelector('input[type=file]');
const previewVideoFile = videoFileParent.querySelector('input[type=file]');

// extenctions which are allowed

const allowedExtensionsImages = /(\.jpg|\.jpeg|\.png)$/i;
const allowedExtensionsVideos = /(\.mp4|\.mov|\.ogv|\.webm)$/i;

// to send files to server
const formData = new FormData();

function displayPreview(CheckExtenctions, previewParent, file, fileTitle, videoCheck, fileParent) {
	if (!CheckExtenctions.exec(file.value)) {
		alert('invalid file type');
		fileTitle.textContent = 'Invalid File Type';
		fileParent.classList.add('is-danger');
		fileParent.classList.remove('is-success');
		previewParent.classList.add('hide');

		if (videoCheck) pauseVid(previewParent.querySelector('.video-js'));
		return false;
	}
	console.log('check1');

	if (file.files.length > 0) {
		console.log('check');
		const reader = new FileReader();
		previewParent.classList.remove('hide');
		fileParent.classList.remove('is-danger');
		fileParent.classList.add('is-success');

		fileTitle.textContent = file.files[0].name;
		reader.addEventListener('load', (event) => {
			const fileContent = event.target.result;
			if (videoCheck) {
				previewParent.innerHTML = videoPlayer(fileContent);
				formData.append('fileVideo', file.files[0]);
			} else {
				previewParent.innerHTML = `<img class = "image-preview" alt="" src = "${fileContent}" >`;
				formData.append('fileImage', file.files[0]);
			}
		});

		reader.readAsDataURL(file.files[0]);

		// fetchData('./api/upload.php', formData, true, formData)
		// 	.then((response) => {
		// 		console.log(response);
		// 	})
		// 	.catch(console.error);
		// fetch('./api/upload.php', {
		// 	method: 'post',
		// 	body: formData
		// }).catch(console.error);
	}
}

function pauseVid(video) {
	if (video === null) return false;
	console.log('paused');
	video.pause();
}

previewImageFile.addEventListener('change', () => {
	displayPreview(allowedExtensionsImages, previewImageParent, previewImageFile, imageName, false, thumnailFileParent);
});

previewVideoFile.addEventListener('change', () => {
	displayPreview(allowedExtensionsVideos, previewVideoParent, previewVideoFile, videoName, true, videoFileParent);
});

submitbtn.addEventListener('click', () => {
	if (!(previewImageFile.files.length > 0 && previewVideoFile.files.length > 0)) {
		swal('Error!', 'You need to select both file!', 'error');
		return false;
	}
	fetch('./api/upload.php', {
		method: 'post',
		body: formData
	})
		.then((response) => {
			swal('Good job!', 'You clicked the button!', 'success');
		})
		.catch(console.error);
});
