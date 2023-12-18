<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>   

    <h3>Your Status has been Information Awaiting. Ticket information is given below: # <b>{{isset($requestid) ? $requestid : ''}}</b></h3><br>
    <table border="1" cellpadding="10" style="border-collapse: collapse;">
        <tbody> 
           <tr>    
                <td bgcolor="#f2f1f1">Status</td>    
                <td>{{isset($status) ? $status : ''}}</td>    
            </tr>
            <tr>    
                <td>Tentative Date</td>    
                <td>{{isset($tentative_date) ? date('d-m-Y', strtotime($tentative_date)) : ''}}</td>    
            </tr>
            <tr>    
                <td bgcolor="#f2f1f1">Comment</td>    
                <td>{!! isset($comment) ? $comment : '' !!}</td>    
            </tr>
       </tbody>    
    </table>
    <br><br><br>
    <span>Regards,</span><br>
    <span>Karam Team</span>
</body>
</html>