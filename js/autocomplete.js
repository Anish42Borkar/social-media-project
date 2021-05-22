const autoComplete = ({ search, root, fetchData }) => {
	root.innerHTML = `
        <div class="dropdown result" >
            <div class="dropdown-menu">
                <div class="dropdown-content wrapper">
                    
                </div>
            </div>
        </div>
    `;

	const dropdown = root.querySelector('.dropdown');
	const wrapper = root.querySelector('.wrapper');

	const onInput = async (event) => {
		const response = await fetchData('./api/search.php', { searchTerm: event.target.value });
		console.log(response.message);
		console.log(response);
		wrapper.innerHTML = '';

		if (response.message === 'No Value Pass') {
			dropdown.classList.remove('is-active');
		}

		if (response.message === 'NO RECORDS FOUND') {
			dropdown.classList.add('is-active');
			const message = document.createElement('a');
			message.innerHTML = response.message;
			wrapper.append(message);
		}

		if (response.message === 'Record Found') {
			dropdown.classList.add('is-active');
			// const data = response.body;
			console.log(response.body.userNames);

			for (let item of response.body.userNames) {
				const option = document.createElement('a');
				option.classList.add('dropdown-item');

				option.addEventListener('click', (event) => {
					dropdown.classList.remove('is-active');
					search.value = item;
					localStorage.setItem('userName', item);
					location.href = './userProfile.php';
					search.value = '';
				});

				option.innerHTML = item;
				wrapper.append(option);
			}
		}
	};

	search.addEventListener('input', debounce(onInput, 500));

	document.addEventListener('click', (event) => {
		if (!event.target.contains(root) && !event.target.contains(search)) {
			dropdown.classList.remove('is-active');
		}

		console.log(event.target);
	});
};
