function verif_form_login()
	{
		if(document.login.pseudo.value == "")
			{
				alert('Veuillez entrer un login!');
				document.login.pseudo.value.focus();
			}
		else if(document.login.passe.value == "")
			{
				alert('Veuillez entrer un password!');
				document.login.passe.value.focus();
			}
		else
			{
				document.login.submit();
			}

	}