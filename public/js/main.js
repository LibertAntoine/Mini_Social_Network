





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
			allPost.forEach(function(element) {
				element.querySelector(".postBox").style.width = (window.innerWidth - 447)*0.75;
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
		postBox.style.width = (window.innerWidth - 447)*0.75;
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


		var editPost = allPost[i].querySelector(".edit-post");
		editPost.addEventListener("click", function(e) {
			editContent = this.parentNode.parentNode.querySelector(".post");
			height = this.parentNode.parentNode.querySelector(".post").offsetHeight;
			var contentPost = editContent.innerHTML
			var area = editContent.replaceWith(document.createElement("textarea"));
			area = this.parentNode.parentNode.querySelector("textarea");
			area.innerHTML = contentPost
			area.style.height = height;
			area.setAttribute("id", "modif" + modif)
			textarea_to_tinymce("modif" + modif)
			this.textContent = "Annuler la modification"
			editPost.addEventListener.off()
			actionPost = this.parentNode.parentNode.querySelector(".action-post");
			actionPost.addEventListener.off()
			this.addEventListener("click", function(e) {
					area.replaceWith(document.createElement("p"))
					area.innerHTML = contentPost
				})
			modif++; 
		});



}


function textarea_to_tinymce(id){
    if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
        tinyMCE.execCommand("mceAddEditor", false, id);
		tinyMCE.execCommand('mceAddControl', false, id);
    }
}



