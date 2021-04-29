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
		console.log(response);
		wrapper.innerHTML = '';
		if (response.message === 'NO RECORDS FOUND') {
			dropdown.classList.add('is-active');
			const message = document.createElement('a');
			message.innerHTML = response.message;
			wrapper.append(message);
		}

		if (response.message === 'Records Found') {
			dropdown.classList.add('is-active');
			const data = response.body;
			console.log(data);
			for (let item of data) {
				const option = document.createElement('a');
				option.classList.add('dropdown-item');
				option.innerHTML = item;
				wrapper.append(option);
			}
		}
	};

	search.addEventListener('input', debounce(onInput));

	document.addEventListener('click', (event) => {
		if (!event.target.contains(root) && !event.target.contains(search)) {
			dropdown.classList.remove('is-active');
		}

		console.log(event.target);
	});
};
