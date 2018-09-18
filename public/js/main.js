
var modif = 1;
var responsive = new TellerResponsive();



$(".slide").on("mouseenter", function() {

		if (this.classList[1] != 'actif') {
			var slide = new Slide(this);
			slide.activeSlide();
		}	
});

$(".fa-comments").on("click", function() {
		if (this.classList[2] != 'actif') {
			var slide = new Slide(this);
			slide.activeSlimSlide();
		}	
});

$(".action-post").hide()

$(".postBox").on("mouseover", function(e) {
	this.querySelectorAll(".action-post").forEach(function(element) {
		element.style.display = 'inline';
	});
})

$(".postBox").on("mouseout", function(e) {
	this.querySelectorAll(".action-post").forEach(function(element) {
		element.style.display = 'none';
	});
})


$(".edit-post").on("click", function() {
	var editArticle = new EditArticle(this);
	editArticle.activeEdit();	
});
	

$("#valid-status").on("click", function() {
	var value = $('input[type=radio][name=status]:checked').attr('value');
	groupId = $("#groupId").val();
	var editStatus = new EditStatus(value, groupId);
	if (value <= 4) {
		editStatus.validEdit();

	} else if (value == 5) {
		editStatus.validSupr();
	}
});



responsive.responsiveNavbar();
responsive.responsivePostBox();
responsive.responsiveComment();

window.onresize = function() {
	responsive.responsiveNavbar();
	responsive.responsivePostBox();
	responsive.responsiveComment();
}

var testForm = new TestForm();

$('input[name=pseudo]').on("blur", function() {
	testForm.verifString(this, 8, 24);
})

$('input[name=mdp]').on("blur", function() {
	testForm.verifString(this, 8, 24);
})

$('#login').submit(function(e) {
	return testForm.verifSubmitLogin(this, e);
})

$('input[name=titleGroup]').on("blur", function() {
	testForm.verifString(this, 4, 240);
})

$('#submitGroup').submit(function(e) {
	return testForm.verifSubmitAddGroup(this, e);
})

$('input[name=newPseudo]').on("blur", function() {
	testForm.verifString(this, 8, 24);
})

$('input[name=oldMdp]').on("blur", function() {
	testForm.verifString(this, 8, 24);
})

$('input[name=newMdp]').on("blur", function() {
	testForm.verifString(this, 8, 24);
})

$('#submit-edit-pseudo').submit(function(e) {
	return testForm.verifSubmitEditPseudo(this, e);
})

$('#submit-edit-mdp').submit(function(e) {
	return testForm.verifSubmitEditMdp(this, e);
})

$('input[name=titlePost]').on("blur", function() {
	testForm.verifString(this, 4, 240);
})

$('#submit-post').submit(function(e) {
	return testForm.verifSubmitPost(this, e);
})

$('.submit-comment').each(
	function() {
		$(this).submit(function(e) {
		return testForm.verifSubmitComment(this, e);
	})
})


