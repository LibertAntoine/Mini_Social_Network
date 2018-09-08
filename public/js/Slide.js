




function Slide(el) {

		this.element = el

		this.activeSlide = function() {
							if(window.innerWidth > 1040) {
				var groupSpace = 447;
			} else if (window.innerWidth > 770) {
				var groupSpace = 267;
			} else {
				var groupSpace = 87;
			}
				var postBox = this.element.querySelector(".postBox")
				var commentBox = this.element.querySelector(".comment-content");
				slide = this.element.querySelector(".slide");
				postBox.classList.add("right");
				commentBox.classList.add("left");
				slide.classList.add("actif");
				widthPost = window.innerWidth - (groupSpace + 265)
				jQuery(postBox).stop().animate({width: widthPost} , 1000 , function() {commentBox.style.height = postBox.offsetHeight});
				this.element.addEventListener("mouseleave", (e) => {
					this.removeSlide()	
				});			
		}


		this.removeSlide = function() {
if(window.innerWidth > 1040) {
	var groupSpace = 447;
	var gradient = 0.75;
} else if (window.innerWidth > 770) {
	var groupSpace = 267;
	var gradient = 0.8;
} else {
	var groupSpace = 87;
	var gradient = 1;
}
				var postBox = this.element.querySelector(".postBox")
				var commentBox = this.element.querySelector(".comment-content");
				slide = this.element.querySelector(".slide");
				postBox.classList.remove("right");
				commentBox.classList.remove("left");
				slide.classList.remove("actif");
				widthPost = (window.innerWidth - groupSpace)*gradient
				jQuery(postBox).stop().animate({width: widthPost}, 1000 , function() {commentBox.style.height = postBox.offsetHeight});
				delete postBox;
				delete commentBox;
				delete this;
		}
}

