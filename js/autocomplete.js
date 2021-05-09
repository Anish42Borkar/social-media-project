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
		console.log(response[0].message);
		wrapper.innerHTML = '';

		if (response[0].message === 'No Value Pass') {
			dropdown.classList.remove('is-active');
		}

		if (response[0].message === 'NO RECORDS FOUND') {
			dropdown.classList.add('is-active');
			const message = document.createElement('a');
			message.innerHTML = response.message;
			wrapper.append(message);
		}

		if (response[0].message === 'Record Found') {
			dropdown.classList.add('is-active');
			const data = response[0].body;
			console.log(data);

			for (let item of data) {
				const option = document.createElement('a');
				option.classList.add('dropdown-item');

				option.addEventListener('click', (event) => {
					dropdown.classList.remove('is-active');
					search.value = item;
					localStorage.setItem('userName', item);
					location.href = './userProfile.html';
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
