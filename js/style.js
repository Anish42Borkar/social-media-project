const crossIcon = _target('.user_cross_icon');
const userIcon = _target('.user_icon');
const hamberger = _target('.js-list');
userIcon.addEventListener('click', () => {
	// dropdown.classList.add('show');
	hamberger.classList.toggle('hide');
	userIcon.classList.toggle('hide');
	crossIcon.classList.toggle('hide');
});

crossIcon.addEventListener('click', () => {
	// dropdown.classList.add('show');
	hamberger.classList.toggle('hide');
	userIcon.classList.toggle('hide');
	crossIcon.classList.toggle('hide');
});

//autocomplete dropdown list code

const root = _target('.autocomplete');

// this is for sending request for search

const search = _target('.search');

autoComplete({
	search,
	root,
	fetchData
});

// upload button code

_target('.upload-icon').addEventListener('click', () => {
	location.href = './upload.php';
});
