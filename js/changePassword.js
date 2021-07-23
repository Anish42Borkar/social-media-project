const currentPassword = _target('.currentPassword');
const newPassword = _target('.newPassword');
const confirmPassword = _target('.confirmPassword');
const changePassBtn = _target('.changePassBtn');

function checkBlank(form) {
	if (form.value === '') {
		form.classList.remove('is-warning');
		form.classList.remove('is-success');
		form.classList.add('is-danger');
		// sibbling.classList.remove('hide');
		// sibbling.innerHtml = 'Cannot be null';
		swal('Error', 'Fildes cannot be blank', 'error');
		return false;
	} else {
		form.classList.remove('is-warning');
		form.classList.remove('is-danger');
		form.classList.add('is-success');
		// sibbling.classList.add('hide');
		// formData.append(name, form.value);
		return true;
	}
}

function comparePassword(newPass, comPass) {
	let form = comPass;
	if (newPass.value !== comPass.value || newPass.value === '') {
		form.classList.remove('is-warning');
		form.classList.remove('is-success');
		form.classList.add('is-danger');
		// sibbling.classList.remove('hide');
		// sibbling.innerHtml = 'Cannot be null';
		swal('Error', 'comfirm password does not match', 'error');
		return false;
	} else {
		form.classList.remove('is-warning');
		form.classList.remove('is-danger');
		form.classList.add('is-success');
		// sibbling.classList.add('hide');
		// formData.append(name, form.value);
		return true;
	}
}

changePassBtn.addEventListener('click', () => {
	let currPass = checkBlank(currentPassword),
		newPass = checkBlank(newPassword),
		comPass = checkBlank(confirmPassword);
	console.log(currentPassword.value, newPassword.value);
	if (currPass && newPass && comPass) {
		if (comparePassword(newPassword, confirmPassword)) {
			let cP = currentPassword.value;
			let nP = newPassword.value;
			const data = {
				currentPassword: cP,
				newPassword: nP
			};
			fetchData('./api/changePassword.php', data).then((response) => {
				swal(`${response.message}`);
			});
		}
	}
});
