<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="width:100%;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
	<head>
		<meta charset="UTF-8">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta content="telephone=no" name="format-detection">
		<title>ЛНУ имени Тараса Шевченко</title>
	</head>
	<body>
		<div>
			<table>
				<tr>
					<td>
						<b>Уважаемый (-ая) {{ $person->famil.' '.$person->name.' '.$person->otch }}</b>
					</td>
				</tr>
				<tr>
					<td>Ваши данные <u>не прошли</u> проверку по следующей причине:</td>
				</tr>
                <tr><td><br></td></tr>
                <tr>
					<td>{{ $comment }}</td>
                </tr>
                <tr><td><br></td></tr>
                <tr>
					<td>После устранения причины отказа, сообщите нам на почту abiturient@ltsu.org</td>
				</tr>
            </table>
		</div>
	</body>
</html>