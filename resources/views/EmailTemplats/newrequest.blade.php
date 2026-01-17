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
    <h3>New service request ticket has been Created. Ticket information is given below:</h3><br>
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
                <td>Requester Name</td>
                <td>{{isset($requesterName) ? $requesterName : ''}}</td>
            </tr>
            <tr>
                <td>Resolver Name</td>
                <td>{{isset($resolverName) ? $resolverName : ''}}</td>
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
                <td>Ticket Details</td>
                <td>{{isset($description) ? $description : ''}}</td>
            </tr>
        </tbody>
    </table>
    <br><br><br>
    <span>Regards,</span><br>
    KARAM Maintenance Team
</body>
</html>
