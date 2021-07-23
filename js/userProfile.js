switchElementOneFunction();
// obj for retriving data from db of users
const setUserName = _target('.username');
setUserName.innerHTML = localStorage.getItem('userName');

const userPosts = {
	index: _target('.index'),
	follower: _target('.followers-count'),
	following: _target('.following-count'),
	follow: _target('.follow'),
	unfollow: _target('.unfollow'),

	async fetchPostData() {
		await fetchData('./api/profile.php', { userName: localStorage.getItem('userName') })
			.then((response) => {
				console.log(response.body.post.length);
				if (response.body.check) this.follow.style.display = 'none';
				else this.unfollow.style.display = 'none';

				minifyingResponseCode(true, this.index, response, 'differentUser', this.follower, this.following, true);
				if (!response.body.post.length) {
					console.log(response.body.post.length);
					let notification = `
						<div class="notification" style = "display:flex;justify-content:center;align-item:center;width:40rem;height:10rem;padding:2rem;position:absolute;top:20rem;right:0;left:0;bottom:0;margin:auto;background:transparent;">

							<strong style = "font-size:2rem;">No Post Uploaded</strong>
						</div>
					`;
					this.index.innerHTML = notification;
				}
			})
			.catch(console.error);
	}
};
userPosts.fetchPostData();

const follow = document.querySelector('.follow');
const unfollow = document.querySelector('.unfollow');

follow.addEventListener('click', () => {
	followUnfollow();
});

unfollow.addEventListener('click', () => {
	followUnfollow();
});

async function followUnfollow() {
	console.log('outside');
	await fetchData('./api/followUnfollowButton.php', { userName: localStorage.getItem('userName') })
		.then((response) => {
			console.log(response);
			if (response.message === 'unfollow successful') {
				follow.style.display = 'block';
				unfollow.style.display = 'none';
			} else if (response.message === 'follow successful') {
				follow.style.display = 'none';
				unfollow.style.display = 'block';
			}
		})
		.catch(console.error);
}

window.addEventListener('load', () => {
	modal();
	cmt();
	likeEvent();
});
