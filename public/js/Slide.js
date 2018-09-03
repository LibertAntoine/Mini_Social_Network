



function slide() {


var allPost = document.querySelectorAll(".post-content");

	for (var i = 0; i < allPost.length ; i++) {

		var slider = allPost[i].querySelector(".slide");
		var commentBox = allPost[i].querySelector(".comment-content");

		slider.addEventListener("mouseover", function(e) {
			postBox = this.parentNode;
			postBox.classList.add("right");
			commentBox = postBox.parentNode.parentNode.querySelector(".comment-content");
			commentBox.classList.add("left");
		})


		commentBox.addEventListener("mouseover", function(e) {
			this.classList.add("left");
			postBox = this.parentNode.querySelector(".postBox");
			postBox.classList.add("right");
		})


		slider.addEventListener("mouseout", function(e) {
			postBox = this.parentNode;
			postBox.classList.remove("right");
			commentBox = postBox.parentNode.parentNode.querySelector(".comment-content");
			commentBox.classList.remove("left");

		})

		commentBox.addEventListener("mouseout", function(e) {
			this.classList.remove("left");
			postBox = this.parentNode.querySelector(".postBox");
			postBox.classList.remove("right");
		})
	}
}