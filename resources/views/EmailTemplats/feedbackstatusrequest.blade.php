<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>   
    <h3>Dear User</h3>
    <h3>Service request ticket response has been received. Ticket information is given below:</h3><br>
    <table border="1" cellpadding="10" style="border-collapse: collapse;">
        <tbody> 
            <tr bgcolor="#f2f1f1">    
                <td>Ticket Id</td>    
                <td>#{{isset($requestid) ? $requestid : ''}}</td>    
            </tr>
            <tr>    
                <td>Request Date</td>    
                <td>{{isset($requestdate) ? date('d-m-Y H:i:s', strtotime($requestdate)) : ''}}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td>Tentative Date</td>    
                <td>{{isset($tentative_date) ? date('d-m-Y H:i:s', strtotime($tentative_date)) : ''}}</td>    
            </tr>
            <tr>    
                <td>Handover Date</td>    
                <td>{{isset($handover_date) ? date('d-m-Y H:i:s', strtotime($handover_date)) : ''}}</td>    
            </tr>
           <tr bgcolor="#f2f1f1">    
                <td>Status</td>    
                <td>{{isset($status) ? $status : ''}}</td>    
            </tr>
           
            <tr>    
                <td>Priority</td>    
                <td>{{isset($priority) ? $priority : ''}}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td>Request Type</td>    
                <td>{{isset($requestType) ? $requestType : ''}}</td>    
            </tr>            
            <tr>    
                <td>Ticket Title</td>    
                <td>{{isset($subject) ? $subject : ''}}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td>Comments</td>    
                <td>{!! isset($comment) ? $comment : '' !!}</td>    
            </tr>
       </tbody>    
    </table>
    <br><br><br>
    <span>Regards,</span><br>
    <span>{{isset($resolverName) ? $resolverName : ''}}</span>
</body>
</html>