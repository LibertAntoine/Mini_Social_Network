function EditStatus(status, group) {
		this.status = status
		this.group = group

		this.validEdit = function() {

			message = document.createElement("div")
			message.className = "alert alert-dismissable";

			$.ajax({
       			url : 'index.php?action=updateStatus',
       			type : 'POST',
       			data : 'id=' + this.group + '&status=' + this.status,
       			dataType : 'html',
       			success : (dat) => {
       				if (dat == 'ok') {
       					message.classList.add("alert-success");
       					message.innerHTML = "Le statut a bien été modifié";
       					$('.fade').modal('hide');
       					jQuery(message).insertBefore($("#nav-option"))
       					setTimeout(() => { $('.alert').fadeOut(2000); delete this }, 4000);
       				} else {
       					message.classList.add("alert-warning");
       					message.innerHTML = dat;
       					jQuery(message).insertBefore($("#actual-status"))
       					setTimeout(() => { $('.alert').fadeOut(2000); }, 4000);
       				}
       			},    
       			error : function(){
       				alert('Erreur : imposible de modifier l\'article')
       			}
    		});
		}

		this.validSupr = function() {
			document.location.href="index.php?action=deleteLinkGroup&id=" + this.group + "&userId=" + $("#userId").val();
		}
}

	