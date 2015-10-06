<?php
session_start();
$nav=2;
require_once('apis/classes.php');
if (isset($_SESSION['client']['username'])) {
    $role='institute';
}else if ($_SESSION['client']['role']=='teacher') {
    $role='teacher';
    $nav=3;
}else{
    header('Location:./register.php');
}
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Report Card</title>
    <link href="student/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
        @import url(http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

        body {
            background-color: #3e94ec;
            font-family: "Roboto", helvetica, arial, sans-serif;
            font-size: 16px;
            font-weight: 400;
            text-rendering: optimizeLegibility;
        }

        div.table-title {
            display: block;
            margin: auto;
            max-width: 600px;
            padding:5px;
            width: 100%;
        }

        .table-title h3 {
            color: #fafafa;
            font-size: 30px;
            font-weight: 400;
            font-style:normal;
            font-family: "Roboto", helvetica, arial, sans-serif;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            text-transform:uppercase;
        }


        /*** Table Styles **/

        .table-fill {
            background: white;
            border-radius:3px;
            border-collapse: collapse;
            height: 320px;
            margin: auto;
            max-width: 600px;
            padding:5px;
            width: 100%;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            animation: float 5s infinite;
        }

        th {
            color:#D5DDE5;;
            background:#1b1e24;
            border-bottom:4px solid #9ea7af;
            border-right: 1px solid #343a45;
            font-size:23px;
            font-weight: 100;
            padding:24px;
            text-align:left;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            vertical-align:middle;
        }

        th:first-child {
            border-top-left-radius:3px;
        }

        th:last-child {
            border-top-right-radius:3px;
            border-right:none;
        }

        tr {
            border-top: 1px solid #C1C3D1;
            border-bottom-: 1px solid #C1C3D1;
            color:#666B85;
            font-size:16px;
            font-weight:normal;
            text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
        }

        tr:hover td {
            background:#4E5066;
            color:#FFFFFF;
            border-top: 1px solid #22262e;
            border-bottom: 1px solid #22262e;
        }

        tr:first-child {
            border-top:none;
        }

        tr:last-child {
            border-bottom:none;
        }

        tr:nth-child(odd) td {
            background:#EBEBEB;
        }

        tr:nth-child(odd):hover td {
            background:#4E5066;
        }

        tr:last-child td:first-child {
            border-bottom-left-radius:3px;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius:3px;
        }

        td {
            background:#FFFFFF;
            padding:20px;
            text-align:left;
            vertical-align:middle;
            font-weight:300;
            font-size:18px;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #C1C3D1;
        }

        td:last-child {
            border-right: 0px;
        }

        th.text-left {
            text-align: left;
        }

        th.text-center {
            text-align: center;
        }

        th.text-right {
            text-align: right;
        }

        td.text-left {
            text-align: left;
        }

        td.text-center {
            text-align: center;
        }

        td.text-right {
            text-align: right;
        }

    </style>
    <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
</head>

<body onload="window.print();">
<div class="table-title">
    <h3>Report Card</h3>
</div>
<table class="table-fill">
    <thead>
    <tr>
        <th class="text-left">Question</th>
        <th class="text-left">Analysis</th>
    </tr>
    </thead>
    <tbody class="table-hover">
    <?php
        $api=new API();
        $data=array('id'=>$_GET['id'],'student_id'=>$_GET['student_id']);
        $report=$api->generateReport($data);

        if($report->count()){
            foreach($report as $document){
    ?>
    <tr>
        <td class="text-left"><?php echo $document['question'];?></td>
        <td class="text-left" style='text-align: center'><?php if(strtoupper($document['student_answer'])==strtoupper($document['answer'])){echo "<p style='color: #4caf50;'>Correct <i class='fa fa-thumbs-up' ></i></p>";}else{echo "<p style='color: #D12538;'>InCorrect <i class='fa fa-thumbs-down'></i>";}?></p></td>
    </tr>
        <?php
        }}else{
            header('Location:');
        }
        ?>
    </tbody>
</table>


</body>