function TellerResponsive() {

		this.responsiveNavbar = function() {
			if (window.innerWidth < 710) {
				document.querySelectorAll(".navbloc").forEach(function(element) {element.style.display = "none"});
				document.querySelectorAll(".navIcon").forEach(function(element) {element.style.display = "block"});
			} else {
				document.querySelectorAll(".navbloc").forEach(function(element) {element.style.display = "block"});
				document.querySelectorAll(".navIcon").forEach(function(element) {element.style.display = "none"});
			}
		}

		this.responsivePostBox = function() {
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
			widthPost = (window.innerWidth - groupSpace)* gradient
			$(".postBox").each(
				function() {
					$(this).css('width', widthPost)
				})
		}

		this.responsiveComment = function() {
			if(window.innerWidth < 500) { 
				$(".slide").hide();
				$(".fa-comments").show();
			} else {
				$(".slide").show();
				$(".fa-comments").hide();
			}
			this.equal();
		}


		this.equal = function() {
			document.querySelectorAll(".post-content").forEach(function(element) {
				var height = element.querySelector(".postBox").offsetHeight;
				jQuery(element.querySelector(".comment-content")).css('height', height)
				var scroler = element.querySelector(".comment-text");
				scroler.scrollTop = scroler.scrollHeight;
		})}
}

	
	