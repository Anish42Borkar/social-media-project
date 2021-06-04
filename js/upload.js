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
		fileTitle.textContent = `${CheckExtenctions} are allowed`;
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

// variables to store text content

const postTitle = document.querySelector('.post_title');
const postDesc = document.querySelector('.post_desc');

function formValidate(form, name) {
	const sibbling = form.nextElementSibling;
	if (form.value === '') {
		form.classList.remove('is-warning');
		form.classList.remove('is-success');
		form.classList.add('is-danger');
		sibbling.classList.remove('hide');
		sibbling.value = 'Cannot be null';
	} else {
		form.classList.remove('is-warning');
		form.classList.remove('is-danger');
		form.classList.add('is-success');
		sibbling.classList.add('hide');
		formData.append(name, form.value);
	}
}

submitbtn.addEventListener('click', () => {
	formValidate(postTitle, 'postTitle');
	formValidate(postDesc, 'postDesc');
	if (
		!(
			previewImageFile.files.length > 0 &&
			previewVideoFile.files.length > 0 &&
			postTitle.value !== '' &&
			postDesc.value !== ''
		)
	) {
		swal('Error!', 'You need to select both the files and fill the form!', 'error');
		return false;
	}
	let object = {};
	formData.forEach(function(value, key) {
		object[key] = value;
	});
	// let json = JSON.stringify(object);
	console.log(object);
	fetch('./api/upload.php', {
		method: 'post',
		body: formData
	})
		.then((response) => {
			return response.json();
		})
		.then((response) => {
			console.log(response);
			swal('Good job!', 'You clicked the button!', 'success');
		})
		.catch(console.error);
});

// const sheet = new CSSStyleSheet();
// sheet.replaceSync('* {transition: all 2s}');
// document.adoptedStyleSheets = [sheet];

// const bd = document.body.children;
// const cn = document.querySelector('.container').children;
// const file = document.querySelector('.file').children;
// console.log(bd);
// console.log(cn);
// const allEls = [...bd,...cn,...file];
// setInterval(()=>{
//     for(let el of allEls){
//         const rotation = Math.floor(Math.random() * 360);
//         const x = Math.floor(document.body.clientWidth * Math.random());
//         const y = Math.floor(document.body.clientHeight * Math.random());
//         el.style.transform = `translate(${x}px,${y}px) rotate(${rotation}deg)`;
//     }
//     console.log("hi");
// },2000);
