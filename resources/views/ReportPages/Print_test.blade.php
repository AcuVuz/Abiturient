<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Печать теста</title>
    <style>
        @media print {
            table { page-break-after:auto }
        }
        p {
            margin : 0;
        }
    </style>
</head>
<body>
    <div style="width: 100%; max-width: 170mm; margin: auto">
        <header style="text-align: center;">
            <h2 style="font-size: 18px;">ГОУ ВПО ЛНР "Луганский государственный педагогический университет"</h2>
            <h3>Вступительный экзамен</h3>
        </header>
        <div class="content">
            <table>
                <tr>
                    <td style="width: 200px;">Образовательный уровень: </td>
                    <td>
                        <b>{{ $test_head->target_name }}</b>
                    </td>
                </tr>
                <tr>
                    <td>Наименование экзамена: </td>
                    <td>
                        <b>{{ $test_head->type_name.' - '.$test_head->discipline }}</b>
                    </td>
                </tr>
                <tr>
                    <td>Фамилия, имя, отчество:</td>
                    <td style="border-bottom: 1px solid black;"></td>
                </tr>
            </table>
            @foreach ($test_body as $tb_array)
            <hr>
                <table style="border-spacing: 0px; border-collapse: collapse; width:100%">
                    <tbody>
                        <tr>
                            <td style="width: 150px;"><b>{{ '('.$tb_array['ball'].' б.) ' }}Вопрос № {{ $loop->iteration }}:</b></td>
                            <td ><? echo str_replace('<p><br></p>', '', htmlspecialchars_decode($tb_array['question_text']->text)) ?></td>
                        </tr>
                    </tbody>
                </table>
                <table style="border-spacing: 0px; border-collapse: collapse; width:100%">
                    <tbody>
                        @foreach ($tb_array['question'] as $quest)
                            <tr>
                                <td style="width: 10px;" ><div style="width: 10px; height: 10px;border: 1px solid black; border-radius: 25%; margin: 2px;"></div></td>
                                <td style="text-align: justify;"><? echo str_replace('<p><br></p>', '', htmlspecialchars_decode($quest->text)) ?></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
            <table style="margin-top:20px;">
                <tr>
                    <td style="width: 100mm;">Ответил(а) на <b>_________</b> вопросов из <b>{{ $test_head->count_question }}</b>:</td>
                </tr>
                <tr>
                    <td>Правильных ответов: <b>_________</b></td>
                </tr>
                <tr>
                    <td>Неправильных ответов: <b>_________</b></td>
                </tr>
                <tr>
                    <td>Получил(а) <b>_________</b> баллов из <b>{{ $test_head->max_ball }}</b> возможных. </td>
                </tr>
                <tr>
                    <td style="width: 120mm;">С результатами тестирования согласен(на)</td>
                    <td style="width: 50mm;"><hr/></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
