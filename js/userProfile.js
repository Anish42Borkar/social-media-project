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
				minifyingResponseCode(true, this.index, response, 'differentUser', this.follower, this.following, true);
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};

userPosts.fetchPostData();
