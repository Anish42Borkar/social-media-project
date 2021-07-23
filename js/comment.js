window.addEventListener('load', () => {
	loadComments();
	async function loadComments() {
		const data = {
			postId: localStorage.getItem('postId'),
			comment_load_data: true
		};
		let commentData;
		_target('.comment').innerHTML = '';
		await fetchData('./api/comment.php', data).then((response) => {
			console.log(response);
			if (!response.body) {
				return;
			}
			for (value of response.body) {
				commentData = `
					<div class = "card" style = "width:80%;">
						<div class = "card-content">
								<p><b>${value.user.name + ' ' + value.cmt.commented_on}</b></p>
								<p>${value.cmt.msg}</p>
						</div>
					</div>
				`;
				_target('.comment').innerHTML += commentData;
			}
		});
	}

	async function addComment() {
		let message = _target('.comment-box').value;
		if (message === '') {
			alert('please add comment');
			return;
		}
		const data = {
			postId: localStorage.getItem('postId'),
			add_comment: true,
			msg: message
		};

		await fetchData('./api/comment.php', data).then((response) => {
			console.log(response);
			if (response.status) {
				loadComments();
				_target('.comment-box').value = '';
			}
		});
	}

	_target('.comment-btn').addEventListener('click', addComment);
});
