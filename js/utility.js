const fetchData = async (pageName, object) => {
	const response = await fetch(pageName, {
		method: 'POST',
		body: JSON.stringify(object),
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
			return response[0];
		})
		.catch((err) => {
			console.log(err);
		});
	if (response.status === false) return response.message;
	return response.body[0];
};

const followCheck = async (userName, follower, following) => {
	const user = userName === 'currentUser' ? localStorage.getItem('currentUser') : localStorage.getItem('userName');
	const response = await checkFollowerFollowing({ userName: user });
	console.log('follow', response);
	follower.innerHTML = response.follower;
	following.innerHTML = response.following;
	console.log(localStorage.getItem('currentUser'), localStorage.getItem('userName'));
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
