const videoBtn = document.querySelector('.video_btn');
const aboutBtn = document.querySelector('.about_btn');
const index = document.querySelector('.js-index');
const aboutIndex = document.querySelector('.js-index-about');
// console.log('hii');

videoBtn.addEventListener('click', () => {
	switchElement(aboutIndex, index, true);
});
aboutBtn.addEventListener('click', () => {
	switchElement(index, aboutIndex, false);
});

// obj for retriving data from db of users
const setUserName = document.querySelector('.username');
setUserName.innerHTML = localStorage.getItem('userName');
const userPosts = {
	index: document.querySelector('.index'),

	async fetchPostData() {
		console.log('hello');
		const data = {
			user: 'user',
			pass: 'pass'
		};

		await fetchData('./fetchUserPost.php', data)
			.then((data) => {
				for (let value of data) {
					console.log(data);
					let profileInfo = `
					    <div class="card">
					       
					        <div class="embed-responsive embed-responsive-21by9 video_container">
					            <iframe class="video" src="${value.content}" ></iframe>
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
			})
			.catch((err) => {
				console.log(err);
			});
	}
};

userPosts.fetchPostData();
