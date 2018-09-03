slide();


	var allPost = document.querySelectorAll(".post-content");

	for (var i = 0; i < allPost.length ; i++) {

		var suppBtn = allPost[i].querySelector(".delete-post");
		var postBox = allPost[i].querySelector(".postBox");
		suppBtn.style.display = 'none';


		postBox.addEventListener("mouseover", function(e) {
			suppBtn.style.display = 'inline'
		});

		postBox.addEventListener("mouseout", function(e) {
			suppBtn.style.display = 'none'
		});

}