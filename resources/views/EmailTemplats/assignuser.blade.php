<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>   
    <h3>Dear Concern</h3>
    <h3>New ticket has been assigned to New User. Ticket information is given below: # <b>{{isset($requestid) ? $requestid : ''}}</b></h3><br>
    <table border="1" cellpadding="10" style="border-collapse: collapse;">
        <tbody> 
            <tr>    
                <td>Assign To</td>    
                <td>{{isset($requestdate) ? date('d-m-Y', strtotime($requestdate)) : ''}}</td>    
            </tr>
           
        </tbody>    
    </table>
    <br><br><br>
    <span>Regards,</span><br>
    <span>Karam Team</span>
</body>
</html>