var slidePanels = true;

function showData(gtitle,gmessage){
if (!gtitle==''&& !gmessage=='')
	{
	gtitle == '' ? 'Saved' : gtitle;
	$.gritter.add({	title: gtitle,
					text: gmessage});
	}
}
