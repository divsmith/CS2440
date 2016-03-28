// Form validation code will come here.
function validate()
{

	if( document.myForm.Name.value == "" )
	{
		alert( "Please provide your name!" );
		document.myForm.Name.focus() ;
		return false;
	} else {
		var pattern = /[A-Za-z]+\s[A-Za-z]+/;
		if ( !pattern.test(document.myForm.Name.value)) {
			alert( 'Please provide a first and last name');
			document.myForm.Name.focus();
			return false;
		};
	}

	if( document.myForm.EMail.value == "" )
	{
		alert( "Please provide your Email!" );
		document.myForm.EMail.focus() ;
		return false;
	} else {
		var pattern = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
		if ( !pattern.test(document.myForm.EMail.value) ) {
			alert('Please provide Email in format name@domain.tld');
			document.myForm.EMail.focus();
			return false;
		};
	}

	if( document.myForm.Zip.value == "" ||
		isNaN( document.myForm.Zip.value ) ||
		document.myForm.Zip.value.length != 5 )
	{
		alert( "Please provide a zip in the format #####." );
		document.myForm.Zip.focus() ;
		return false;
	}

	if( document.myForm.Country.value == "-1" )
	{
		alert( "Please provide your country!" );
		return false;
	}
	return( true );
}