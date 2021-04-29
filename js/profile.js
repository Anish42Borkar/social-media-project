const videoBtn = document.querySelector('.video_btn');
const aboutBtn = document.querySelector('.about_btn');
const index = document.querySelector('.index');
const aboutIndex = document.querySelector('.index-about');
// console.log('hii');

videoBtn.addEventListener('click', () => {
	index.classList.remove('hide');
	aboutIndex.classList.add('hide');
	// index.classList.remove('show');
	aboutIndex.classList.remove('show');
});

aboutBtn.addEventListener('click', () => {
	aboutIndex.classList.add('show');
	aboutIndex.classList.remove('hide');
	index.classList.add('hide');
	index.classList.remove('show');
});

// obj for retriving data from db of users

const userPosts = {
	index: document.querySelector('.index'),

	fetchPostData() {
		console.log('hello');
		const data = {
			user: 'user',
			pass: 'pass'
		};

		fetch('./fetchUserPost.php', {
			method: 'post',
			body: JSON.stringify(data),
			headers: {
				'content-Type': 'application/json'
			}
		})
			.then((response) => {
				// console.log(response);
				return response.text();
			})
			.then((data) => {
				let dataObj = JSON.parse(data);

				for (data of dataObj) {
					console.log(data);
					console.log(data.content);
					let profileInfo = `
					    <div class="card">
					       
					        <div class="embed-responsive embed-responsive-21by9 video_container">
					            <iframe class="video" src="${data.content}" ></iframe>
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
				this.refeshCode();
			})
			.catch((err) => {
				console.log(err);
			});
	}
};

userPosts.fetchPostData();
