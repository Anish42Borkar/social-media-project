const hideSelfLink = document.querySelector('.index-link-js');
hideSelfLink.classList.add('has-background-primary-light', 'disable');
const timelinePost = {
	index: document.querySelector('.timeline'),
	async fetchPostData() {
		await fetchData('./api/index.php', {})
			.then((data) => {
				let response = data[0];
				if (response.message === 'No Session is Set') location.href = './login.html';
				else if (response.message === 'Invalid Method') alert('Invalid method of sending data to server');
				else if (response.message === 'No Record Found')
					followCheck('currentUser', this.follower, this.following);
				else if (response.message === 'Record Found') profilePost(index, response);
				else alert('something went wrong');
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};
timelinePost.fetchPostData();
