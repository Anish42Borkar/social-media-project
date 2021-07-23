const hideSelfLink = _target('.setting-link-js');
hideSelfLink.classList.add('has-background-primary-light', 'disable');

let profileCheck = false,
	coverCheck = false,
	descriptionCheck = false;
// extenctions which are allowed
const allowedExtensionsImages = /(\.jpg|\.jpeg|\.png)$/i;

// parent file container
const parentFileProfile = _target('.wrapper1');
const parentFileCover = _target('.wrapper2');

// files
const file = document.querySelectorAll('.my_file');
const profile = file[0];
const cover = file[1];

// to send files to server
const formData = new FormData();

function displayPreview(CheckExtenctions, previewParent, file, type) {
	if (!CheckExtenctions.exec(file.value)) {
		alert('invalid file type only: jpg, .jpeg, .png ');
		return false;
	}
	console.log('check1');

	if (file.files.length > 0) {
		console.log('check');
		const reader = new FileReader();

		reader.addEventListener('load', (event) => {
			const fileContent = event.target.result;
			console.log(file);
			previewParent.children[0].setAttribute('src', fileContent);
			if (type === 'profile') formData.append('file', file.files[0]);
			formData.append('cover', file.files[0]);
		});

		reader.readAsDataURL(file.files[0]);
	}
}
profile.addEventListener('change', () => {
	profileCheck = true;
	displayPreview(allowedExtensionsImages, parentFileProfile, profile, 'profile');
});

cover.addEventListener('change', () => {
	coverCheck = true;
	displayPreview(allowedExtensionsImages, parentFileCover, cover, 'cover');
});

const desc = _target('.textarea');

desc.addEventListener('change', () => {
	descriptionCheck = true;
});

function formDesc(form, name) {
	formData.append(name, form.value);
}

const submitbtn = _target('.save');

submitbtn.addEventListener('click', () => {
	formDesc(desc, 'description');
	formData.append('profileCheck', profileCheck);
	formData.append('coverCheck', coverCheck);
	formData.append('descriptionCheck', descriptionCheck);

	console.log('submited');
	const modal = _target('.modal');
	modal.classList.add('is-active');
	uploadFile(formData, './api/settings.php');
	// fetch('./api/upload.php', {
	// 	method: 'post',
	// 	body: formData
	// })
	// 	.then((response) => {
	// 		return response.json();
	// 	})
	// 	.then((response) => {
	// 		console.log(response);
	// 		swal('Good job!', 'You clicked the button!', 'success');
	// 	})
	// 	.catch(console.error);
});
