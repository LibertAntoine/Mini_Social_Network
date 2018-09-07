




function Slide(el) {

		this.element = el

		this.activeSlide = function() {
				var postBox = this.element.querySelector(".postBox")
				var commentBox = this.element.querySelector(".comment-content");
				slide = this.element.querySelector(".slide");
				postBox.classList.add("right");
				commentBox.classList.add("left");
				slide.classList.add("actif");
				widthPost = window.innerWidth - (447 + 265)
				jQuery(postBox).stop().animate({width: widthPost} , 1000 , function() {commentBox.style.height = postBox.offsetHeight});
				this.element.addEventListener("mouseleave", (e) => {
					this.removeSlide()	
				});			
		}


		this.removeSlide = function() {
				var postBox = this.element.querySelector(".postBox")
				var commentBox = this.element.querySelector(".comment-content");
				slide = this.element.querySelector(".slide");
				postBox.classList.remove("right");
				commentBox.classList.remove("left");
				slide.classList.remove("actif");
				widthPost = (window.innerWidth - 447)*0.75
				jQuery(postBox).stop().animate({width: widthPost}, 1000 , function() {commentBox.style.height = postBox.offsetHeight});
				delete postBox;
				delete commentBox;
				delete this;
		}
}

