// this code is use to toggle the dialog box appear when the user clicks on user icon
// const userIcon = document.querySelector('.user_icon');
// const dialogBox = document.querySelector('.box');

// userIcon.addEventListener('click', () => {
// 	console.log('hi');
// 	dialogBox.style.display = 'flex';
// });

// document.addEventListener('click', (event) => {
// 	if (!dialogBox.contains(event.target)) {
// 		dialogBox.style.display = 'none';
// 	} else {
// 		console.log(false);
// 	}
// });

// trying

// document.addEventListener('click', (event) => {
// 	if (!dropdown.contains(event.target)) {
// 		dropdown.classList.remove('show');
// 		dropdown.classList.add('hide');
// 		console.log(document.contains(event.target) + ' hi');
// 	}
// 	// console.log(dropdown.contains(event.target));
// });
// obj for retriving data from db of users

const timelinePost = {
	index: document.querySelector('.timeline'),

	fetchPostData() {
		console.log('hello');
		const data = {
			user: 'user',
			pass: 'pass'
		};

		fetch('./fetchUserPost.php', data)
			.then((response) => {
				return response.json();
			})
			.then((data) => {
				let obj = data;
				for (let data of obj) {
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
			})
			.catch((err) => {
				console.log(err);
			});
	}
};

timelinePost.fetchPostData();
