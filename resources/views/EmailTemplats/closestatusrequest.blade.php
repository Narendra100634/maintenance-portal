<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>   

<h3>Your Status has been Closed Ticket information is given below: # <b>{{isset($requestid) ? $requestid : ''}}</b></h3><br>
    <table border="1" cellpadding="10" style="border-collapse: collapse;">
        <tbody> 
             <tr  bgcolor="#f2f1f1">    
                <td>Status</td>    
                <td>{{isset($status) ? $status : ''}}</td>    
            </tr>
            <tr>    
                <td>Closer Date</td>    
                <td>{{ isset($closer_date) ? date('d-m-Y', strtotime($closer_date)) : '' }}</td>    
            </tr>
            <tr bgcolor="#f2f1f1">    
                <td >Feedback</td>    
                <td>{!! isset($feedback) ? $feedback : '' !!}</td>    
            </tr>
            <tr>    
                <td>Rating</td>    
                <td>
                    @if ($rating == 5)            
                        <span style=" font-size: 25px; color: #ffb20d; content : '\2605'">★★★★★</span>
                    @elseif ($rating == 4)
                        <span style="font-size: 25px; color: #ffb20d; content : '\2605'">★★★★</span><span style=" font-size: 25px;color: #bcb5a5; content : '\2605'">★</span>
                    @elseif ($rating == 3)
                        <span  style=" color: #ffb20d; content : '\2605'">★★★</span><span style=" font-size: 25px;color: #bcb5a5; content : '\2605'">★★</span>
                    @elseif ($rating == 2)
                        <span style=" color: #ffb20d; content : '\2605'">★★</span><span style=" font-size: 25px;color: #bcb5a5; content : '\2605'">★★★</span>
                    @else
                        <span style=" color: #ffb20d; content : '\2605'">★</span><span style=" font-size: 25px;color: #bcb5a5; content : '\2605'">★★★★</span> 
                    @endif
                </td>    
            </tr>
       </tbody>    
    </table>
    <br><br><br>
    <span>Regards,</span><br>
    <span>Karam Team</span>   
</body>
</html>