const fetchData = async (pageName, object, ...rest) => {
	const response = await fetch(pageName, {
		method: 'POST',
		body: rest[0] ? rest[1] : JSON.stringify(object),
		headers: {
			'content-Type': 'application/json'
		}
	}).then((response) => {
		console.log(response);
		return response.json();
	});

	return response;
};

const checkFollowerFollowing = async (userName) => {
	const response = await fetchData('./api/follow.php', userName)
		.then((response) => {
			console.log(response);
			return response;
		})
		.catch((err) => {
			console.log(err);
		});
	if (response.status === false) return response.message;
	return response.body;
};

const followCheck = async (userName, follower, following) => {
	const user = userName === 'currentUser' ? localStorage.getItem('currentUser') : localStorage.getItem('userName');
	const response = await checkFollowerFollowing({ userName: user });
	console.log('follow', response);
	follower.innerHTML = response.follower;
	following.innerHTML = response.following;
	console.log(localStorage.getItem('currentUser'), localStorage.getItem('userName'));
};

const profilePost = (root, response, ...rest) => {
	// user, follower, following, followCheckRequest
	if (rest[3]) {
		followCheck(rest[0], rest[1], rest[2]);
		const username = _target('.username');
		username.innerText = response.body.name;
	}

	if (response.body.post == '') return false;

	for (let value of response.body.post) {
		console.log(value);
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

		root.innerHTML += profileInfo;
	}
};

const debounce = (fun, delay) => {
	let timeout = 0;
	return (...args) => {
		if (timeout) {
			clearTimeout(timeout);
		}
		timeout = setTimeout(() => {
			fun.apply(null, args);
		}, delay);
	};
};

const switchElement = (hide, show, bool) => {
	if (bool) {
		show.classList.remove('hide');
		hide.classList.add('hide');
		// index.classList.remove('show');
		hide.classList.remove('show');
	} else {
		show.classList.add('show');
		show.classList.remove('hide');
		hide.classList.add('hide');
		// index.classList.remove('show');
	}
};

// used for switching the element between video and about
const switchElementOneFunction = () => {
	const videoBtn = _target('.video_btn');
	const aboutBtn = _target('.about_btn');
	const index = _target('.js-index');
	const aboutIndex = _target('.js-index-about');

	videoBtn.addEventListener('click', () => {
		switchElement(aboutIndex, index, true);
	});
	aboutBtn.addEventListener('click', () => {
		switchElement(index, aboutIndex, false);
	});
};

const minifyingResponseCode = (followCountRequire, root, response, ...rest) => {
	// 'currentUser', this.follower, this.following, true
	if (response.message === 'No Session is Set') location.href = './login.html';
	else if (response.message === 'Invalid Method') alert('Invalid method of sending data to server');
	else if (response.message === 'Record Found' || response.message === 'No Record Found')
		profilePost(root, response, rest[0], rest[1], rest[2], rest[3]);
	else alert('something went wrong');
};

const videoPlayer = (link) => {
	return `<video src="${link}" id = "my-video" class = "video-js"  controls></video>`;
};

function _target(target) {
	return document.querySelector(target);
}
