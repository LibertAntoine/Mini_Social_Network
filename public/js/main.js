


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

			if(window.innerWidth < 500) { 
				$(".slide").hide()
				$(".fa-comments").show() 
			} else {
				$(".slide").show()
				$(".fa-comments").hide()
			}




		$(".slide").on("mouseenter", function() {

				if (this.classList[1] != 'actif') {
					var slide = new Slide(this);
					slide.activeSlide()
				}	
		});

		$(".fa-comments").on("click", function() {
				if (this.classList[2] != 'actif') {
					var slide = new Slide(this);
					slide.activeSlimSlide()
				}	
		});


	var modif = 1;
	var allPost = document.querySelectorAll(".post-content");
		




			if (window.innerWidth < 710) {
				document.querySelectorAll(".navbloc").forEach(function(element) {element.style.display = "none"})
				document.querySelectorAll(".navIcon").forEach(function(element) {element.style.display = "block"})
			} else {
				document.querySelectorAll(".navbloc").forEach(function(element) {element.style.display = "block"})
				document.querySelectorAll(".navIcon").forEach(function(element) {element.style.display = "none"})
			}



		window.onresize = function(){
			equal()
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

			if(window.innerWidth < 500) { 
				$(".slide").hide()
				$(".fa-comments").show() 
			} else {
				$(".slide").show()
				$(".fa-comments").hide()
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


		}




		$(".edit-post").on("click", function() {
						var editArticle = new EditArticle(this);
						editArticle.activeEdit();	
		});


function textarea_to_tinymce(id){
    if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
        tinyMCE.execCommand("mceAddEditor", false, id);
		tinyMCE.execCommand('mceAddControl', false, id);
    }
}


		equal()
		function equal() {
			document.querySelectorAll(".post-content").forEach(function(element) {
				var height = element.querySelector(".postBox").offsetHeight;
				element.querySelector(".comment-content").style.height = height;
				var scroler = element.querySelector(".comment-text");
				scroler.scrollTop = scroler.scrollHeight;
		})}



$("#valid-status").on("click", function() {

				var value = $('input[type=radio][name=status]:checked').attr('value');
				groupId = $("#groupId").val()

				var editStatus = new EditStatus(value, groupId);
				if (value <= 4) {
					editStatus.validEdit()

				} else if (value == 5) {
					editStatus.validSupr()
				}

});
