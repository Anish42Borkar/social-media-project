const signUpButton = _target('#signUp');
const signInButton = _target('#signIn');
const container = _target('#container');

signUpButton.addEventListener('click', () => {
	container.classList.add('right-panel-active');
});

signInButton.addEventListener('click', () => {
	container.classList.remove('right-panel-active');
});

//this is to login user
const login = {
	btnLogin: _target('.login'),
	userNameLogin: _target('.userName_login'),
	passLogin: _target('.pass_login'),
	// outputMsg: document.querySelector('.out_msg'),

	async sendData() {
		// const { userNameLogin, passLogin } = this;

		const user = this.userNameLogin.value;
		const pass = this.passLogin.value;

		const data = {
			user,
			pass
		};
		console.log(data);
		await fetchData('./api/login.php', data)
			.then((response) => {
				try {
					console.log(response);

					if (response.message === 'login success') {
						localStorage.setItem('currentUser', this.userNameLogin.value);
						swal('login successful').then((value) => {
							location.href = './index.php';
						});
					} else {
						swal('You have entered wrong user name or password');
					}
				} catch (error) {
					console.log(error);
				}
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};

login.btnLogin.addEventListener('click', (event) => {
	event.preventDefault();
	login.sendData();
});

//this for sending user information to register in the database
const userRegisteration = {
	btnCreateUser: _target('.userRegistration'),
	userName: _target('.userName_signup'),
	userPhone: _target('.userPhone_signup'),
	userDOB: _target('.userDate_signup'),
	userPass: _target('.pass_signup'),
	userEmail: _target('.email_signup'),
	// outputMsg: document.querySelector('.out_msg'),

	async sendData() {
		const { userName, userPhone, userDOB, userPass, userEmail } = this;

		const user = userName.value;
		const pass = userPass.value;
		const phone = userPhone.value;
		const DOB = userDOB.value;
		const email = userEmail.value;

		const data = {
			user,
			pass,
			phone,
			DOB,
			email
		};
		console.log(data);
		if (!checkNull(user, pass, phone, DOB, email)) {
			swal('All the feilds are important please fill.');
			return;
		}

		await fetchData('./api/register.php', data)
			.then((response) => {
				if (response.message === 'Registered Success')
					swal('You have successfully registered').then((value) => {
						location.href = './login.php';
					});
			})
			.catch((err) => {
				console.log(err);
			});
	}
};
userRegisteration.btnCreateUser.addEventListener('click', (event) => {
	event.preventDefault();
	userRegisteration.sendData();
});

function checkNull(...args) {
	for (let value of args) if (!value) return false;
	return true;
}
