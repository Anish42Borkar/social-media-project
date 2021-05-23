switchElementOneFunction();
// obj for retriving data from db of users
const setUserName = document.querySelector('.username');
setUserName.innerHTML = localStorage.getItem('userName');

const userPosts = {
	index: document.querySelector('.index'),
	follower: document.querySelector('.followers-count'),
	following: document.querySelector('.following-count'),
	follow: document.querySelector('.follow'),
	unfollow: document.querySelector('.unfollow'),

	async fetchPostData() {
		await fetchData('./api/profile.php', { userName: localStorage.getItem('userName') })
			.then((response) => {
				if (response.body.check) this.follow.style.display = 'none';
				else this.unfollow.style.display = 'none';

				minifyingResponseCode(true, this.index, response, 'differentUser', this.follower, this.following, true);
			})
			.catch(console.error);
	}
};
userPosts.fetchPostData();
