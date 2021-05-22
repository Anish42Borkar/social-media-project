const hideSelfLink = document.querySelector('.index-link-js');
hideSelfLink.classList.add('has-background-primary-light', 'disable');
const timelinePost = {
	index: document.querySelector('.timeline'),
	async fetchPostData() {
		await fetchData('./api/index.php', {})
			.then((response) => {
				try {
					console.log(response);
					minifyingResponseCode(false, this.index, response);
				} catch (error) {
					console.log(error.message);
				}
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};
timelinePost.fetchPostData();
