function TestForm() {

		this.verifString = function(input, min, max) {
		   if(input.value.length <= min || input.value.length >= max) {
		      this.errorSignal(input, true);
		      return false;
		   } else {
		      this.errorSignal(input, false);
		      return true;
		   }
		}

		this.verifStringSubmit = function(input, min, max) {  
		   if(input.value.length <= min || input.value.length >= max) {
		      return false;
		   } else {
		      return true;
		   }
		}

		this.errorSignal = function(input, error) {
			   if(error)
			      input.style.backgroundColor = "#fba";
			   else
			      input.style.backgroundColor = "";
		}

		this.verifSubmitLogin = function(form, e) {
			pseudoOk = this.verifStringSubmit(form.pseudo, 8, 24)
			mdpOk = this.verifStringSubmit(form.mdp, 8, 24)

		   if(pseudoOk && mdpOk) {
		      	return true;
		   } else if (pseudoOk) {
		   		e.preventDefault()
		   		alert("Merci de renseigner un mot de passe entre 8 et 24 caractères.")
		   		return false; 
		   } else {
		   		e.preventDefault()
		   		alert("Merci de renseigner un identifiant entre 8 et 24 caractères.")
		   		return false; 
		   }
		}

		this.verifSubmitEditPseudo = function(form, e) {
			pseudoOk = this.verifStringSubmit(form.newPseudo, 8, 24)

		   if(pseudoOk) {
		      	return true;
		   } else {
		   		e.preventDefault()
		   		alert("Merci de renseigner un nouvel identifiant entre 8 et 24 caractères.")
		   		return false; 
		   }
		}

		this.verifSubmitEditMdp = function(form, e) {
			oldMdpOk = this.verifStringSubmit(form.oldMdp, 8, 24)
			newMdpOk = this.verifStringSubmit(form.newMdp, 8, 24)

		   if(oldMdpOk && newMdpOk) {
		      	return true;
		   } else if (oldMdpOk) {
		   		e.preventDefault()
		   		alert("Le nouveau mot de passe doit faire entre 8 et 24 caractères.")
		   		return false; 
		   } else {
		   		e.preventDefault()
		   		alert("L'ancien mot de passe doit faire 8 et 24 caractères.")
		   		return false; 
		   }
		}

		this.verifSubmitAddGroup = function(form, e) {
			titleOk = this.verifStringSubmit(form.titleGroup, 4, 240)
			
			if (form.description.value != "") {
				descriptionOk = this.verifStringSubmit(form.description.value, 0, 2000)
			} else {
				descriptionOk = true
			}

		   if(titleOk && descriptionOk) {
		      	return true;
		   } else if (descriptionOk) {
		   		e.preventDefault()
		   		alert("Merci de renseigner un titre entre 4 et 240 caractères.")
		   		return false; 
		   } else {
		   		e.preventDefault()
		   		alert("Merci de renseigner une description de moins de 2000 caractères.")
		   		return false; 
		   }
		}

		this.verifSubmitPost = function(form, e) {
			tinyMCE.triggerSave(true, true);
			titleOk = this.verifStringSubmit(form.titlePost, 4, 240)
			contentOk = this.verifStringSubmit(form.contentPost, 1, 20000)
		   if(titleOk && contentOk) {
		      	return true;
		   } else if (titleOk) {
		   		e.preventDefault()
		   		alert("Merci de renseigner un contenu entre 2 et 20000 caractères.")
		   		return false; 
		   } else {
		   		e.preventDefault()
		   		alert("Merci de renseigner un titre entre 4 et 240 caractères.")
		   		return false; 
		   }
		}

		this.verifSubmitComment = function(form, e) {
			contentOk = this.verifStringSubmit(form.content, 1, 500)

		   if(contentOk) {
		      	return true;
		   } else {
		   		e.preventDefault()
		   		alert("Merci de renseigner un commentaire entre 1 et 500 caractères.")
		   		return false; 
		   }
		}		
}

	