const fetchData = async (pageName, object) => {
	const response = await fetch(pageName, {
		method: 'post',
		body: JSON.stringify(object),
		headers: {
			'content-Type': 'application/json'
		}
	})
		.then((response) => {
			return response.json();
		})
		.then((data) => {
			return data;
		});

	return response;
};

const debounce = (fun) => {
	let timeout = 0;
	return (...args) => {
		if (timeout) {
			clearTimeout(timeout);
		}
		timeout = setTimeout(() => {
			fun.apply(null, args);
		}, 1000);
	};
};
