slide();


	var allPost = document.querySelectorAll(".post-content");

	for (var i = 0; i < allPost.length ; i++) {


		var postBox = allPost[i].querySelector(".postBox");

		allPost[i].querySelector(".action-post").style.display = 'none';

		postBox.addEventListener("mouseover", function(e) {
			this.querySelector(".action-post").style.display = 'inline';
		});

		postBox.addEventListener("mouseout", function(e) {
			this.querySelector(".action-post").style.display = 'none';
		});


		var height = allPost[i].querySelector(".postBox").offsetHeight;
		allPost[i].querySelector(".comment-content").style.height = height;

		var scroler = allPost[i].querySelector(".comment-text");
		scroler.scrollTop = scroler.scrollHeight;

}