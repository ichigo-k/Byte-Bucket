<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>

<body style="margin:0; padding:0; background-color:#020617; font-family:Arial, Helvetica, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center" style="padding:48px 16px;">

            <!-- Card -->
            <table width="100%" cellpadding="0" cellspacing="0"
                   style="max-width:520px;
                          background:rgba(15,23,42,0.85);
                          backdrop-filter:blur(8px);
                          border-radius:20px;
                          box-shadow:0 30px 70px rgba(0,0,0,0.7);
                          overflow:hidden;">

                <!-- Header -->
                <tr>
                    <td style="padding:32px;
                               border-bottom:1px solid rgba(255,255,255,0.08);">
                        <h2 style="margin:0;
                                   color:#ffffff;
                                   font-size:24px;
                                   font-weight:700;">
                            ByteBucket
                        </h2>
                        <p style="margin:6px 0 0;
                                  font-size:12px;
                                  letter-spacing:0.12em;
                                  text-transform:uppercase;
                                  color:#94a3b8;">
                            Secure Access
                        </p>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:40px 32px; color:#e5e7eb;">

                        <h1 style="margin:0 0 14px;
                                   font-size:28px;
                                   font-weight:800;
                                   line-height:1.3;">
                            Verify your email
                            <span style="color:#3b82f6;">.</span>
                        </h1>

                        <p style="margin:0 0 28px;
                                  color:#9ca3af;
                                  font-size:15px;
                                  line-height:1.7;">
                            Welcome back! Before you can continue,
                            please confirm that this email address belongs to you.
                        </p>

                        <!-- Button -->
                        <table cellpadding="0" cellspacing="0" align="center" role="presentation"
                               style="margin:36px 0;">
                            <tr>
                                <td align="center"
                                    style="background:#3b82f6;
                                           border-radius:14px;">
                                    <a href="{{ $verificationUrl }}"
                                       target="_blank"
                                       style="display:inline-block;
                                              padding:16px 40px;
                                              color:#ffffff;
                                              font-size:15px;
                                              font-weight:600;
                                              text-decoration:none;">
                                        Verify Email
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <!-- Divider -->
                        <div style="height:1px;
                                    background:rgba(255,255,255,0.08);
                                    margin:36px 0;"></div>

                        <!-- Fallback -->
                        <p style="margin:0 0 24px;
                                  font-size:13px;
                                  color:#9ca3af;
                                  line-height:1.7;">
                            If the button doesn’t work, copy and paste this link into your browser:
                            <br><br>
                            <a href="{{ $verificationUrl }}"
                               style="color:#60a5fa;
                                      word-break:break-all;
                                      text-decoration:none;">
                                {{ $verificationUrl }}
                            </a>
                        </p>

                        <p style="margin:0;
                                  font-size:14px;
                                  color:#9ca3af;
                                  line-height:1.6;">
                            If you didn’t create an account, you can safely ignore this email.
                        </p>

                        <p style="margin:36px 0 0;
                                  text-align:center;
                                  font-size:13px;
                                  color:#64748b;
                                  font-style:italic;">
                            “No surplus words or unnecessary actions.”
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="padding:22px;
                               text-align:center;
                               background-color:#020617;">
                        <p style="margin:0;
                                  font-size:12px;
                                  color:#64748b;">
                            © {{ date('Y') }} ByteBucket. All rights reserved.
                        </p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>
</body>
</html>
