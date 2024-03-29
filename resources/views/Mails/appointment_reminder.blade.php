<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>Appointment Reminder</title>
    <style>
        table, td, div, h1, p {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body style="margin:0;padding:0;">
<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
        <td align="center" style="padding:0;">
            <table role="presentation"
                   style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                <tr>
                    <td style="padding:36px 30px 42px 30px;">
                        <table role="presentation"
                               style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>
                                <td style="padding:0 0 36px 0;color:#153643;">
                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">
                                        Appointment Reminder</h1>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                        Dear {{ $appointment->user->firstname }},</p>
                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                        This is a reminder for your upcoming appointment:</p>
                                    <ul style="list-style-type: none; padding: 0;">
                                        <li><strong>Date:</strong> {{ $appointment->date }}</li>
                                        <li><strong>Time:</strong> {{ $appointment->time }}</li>
                                    </ul>
                                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a
                                            href="#"
                                            style="color:#1d2434;text-decoration:underline;">If you have any questions
                                            please contact us</a></p>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:30px;background:#1D2434;">
                        <table role="presentation"
                               style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                            <tr>
                                <td style="padding:0;width:50%;" align="left">
                                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                        &copy; Hairck Saloon
                                        2024<br/>
                                    </p>
                                </td>
                                <td style="padding:0;width:50%;" align="right">
                                    <table role="presentation"
                                           style="border-collapse:collapse;border:0;border-spacing:0;">
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
