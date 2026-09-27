@php
    // Get theme color from Site Settings
    $primary = $siteSetting?->primary_color ?: '#5ce1e6';

    // Normalize HEX color
    $hex = ltrim($primary, '#');

    if (strlen($hex) === 3) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }

    // Convert HEX to RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // Generate darker version of primary color
    $darkR = max(0, round($r * 0.55));
    $darkG = max(0, round($g * 0.55));
    $darkB = max(0, round($b * 0.55));

    $darkPrimary = sprintf(
        '#%02x%02x%02x',
        $darkR,
        $darkG,
        $darkB
    );
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>

<body style="margin:0; padding:0; background:#f4f7fb; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           style="background:#f4f7fb; padding:40px 15px;">

        <tr>
            <td align="center">

                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                       style="max-width:650px; background:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 8px 30px rgba(15,23,42,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background:{{ $darkPrimary }}; padding:32px 40px; text-align:center;">

                            <img
                                src="{{ asset('uploads/settings/' . ($siteSetting->logo_dark ?? 'logo.svg')) }}"
                                alt="Logo"
                                style="max-height:42px; margin-bottom:20px;"
                            />

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">

                                        <div style="font-size:13px; font-weight:bold; letter-spacing:2px; text-transform:uppercase; color:{{ $primary }}; margin-bottom:10px;">
                                            Portfolio Notification
                                        </div>

                                        <div style="font-size:26px; font-weight:bold; color:#ffffff;">
                                            New Contact Message
                                        </div>

                                        <div style="font-size:14px; color:#cbd5e1; margin-top:8px;">
                                            Someone has reached out through your website.
                                        </div>

                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:40px;">

                            <!-- Contact Information -->
                            <div style="font-size:13px; font-weight:bold; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:18px;">
                                Contact Information
                            </div>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin-bottom:30px;">

                                <tr>

                                    <td width="50%"
                                        style="padding:16px; background:#f8fafc; border:1px solid #e5e7eb; border-radius:10px 0 0 0;">

                                        <div style="font-size:12px; color:#64748b; margin-bottom:6px;">
                                            Name
                                        </div>

                                        <div style="font-size:15px; font-weight:bold; color:#111827;">
                                            {{ $contactMessage->name }}
                                        </div>

                                    </td>

                                    <td width="50%"
                                        style="padding:16px; background:#f8fafc; border:1px solid #e5e7eb; border-left:0; border-radius:0 10px 0 0;">

                                        <div style="font-size:12px; color:#64748b; margin-bottom:6px;">
                                            Email
                                        </div>

                                        <div style="font-size:15px; font-weight:bold; color:#111827; word-break:break-word;">
                                            {{ $contactMessage->email }}
                                        </div>

                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="2"
                                        style="padding:16px; background:#ffffff; border:1px solid #e5e7eb; border-top:0; border-radius:0 0 10px 10px;">

                                        <div style="font-size:12px; color:#64748b; margin-bottom:6px;">
                                            Subject
                                        </div>

                                        <div style="font-size:16px; font-weight:bold; color:{{ $darkPrimary }};">
                                            {{ $contactMessage->subject }}
                                        </div>

                                    </td>
                                </tr>

                            </table>

                            <!-- Message -->
                            <div style="font-size:13px; font-weight:bold; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:14px;">
                                Message
                            </div>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="background:#f8fafc; border-left:4px solid {{ $primary }}; border-radius:8px;">

                                <tr>
                                    <td style="padding:22px 24px;">

                                        <div style="font-size:15px; line-height:1.8; color:#374151;">
                                            {!! nl2br(e($contactMessage->description)) !!}
                                        </div>

                                    </td>
                                </tr>

                            </table>

                            <!-- Reply Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin-top:30px;">

                                <tr>
                                    <td align="center">

                                        <a href="mailto:{{ $contactMessage->email }}"
                                           style="display:inline-block; background:{{ $darkPrimary }}; color:#ffffff; text-decoration:none; font-size:14px; font-weight:bold; padding:14px 28px; border-radius:8px;">

                                            Reply to {{ $contactMessage->name }}

                                        </a>

                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:25px 40px; background:#f8fafc; border-top:1px solid #e5e7eb; text-align:center;">

                            <div style="font-size:13px; color:#64748b; line-height:1.6;">
                                This notification was generated automatically from your portfolio website.
                            </div>

                            <div style="font-size:12px; color:#94a3b8; margin-top:8px;">
                                Please do not reply directly to this automated notification.
                            </div>

                        </td>
                    </tr>

                </table>

                <!-- Bottom Branding -->
                <div style="max-width:650px; margin-top:20px; text-align:center; font-size:12px; color:#94a3b8;">

                    {{ $siteSetting?->footer_text ?? 'Copyright © 2026 Magino Kent Daniel.' }}

                </div>

            </td>
        </tr>

    </table>

</body>
</html>