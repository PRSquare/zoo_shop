function changeElemDisplayStyle(elemId)
{
	var el = document.getElementById(elemId);
	if(el.style.display == 'block')
		el.style.display = 'none';
	else
		el.style.display = 'block';
}