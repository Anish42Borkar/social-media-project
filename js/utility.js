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

	if (!response.body.post.length) return false;

	for (let value of response.body.post) {
		console.log(value);
		let profileInfo = `
			<div class="card">

				<div class="embed-responsive embed-responsive-21by9 video_container">
					<div class="card-image">
						<figure class="image is-4by3">
							<img src="${value.thumnail}" alt="Placeholder image">
						</figure>
						<div class = "over_lay" data-post-path = ${value.post}></div>
					</div>
				</div>

				<div class="card-body">

					<h5 class="card-title">${value.title}</h5>
					<p class="card-text">${value.desc}</p>

					<div class="card_footer">
						<span class="post_icon post_like"><i class="far fa-heart fa-2x"></i></span>
						<span class="post_icon post_share"><i class="fab fa-telegram-plane fa-2x"></i></span>
						<span class="post_icon post_comment" data-post-id = ${value.pId} ><i class="far fa-comment fa-2x"></i></span>
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
	return `<video controls width="100%" height = "100%" class="video" src="${link}" ></video>`;
};

function _target(target) {
	return document.querySelector(target);
}

function modalControl(link) {
	const modal = _target('.modal');
	modal.classList.add('is-active');
	const content = modal.children[1].children[0].children[0];
	console.log(content);
	content.setAttribute('src', `${link}`);
}

function pauseVid(videoP) {
	try {
		videoP.pause();
		return true;
	} catch (e) {
		return false;
	}
}

if (_target('.modal')) {
	_target('.modal-close').addEventListener('click', (e) => {
		const modalContent = _target('.modal-content');
		const content = modalContent.children[0].children[0];
		if (pauseVid(content)) {
		}
		if (_target('.progress')) {
			_target('.progress').value = 0;
			// _target('.modal-close').classList.add('hide');
		}
		_target('.modal').classList.remove('is-active');
		console.log('paused');
	});
} else {
	console.log('by');
}

// modal video player js function

function modal() {
	const player = document.querySelector('.player');
	const video = player.querySelector('.viewer');
	const progress = player.querySelector('.progress');
	const progressBar = player.querySelector('.progress__filled');
	const toggle = player.querySelector('.toggle');
	const skipButtons = player.querySelectorAll('[data-skip]');
	const ranges = player.querySelectorAll('.player__slider');
	const fullscreen = player.querySelector('.fullscreen');

	function togglePlay() {
		const method = video.paused ? 'play' : 'pause';
		video[method]();
	}

	function updateButton() {
		toggle.textContent = this.paused ? '►' : '❚ ❚';
	}

	function skip() {
		video.currentTime += parseFloat(this.dataset.skip);
	}

	function handleRangeUpdate() {
		video[this.name] = this.value;
	}

	function handleProgress() {
		const percent = video.currentTime / video.duration * 100;
		progressBar.style.flexBasis = `${percent}%`;
	}

	function scrub(e) {
		const scrubTime = e.offsetX / progress.offsetWidth * video.duration;
		video.currentTime = scrubTime;
	}

	function requestFullscreen() {
		video.requestFullscreen();
	}

	video.addEventListener('click', togglePlay);
	video.addEventListener('play', updateButton);
	video.addEventListener('pause', updateButton);
	video.addEventListener('timeupdate', handleProgress);
	toggle.addEventListener('click', togglePlay);
	skipButtons.forEach((button) => button.addEventListener('click', skip));
	ranges.forEach((range) => range.addEventListener('change', handleRangeUpdate));
	ranges.forEach((range) => range.addEventListener('mousemove', handleRangeUpdate));
	progress.addEventListener('click', scrub);

	let mousedown = false;

	progress.addEventListener('mousemove', (e) => mousedown && scrub(e));
	progress.addEventListener('mousedown', () => (mousedown = true));
	progress.addEventListener('mouseup', () => (mousedown = false));
	fullscreen.addEventListener('click', requestFullscreen);
}

window.addEventListener('load', () => {
	console.log('loaded');
	console.log(document.querySelector('.over_lay'));

	setTimeout(() => {
		if (_target('.over_lay')) {
			console.log(document.querySelector('.over_lay'));
			console.log('overlat');
			document.querySelectorAll('.over_lay').forEach((ele) => {
				ele.addEventListener('click', (e) => {
					console.log('overlay');
					modalControl(e.target.dataset.postPath);
				});
			});
		}
	}, 1000);
});

// Form Upload with process bar

function uploadFile(formData, path) {
	let ajex = new XMLHttpRequest();

	ajex.upload.addEventListener('progress', progressHandler, false);
	ajex.addEventListener('load', completeHandler, false);
	ajex.addEventListener('error', errorHandler, false);
	ajex.addEventListener('abort', abortHandler, false);
	ajex.open('POST', path);
	ajex.send(formData);
}

function progressHandler(event) {
	_target('.loaded_n_total').innerHTML = `Uploaded ${event.loaded} bytes of ${event.total}`;
	let percent = event.loaded / event.total * 100;
	_target('.progress').value = Math.round(percent);
	_target('.status').innerHTML = Math.round(percent) + '%Uploaded...please wait';
}

function completeHandler(event) {
	try {
		let json = JSON.parse(event.target.responseText);
		_target('.status').innerHTML = json.message;
		_target('.modal-close').classList.remove('hide');
		console.log(json);
	} catch (e) {
		_target('.status').innerHTML = 'Unexpected error occourred';
		_target('.modal-close').classList.remove('hide');
	}
}

function errorHandler(event) {
	_target('.modal-close').classList.remove('hide');
	_target('.status').innerHTML = 'Upload failed';
}

function abortHandler(event) {
	_target('.modal-close').classList.remove('hide');
	_target('.status').innerHTML = 'Upload aboded';
}

// footer
function footerFun(bool) {
	if (bool) _target('.foot').style.position = 'relative';
	else _target('.foot').style.position = 'absolute';
}

function cmt() {
	setTimeout(() => {
		const comments = document.querySelectorAll('.post_comment');
		comments.forEach((item) =>
			item.addEventListener('click', () => {
				console.log(item.dataset);
				localStorage.setItem('postId', item.dataset.postId);
				console.log('cmt', localStorage.getItem('postId'));
				location.href = './comment.php';
			})
		);
	}, 1000);
}
