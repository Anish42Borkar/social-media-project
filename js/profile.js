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
				console.log(response.body.post);

				minifyingResponseCode(true, this.index, response, 'currentUser', this.follower, this.following, true);
				if (!response.body.post.length) {
					let notification = `
						<div class="notification" style = "display:flex;justify-content:center;align-item:center;width:40rem;height:10rem;padding:2rem;position:absolute;top:20rem;right:0;left:0;bottom:0;margin:auto;background:transparent;">
								
							<strong style = "font-size:2rem;">Dont Have Any Post To Show You</strong>
						</div>
					`;
					this.index.innerHTML = notification;
				}
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};

userPosts.fetchPostData();

window.addEventListener('load', () => {
	modal();
});
