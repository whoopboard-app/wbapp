<!DOCTYPE html>
<html>
<body>
    <p>Hello {{ $name }},</p>
    <p>Thank you for subscribing! Please confirm your subscription:</p>
    <p>
         <a href="{{ $confirmationUrl }}">
            Confirm Subscription
        </a>    
    </p>
</body>
</html>
