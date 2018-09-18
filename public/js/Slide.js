function Slide(el) {

		this.element = el.parentNode.parentNode;
		this.responsive = new TellerResponsive();

		this.activeSlide = function() {
			if(window.innerWidth > 1040) {
				var groupSpace = 447;
			} else if (window.innerWidth > 770) {
				var groupSpace = 267;
			} else {
				var groupSpace = 87;
			}

			var postBox = this.element.querySelector(".postBox");
			var commentBox = this.element.querySelector(".comment-content");

			slide = this.element.querySelector(".slide");
			postBox.classList.add("right");
			commentBox.classList.add("left");
			slide.classList.add("actif");
			widthPost = window.innerWidth - (groupSpace + 265);
			var adaptWidth = setInterval("this.responsive.equal()", 200);
			jQuery(postBox).stop(false, true).animate({width: widthPost} , 650, () => {clearInterval(adaptWidth);});
			jQuery(this.element).on("mouseleave", (e) => {
				this.removeSlide();
			});			
		}

		this.activeSlimSlide = function() {
			var postBox = this.element.querySelector(".postBox");
			var commentBox = this.element.querySelector(".comment-content");

			slide = this.element.querySelector(".slide");
			postBox.classList.add("right");
			commentBox.classList.add("left");
			slide.classList.add("actif");
			this.responsive.equal();
			jQuery(this.element).on("mouseleave", (e) => {
				this.removeSlimSlide();	

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

			var postBox = this.element.querySelector(".postBox");
			var commentBox = this.element.querySelector(".comment-content");
			slide = this.element.querySelector(".slide");
			postBox.classList.remove("right");
			commentBox.classList.remove("left");
			slide.classList.remove("actif");
			widthPost = (window.innerWidth - groupSpace)*gradient;
			var reAdaptWidth = setInterval("this.responsive.equal()", 200);
			jQuery(this.element).off();
			jQuery(postBox).stop(false, true).animate({width: widthPost} , 650, () => {clearInterval(reAdaptWidth);});
			delete this;
		}

		this.removeSlimSlide = function() {
			var postBox = this.element.querySelector(".postBox");
			var commentBox = this.element.querySelector(".comment-content");
			slide = this.element.querySelector(".fa-comments");
			postBox.classList.remove("right");
			commentBox.classList.remove("left");
			slide.classList.remove("actif");
			jQuery(this.element).off();
			this.responsive.responsivePostBox();
			delete this;
		}
}

