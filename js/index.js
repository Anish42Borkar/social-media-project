const timelinePost = {
	index: document.querySelector('.timeline'),

	async fetchPostData() {
		await fetchData('./api/profile.php', {})
			.then((data) => {
				let response = data[0];
				console.log(response);

				if (response.message === 'No Session is Set') {
					location.href = './login.html';
				} else if (response.message === 'Invalid Method') {
					alert('Invalid method of sending data to server');
				} else if (response.message === 'No Record Found') {
					console.log('you have no post to show');
				} else if (response.message === 'Record Found') {
					for (let value of response.body) {
						// console.log(data);
						let profileInfo = `
							<div class="card">

								<div class="embed-responsive embed-responsive-21by9 video_container">
									<iframe class="video" src="${value.post}" ></iframe>
								</div>

								<div class="card-body">

									<h5 class="card-title">poste title</h5>
									<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

									<div class="card_footer">
										<span class="post_icon"><i class="far fa-heart fa-2x"></i></span>
										<span class="post_icon"><i class="fab fa-telegram-plane fa-2x"></i></span>
										<span class="post_icon"><i class="far fa-comment fa-2x"></i></span>
									</div>

								</div>

							</div>
						`;

						this.index.innerHTML += profileInfo;
					}
				} else {
					console.log('somet');
					alert('something went wrong');
				}

				// console.log('heee3', dataObj);
			})
			.catch((err) => {
				console.log(err.message);
			});
	}
};

timelinePost.fetchPostData();
