switchElementOneFunction();

const hideSelfLink = document.querySelector('.profile-link-js');
hideSelfLink.classList.add('has-background-primary-light', 'disable');

// obj for retriving data from db of users

const userPosts = {
	index: _target('.index'),
	follower: _target('.followers-count'),
	following: _target('.following-count'),

	async fetchPostData() {
		await fetchData('./api/profile.php', { userName: localStorage.getItem('currentUser') })
			.then((response) => {
				minifyingResponseCode(true, this.index, response, 'currentUser', this.follower, this.following, true);
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};

userPosts.fetchPostData();
