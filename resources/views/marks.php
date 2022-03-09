
<h1>Example high school</h1>
<small>New Baneshwor, Kathmandu</small>
<br><br>
<h4>Name: <?php echo $marks['s_name']; ?></h4>
<h4>Class: <?php echo $marks['class']; ?></h4>
<h4>Address: <?php echo $marks['address']; ?></h4>
<body>
<table>
    <thead>
    <tr>
        <td>Subject </td>
        <td>Total Marks</td>
        <td>Obtained Marks</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Nepali</td>
        <td>100</td>
        <td><?php echo $marks['nepali']; ?></td>
    </tr>
    <tr>
        <td>English</td>
        <td>100</td>
        <td><?php echo $marks['english']; ?></td>
    </tr>
    <tr>
        <td>Maths</td>
        <td>100</td>
        <td><?php echo $marks['maths']; ?></td>
    </tr>
    <tr>
        <td>Science</td>
        <td>100</td>
        <td><?php echo $marks['science']; ?></td>
    </tr>
    <tr>
        <td>E.P.H</td>
        <td>100</td>
        <td><?php echo $marks['ehp']; ?></td>
    </tr>
    <?php
    $total =( $marks['english']+$marks['ehp']+$marks['science']+$marks['maths']+$marks['nepali'])/5;
    if ($total>= 50){
        $res = 'PASS';
    }else{
        $res = 'FAIL';
    }

    ?>
    <tr>
        <td colspan="2">Percentage</td>
        <td><?php echo $total; ?>%</td>
    </tr>
    <tr>
        <td colspan="3"><?php echo $res ?></td>
    </tr>
    </tbody>
</table>
</body>
<style>
    html {
        font-family:arial;
        font-size: 18px;
    }
    td {
        border: 1px solid #726E6D;
        padding: 15px;
    }
    thead{
        font-weight:bold;
        text-align:center;
        background: #3399FF;
        color:white;
    }
</style>
