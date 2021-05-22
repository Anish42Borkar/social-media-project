//this is to login user
const login = {
	btnLogin: document.querySelector('.login'),
	userNameLogin: document.querySelector('.userName_login'),
	passLogin: document.querySelector('.pass_login'),
	outputMsg: document.querySelector('.out_msg'),

	async sendData() {
		// const { userNameLogin, passLogin } = this;

		const user = this.userNameLogin.value;
		const pass = this.passLogin.value;

		const data = {
			user,
			pass
		};

		await fetchData('./api/login.php', data)
			.then((response) => {
				try {
					console.log(response);
					this.outputMsg.innerText = response.message;
					if (response.message === 'login success') {
						localStorage.setItem('currentUser', this.userNameLogin.value);
						location.href = './index.php';
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
	btnCreateUser: document.querySelector('.userRegistration'),
	userName: document.querySelector('.userName_signup'),
	userPhone: document.querySelector('.userPhone_signup'),
	userDOB: document.querySelector('.userDate_signup'),
	userPass: document.querySelector('.pass_signup'),
	userEmail: document.querySelector('.email_signup'),
	outputMsg: document.querySelector('.out_msg'),

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

		if (!checkNull(user, pass, phone, DOB, email)) {
			this.outputMsg.innerText = 'All fields are required';
			return;
		}

		await fetchData('./api/register.php', data)
			.then((response) => {
				this.outputMsg.innerText = response.message;
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
