function EditArticle(el) {

		this.element = el
		this.postId

		this.activeEdit = function() {
			this.postId = this.element.classList[1]
			editContent = this.element.parentNode.parentNode.querySelector(".post");
			titleContent = this.element.parentNode.parentNode.querySelector("h3");
			height = editContent.offsetHeight;
			blocTitle = document.createElement("div")
			blocTitle.classList.add("blocTitle")
			blocTitle.innerHTML = "<label for='title'>Titre : </label><input type='text' class='title-edit'>"
			blocTitle.querySelector(".title-edit").value = titleContent.innerHTML
			var area = editContent.replaceWith(document.createElement("textarea"));
			var area = titleContent.replaceWith(blocTitle);
			area = this.element.parentNode.parentNode.querySelector("textarea");
			area.innerHTML = editContent.innerHTML
			area.style.height = height;
			area.setAttribute("id", "modif" + modif)
			textarea_to_tinymce("modif" + modif)

			this.element.textContent = "Annuler la modification"
			valid = document.createElement("span")
			valid.classList.add("valid")
			valid.innerHTML = "<span class='edit-post'>Valider la modification</span> - "
			jQuery(valid).on("click", (e) => {this.validEdit()});
 			this.element.parentNode.insertBefore(valid ,this.element)
			jQuery(this.element).off();
			jQuery(this.element).on("click", () => {
					this.removeEdit(editContent.innerHTML, titleContent.innerHTML)	
			});
			modif++;	
		}

		this.removeEdit = function(content, title) {
			this.element.parentNode.parentNode.querySelector(".mce-tinymce").remove();
			this.element.parentNode.querySelector(".valid").remove();
			area = this.element.parentNode.parentNode.querySelector("textarea");
			blocTitle = this.element.parentNode.parentNode.querySelector(".blocTitle");

			post = document.createElement("div")
			post.classList.add("post")
			post.appendChild(document.createElement("p"))
			retitle = document.createElement("h3")
			retitle.innerHTML = title
			area.replaceWith(post)
			blocTitle.replaceWith(retitle)
			repost = this.element.parentNode.parentNode.querySelector(".post")
			repost.innerHTML = content
			this.element.textContent = "Modifier l'article"
			jQuery(this.element).off();	
			equal()
			jQuery(this.element).on("click", () => {
					this.activeEdit()	
			});	
		}

		this.validEdit = function() {
			tinyMCE.triggerSave(true, true);
			area = this.element.parentNode.parentNode.querySelector("textarea");
			inputTitle = this.element.parentNode.parentNode.querySelector("input");
			blocTitle = this.element.parentNode.parentNode.querySelector(".blocTitle");
			message = document.createElement("div")
			message.className = "alert alert-dismissable col-lg-4";
			this.element.parentNode.parentNode.insertBefore(message, blocTitle)
			$.ajax({
       			url : 'index.php?action=editPost',
       			type : 'POST',
       			data : 'content=' + encodeURIComponent(area.value) + '&title=' + inputTitle.value + '&postId=' + this.postId,
       			dataType : 'html',
       			success : (dat) => {
       				if (dat == 'ok') {
       					this.removeEdit(area.value, inputTitle.value)
       					message.classList.add("alert-info");
       					message.innerHTML = "Le post a bien été modifié";
       					setTimeout(() => { $(".alert-info").fadeOut(2000); delete this }, 4000);
       				} else {
       					message.classList.add("alert-warning");
       					message.innerHTML = dat;
       					setTimeout(() => { $(".alert-info").fadeOut(2000); }, 4000);
       				}
       			},    
       			error : function(){
       				alert('Erreur : imposible de modifier l\'article')
       			}
    		});
		}

		


}

	