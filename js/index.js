const hideSelfLink = document.querySelector('.index-link-js');
hideSelfLink.classList.add('has-background-primary-light', 'disable');
const timelinePost = {
	index: document.querySelector('.timeline'),
	async fetchPostData() {
		await fetchData('./api/index.php', {})
			.then((response) => {
				console.log(response);
				minifyingResponseCode(false, this.index, response);
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};
timelinePost.fetchPostData();
