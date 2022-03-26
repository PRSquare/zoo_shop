function checkAndSend(elId){
	var name = document.getElementById('type_name'+elId);

	var ok = true;

	if(!name.value){
		console.log("Name is empty!");
		ok = false;
	}

	if(ok){
		document.getElementById(elId).submit();
	}
}

function showHideChangeForm(id){
	var statinfo = document.getElementById("type_"+id);
	var changeForm = document.getElementById("changeform_"+id);
	if(statinfo.style.display == 'block'){
		statinfo.style.display = 'none';
		changeForm.style.display = 'block';
	}	
	else{
		statinfo.style.display = 'block';
		changeForm.style.display = 'none';
	}
}