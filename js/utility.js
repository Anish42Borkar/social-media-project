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
