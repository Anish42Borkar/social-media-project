const hideSelfLink = _target('.index-link-js');
hideSelfLink.classList.add('has-background-primary-light', 'disable');
const timelinePost = {
	index: _target('.timeline'),
	async fetchPostData() {
		await fetchData('./api/index.php', {})
			.then((response) => {
				console.log(response.body.post.length);

				minifyingResponseCode(false, this.index, response);

				if (!response.body.post.length) {
					let notification = `
						<div class="notification" style = "display:flex;justify-content:center;align-item:center;width:40rem;height:10rem;padding:2rem;position:absolute;top:0;right:0;left:0;bottom:0;margin:auto;background:transparent;">
							
							<strong style = "font-size:2rem;">Follow creators to view their post</strong>
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
timelinePost.fetchPostData();

window.addEventListener('load', () => {
	modal();
	cmt();
	likeEvent();
	likedCheck();
});
