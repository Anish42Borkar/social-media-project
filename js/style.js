const crossIcon = document.querySelector('.user_cross_icon');
const userIcon = document.querySelector('.user_icon');
const hamberger = document.querySelector('.js-list');
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

const testObj = [ 'anish', 'damodar', 'reminson', 'simplico', 'jester', 'anish' ];

const root = document.querySelector('.autocomplete');

// this is for sending request for search

const search = document.querySelector('.search');

autoComplete({
	search,
	root,
	fetchData
});
