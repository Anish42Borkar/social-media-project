//this is to login user
const login = {
	btnLogin: document.querySelector('.login'),
	userNameLogin: document.querySelector('.userName_login'),
	passLogin: document.querySelector('.pass_login'),
	outputMsg: document.querySelector('.out_msg'),

	sendData() {
		const { userNameLogin, passLogin } = this;

		const user = userNameLogin.value;
		const pass = passLogin.value;

		const data = {
			user,
			pass
		};

		fetch('./api/login.php', {
			method: 'post',
			body: JSON.stringify(data),
			headers: {
				'content-Type': 'application/json'
			}
		})
			.then((response) => {
				// console.log(response);
				return response.json();
			})
			.then((data) => {
				console.log(data);
				this.outputMsg.innerText = data[0].message;
				location.href = './index.html';
				// location.href = './profile.html';
			})
			.catch((err) => {
				console.log(err);
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

	sendData() {
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

		fetch('./api/register.php', {
			method: 'post',
			body: JSON.stringify(data),
			headers: {
				'content-Type': 'application/json'
			}
		})
			.then((response) => {
				// console.log(response);
				return response.text();
			})
			.then((data) => {
				console.log(data);

				this.outputMsg.innerText = data;
				// location.href = './profile.html';
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
