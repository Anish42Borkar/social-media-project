switchElementOneFunction();

const hideSelfLink = document.querySelector('.profile-link-js');
hideSelfLink.classList.add('has-background-primary-light', 'disable');

// obj for retriving data from db of users

const userPosts = {
	index: document.querySelector('.index'),
	follower: document.querySelector('.followers-count'),
	following: document.querySelector('.following-count'),

	async fetchPostData() {
		await fetchData('./api/profile.php', {})
			.then((data) => {
				let response = data[0];
				console.log(response);

				if (response.message === 'No Session is Set') location.href = './login.html';
				else if (response.message === 'Invalid Method') alert('Invalid method of sending data to server');
				else if (response.message === 'No Record Found')
					followCheck('currentUser', this.follower, this.following);
				else if (response.message === 'Record Found')
					profilePost(this.index, response, 'currentUser', this.follower, this.following, true);
				else alert('something went wrong');
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};

userPosts.fetchPostData();
