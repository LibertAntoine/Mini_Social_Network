


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


document.querySelectorAll(".post-content").forEach(function(element) {

		element.querySelector(".slide").addEventListener("mouseenter", function(e) {
				if (this.classList[1] != 'actif') {
					var slide = new Slide(element);
					slide.activeSlide()
				}	
		});

});

	var modif = 1;
	var allPost = document.querySelectorAll(".post-content");
		
		setInterval("equal()", 200)

		function equal() {
			document.querySelectorAll(".post-content").forEach(function(element) {
				var height = element.querySelector(".postBox").offsetHeight;
				element.querySelector(".comment-content").style.height = height;
		})}


			if (window.innerWidth < 710) {
				document.querySelectorAll(".navbloc").forEach(function(element) {element.style.display = "none"})
				document.querySelectorAll(".navIcon").forEach(function(element) {element.style.display = "block"})
			} else {
				document.querySelectorAll(".navbloc").forEach(function(element) {element.style.display = "block"})
				document.querySelectorAll(".navIcon").forEach(function(element) {element.style.display = "none"})
			}



		window.onresize = function(){
			var allPost = document.querySelectorAll(".post-content");
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



			allPost.forEach(function(element) {

				element.querySelector(".postBox").style.width = (window.innerWidth - groupSpace)* gradient;
			});
			if (window.innerWidth < 710) {
				document.querySelectorAll(".navbloc").forEach(function(element) {element.style.display = "none"})
				document.querySelectorAll(".navIcon").forEach(function(element) {element.style.display = "block"})
			} else {
				document.querySelectorAll(".navbloc").forEach(function(element) {element.style.display = "block"})
				document.querySelectorAll(".navIcon").forEach(function(element) {element.style.display = "none"})
			}


		}



	for (var i = 0; i < allPost.length ; i++) {
		postBox = allPost[i].querySelector(".postBox");
		postBox.style.width = (window.innerWidth - groupSpace)*gradient;
		allPost[i].querySelectorAll(".action-post").forEach(function(el) {
				el.style.display = 'none';
			});

		postBox.addEventListener("mouseover", function(e) {
			this.querySelectorAll(".action-post").forEach(function(el) {
				el.style.display = 'inline';
			});
		});

		postBox.addEventListener("mouseout", function(e) {
			this.querySelectorAll(".action-post").forEach(function(el) {
				el.style.display = 'none';
			});
		});





		




		var scroler = allPost[i].querySelector(".comment-text");
		scroler.scrollTop = scroler.scrollHeight;







}


		$(".edit-post").on("click", function(e) {
						var editArticle = new EditArticle(this, e);
						editArticle.activeEdit();	
		});


function textarea_to_tinymce(id){
    if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
        tinyMCE.execCommand("mceAddEditor", false, id);
		tinyMCE.execCommand('mceAddControl', false, id);
    }
}



