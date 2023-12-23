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
    <h3>New ticket has been assigned to you. Ticket information is given below: # <b>{{isset($requestid) ? $requestid : ''}}</b></h3><br>
    <table border="1" cellpadding="10" style="border-collapse: collapse;">
        <tbody> 
            <tr>    
                <td>Request Date</td>    
                <td>{{isset($requestdate) ? date('d-m-Y', strtotime($requestdate)) : ''}}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td>Status</td>    
                <td>{{isset($status) ? $status : ''}}</td>    
            </tr>
            <tr >    
                <td>Priority</td>    
                <td>{{isset($priority) ? $priority : ''}}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td>Request Type</td>    
                <td>{{isset($requestType) ? $requestType : ''}}</td>    
            </tr>            
            <tr>    
                <td>Subject</td>    
                <td>{{isset($subject) ? $subject : ''}}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td>Description</td>    
                <td>{{isset($description) ? $description : ''}}</td>    
            </tr>
            <tr >    
                <td>Requester Name</td>    
                <td>{{isset($requesterName) ? $requesterName : ''}}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td>Requester Email</td>    
                <td>{{isset($requesterEmail) ? $requesterEmail : ''}}</td>    
            </tr>
            <tr>    
                <td>Requester Region</td>    
                <td>{{isset($requesterRegion) ? $requesterRegion : ''}}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td>Resolver Name</td>    
                <td>{{isset($resolverName) ? $resolverName : ''}}</td>    
            </tr>
        </tbody>    
    </table>
    <br><br><br>
    <span>Regards,</span><br>
    <span>Karam Team</span>
</body>
</html>