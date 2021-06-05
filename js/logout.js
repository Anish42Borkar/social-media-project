const logout = {
	logout: document.querySelector('.logout'),

	async sendData() {
		await fetchData('./api/logout.php', {})
			.then((response) => {
				if (response.message === 'Logout Successfull') {
					location.href = './login.php';
				} else {
					console.log('something went wrong');
				}
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};

logout.logout.addEventListener('click', () => {
	logout.sendData();
});
