switchElementOneFunction();

// obj for retriving data from db of users
const setUserName = document.querySelector('.username');
setUserName.innerHTML = localStorage.getItem('userName');

const userPosts = {
	index: document.querySelector('.index'),
	follower: document.querySelector('.followers-count'),
	following: document.querySelector('.following-count'),

	async fetchPostData() {
		await fetchData('./api/profile.php', { userName: localStorage.getItem('userName') })
			.then((data) => {
				let response = data[0];
				console.log(response);

				if (response.message === 'No Session is Set') location.href = './login.html';
				else if (response.message === 'Invalid Method') alert('Invalid method of sending data to server');
				else if (response.message === 'No Record Found')
					followCheck('differentUser', this.follower, this.following);
				else if (response.message === 'Record Found')
					profilePost(this.index, response, 'differentUser', this.follower, this.following, true);
				else alert('something went wrong');
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};

userPosts.fetchPostData();
