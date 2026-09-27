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
    <title>Reset Your Password</title>
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
                                            Account Security
                                        </div>

                                        <div style="font-size:26px; font-weight:bold; color:#ffffff;">
                                            Reset Your Password
                                        </div>

                                        <div style="font-size:14px; color:#cbd5e1; margin-top:8px;">
                                            A request was made to reset your account password.
                                        </div>

                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:40px;">

                            <div style="font-size:15px; line-height:1.8; color:#374151; margin-bottom:24px;">
                                Hello {{ $user->name ?? 'there' }},
                                <br><br>
                                We received a request to reset the password for your account. Click the button below to choose a new password. This link will expire in 60 minutes for your security.
                            </div>

                            <!-- Reset Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin:30px 0;">

                                <tr>
                                    <td align="center">

                                        <a href="{{ $resetUrl }}"
                                           style="display:inline-block; background:{{ $darkPrimary }}; color:#ffffff; text-decoration:none; font-size:14px; font-weight:bold; padding:14px 32px; border-radius:8px;">

                                            Reset Password

                                        </a>

                                    </td>
                                </tr>

                            </table>

                            <!-- Fallback link -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="background:#f8fafc; border-left:4px solid {{ $primary }}; border-radius:8px;">

                                <tr>
                                    <td style="padding:18px 22px;">

                                        <div style="font-size:12px; color:#64748b; margin-bottom:8px;">
                                            If the button above doesn't work, copy and paste this link into your browser:
                                        </div>

                                        <div style="font-size:13px; color:{{ $darkPrimary }}; word-break:break-all;">
                                            {{ $resetUrl }}
                                        </div>

                                    </td>
                                </tr>

                            </table>

                            <div style="font-size:13px; line-height:1.7; color:#64748b; margin-top:26px;">
                                If you didn't request a password reset, no further action is required — your account is still secure and this link will simply expire on its own.
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:25px 40px; background:#f8fafc; border-top:1px solid #e5e7eb; text-align:center;">

                            <div style="font-size:13px; color:#64748b; line-height:1.6;">
                                This is an automated security notification from your account dashboard.
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